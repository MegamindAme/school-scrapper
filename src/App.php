<?php

namespace Megamindame\SchoolScraper;

class App{
    public function run(){
        $fetcher = new SecondaryFetcher();
        return $fetcher->getSchools();
        return $fetcher->getData();
    }
}