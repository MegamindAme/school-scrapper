<?php

namespace Megamindame\SchoolScraper;

class AdvancedSecondaryFetcher extends \Megamindame\SchoolScraper\SecondaryFetcher {

    /**
     * Raw school data from
     * @var
     */
    protected array $schools;

    public function __construct()
    {
        parent::__construct();
        $this->setRootUrl(config('necta.results_url.advanced_secondary', ['year' => 2022]));
    }
}