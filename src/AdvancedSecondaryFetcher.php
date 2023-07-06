<?php

namespace Megamindame\SchoolScraper;

class AdvancedSecondaryFetcher extends \Megamindame\SchoolScraper\SecondaryFetcher {

    /**
     * Raw school data from
     * @var
     */
    protected array $schools;

    public function __construct($year = 2022)
    {
        parent::__construct($year);
        $this->setRootUrl(config('necta.results_url.advanced_secondary', ['year' => $year]));
    }
}