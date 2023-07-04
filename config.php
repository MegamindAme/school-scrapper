<?php

return [
    'necta' => [
        'site_url' => 'https://www.necta.go.tz',
        'results_url' => [
            'primary' => "https://onlinesys.necta.go.tz/results/{year}/psle/psle.htm",
            'secondary' => "https://onlinesys.necta.go.tz/results/{year}/csee/index.htm",
            'advanced_secondary' => "https://onlinesys.necta.go.tz/results/{year}/acsee/index.htm",
            'custom' => [
                ///format
                /// year=>[
                ///     'primary' => URL
                ///     'secondary' => URL
                ///     'advanced_secondary' => URL
                /// ]
            ]
        ],
    ],
];
