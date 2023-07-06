<?php

namespace Megamindame\SchoolScraper;

use DOMDocument;
use DOMXPath;
use GuzzleHttp\Psr7\Uri;
use GuzzleHttp\TransferStats;

class Fetcher
{
    private string $root_url;

    protected array $data;

    protected $nodes;

    public function __construct($year = 2022)
    {
        $this->setRootUrl(config('necta.results_url.primary', ['year' => $year]));
    }

    protected function setRootUrl($url)
    {
        $this->root_url = $url;
    }

    protected function getRootUrl()
    {
        return $this->root_url;
    }

    protected function getData()
    {
        if (!isset($this->data)) $this->setData();
        return $this->data;
    }

    protected function getNodes()
    {
        if (!isset($this->nodes)) $this->fetchNodes();
        return $this->nodes;
    }

    //Gets the root_url data
    protected final function getRootData()
    {
        if (!isset($this->data)) $this->setData();
        return $this->data;
    }

    protected function fetchNodes()
    {
        $httpClient = new \GuzzleHttp\Client(['base_uri' => $this->root_url]);
        $response = $httpClient->get($this->root_url);
        $htmlString = (string)$response->getBody();

        //add this line to suppress any warnings
        libxml_use_internal_errors(true);

        $rootDoc = new DOMDocument();
        $rootDoc->loadHTML($htmlString);
        $rootXpath = new DOMXPath($rootDoc);

        $this->nodes = $rootXpath->evaluate('//table[last()]//td//a');
    }

    private function setData()
    {
        foreach ($this->getNodes() as $item) {
            $this->data[] = $item->textContent;
        }
    }
}