<?php

//load dependencies, config and helper functions
require 'vendor/autoload.php';

//Loading the app
$app = new \Megamindame\SchoolScraper\App();

$value = $app->run();

if (gettype($value) == "array") print_r($value);