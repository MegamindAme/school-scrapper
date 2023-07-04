<?php

namespace Megamindame\SchoolScraper;

use DOMDocument;
use DOMXPath;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\TransferStats;

class PrimaryFetcher extends Fetcher
{
    protected array $data;

    protected $nodes;

    /**
     * Raw school data from
     * @var
     */
    protected array $schools;

    private string $root_url;

    public function __construct()
    {
        parent::__construct();
    }

    public function getSchools(bool $raw = false)
    {
        if (!isset($this->schools)) $this->fetchPrimaryNodes();

        if ($raw)
            return $this->schools;

        return $this->formatSchools($this->schools);
    }

    public function getPrimaryData()
    {
        if (!isset($this->nodes)) $this->fetchPrimaryNodes();
        $nodes = [];
        foreach ($this->nodes as $key => $node) {
            foreach ($node as $dist => $district) {
                foreach ($district as $school) {
                    $nodes[$key][$dist][] = $school->textContent . '’';
                }
            }
        }

        return $nodes;
    }

    public function getNodes()
    {
        $this->getPrimaryNodes();
    }

    protected function fetchPrimaryNodes()
    {
        ///foreach region
        foreach (parent::getNodes() as $node) {
            $url = "";
            $httpClient = new \GuzzleHttp\Client(['base_uri' => parent::getRootUrl()]);
            $response = $httpClient->get($node->getAttribute('href'),
                [
                    'on_stats' => function (TransferStats $stats) use (&$url) {
                        $url = $stats->getEffectiveUri();
                    }
                ]);

            $this->setPrimaryRootUrl($url);

            $htmlString = (string)$response->getBody();

            //add this line to suppress any warnings
            libxml_use_internal_errors(true);

            $doc = new DOMDocument();
            $doc->loadHTML($htmlString);
            $xpath = new DOMXPath($doc);

            $subNodes = $xpath->evaluate('//table//td//a');

//            $nodes[$node->textContent] = $subNodes;

            //Foreach district
            foreach ($subNodes as $subNode) {
                $nodes[trim($node->textContent)][trim($subNode->textContent)] = $this->fetchSchoolNodes($subNode->getAttribute('href'));
            }
        }

        $this->nodes = $nodes;
    }

    private function fetchSchoolNodes($url)
    {
        $httpClient = new \GuzzleHttp\Client(['base_uri' => $this->root_url]);
        $response = $httpClient->get($url);
        $htmlString = (string)$response->getBody();

        //add this line to suppress any warnings
        libxml_use_internal_errors(true);

        $doc = new DOMDocument();
        $doc->loadHTML($htmlString);
        $xpath = new DOMXPath($doc);

        $nodes = $xpath->evaluate('//table//td//a');

        foreach ($nodes as $node) {
            $this->schools[] = $node->textContent;
        }

        return $nodes;
    }

    protected function getPrimaryNodes()
    {
        if (!isset($this->nodes)) $this->fetchPrimaryNodes();
        return $this->nodes;
    }

    private function setPrimaryData()
    {
        if (!isset($this->nodes)) $this->fetchPrimaryNodes();
        foreach ($this->nodes as $node) {
            foreach ($node as $item) {
                $this->data[] = $item->textContent;
            }
        }
    }

    private function setPrimaryRootUrl(Uri $uri)
    {
        $this->root_url = $uri->__toString();
    }

    private function formatSchools($schools): array
    {
        $formattedSchools = null;
        foreach ($schools as $school) {
            $values = explode('-', $school);

            $key = trim(array_pop($values));
            $name = trim(implode($values));

            $formattedSchools[$key] = $name;
        }

        return $formattedSchools;
    }
}