<?php

namespace Megamindame\SchoolScraper;

class SecondaryFetcher extends \Megamindame\SchoolScraper\Fetcher {

    /**
     * Raw school data from
     * @var
     */
    protected array $schools;

    public function __construct()
    {
        parent::__construct();
        $this->setRootUrl(config('necta.results_url.secondary', ['year' => 2022]));
    }

    public function getSchools(){
        $schools = [];

        foreach ($this->getData() as $data){
            $values = explode(' ', trim(str_replace("  ", " ", $data))); //replace double spaces with single space

            $key = trim(array_shift($values));
            $name = implode(" ", $values);

            $schools[$key] = $name;
        }

        return $schools;
    }
}