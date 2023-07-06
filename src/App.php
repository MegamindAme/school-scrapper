<?php

namespace Megamindame\SchoolScraper;

class App
{
    public function run()
    {
        /*
         * Fetch schools to get formated school array in format array =>[
         *  [center_number] => [center name],
         *  [center_number] => [center name],
         *  ...
         * ], See README.md for more details
         *
         * Fetch data to get unformatted <a> tag textContent, See README.md
         *
         * Fetch nodes to get the nodelist of <a></a> nodes that you can use to fetch results, See README.md
         */

//        Primary section
//        $fetcher = new PrimaryFetcher(2022);
//        $primarySchools = $fetcher->getSchools();
//        $primaryData = $fetcher->getPrimaryData();
//        $primaryNodes = $fetcher->getNodes();

//        Secondary section
//        $fetcher = new SecondaryFetcher(2022);
//        $secondarySchools = $fetcher->getSchools();
//        $secondaryNodes = $fetcher->getNodes();

//        Advanced Secondary section
//        $fetcher = new AdvancedSecondaryFetcher(2022);
//        $advSecondarySchools = $fetcher->getSchools();
//        $advSecondaryNodes = $fetcher->getNodes();

        //Try this
        $fetcher = new SecondaryFetcher(2022);
        return $fetcher->getSchools();
    }
}