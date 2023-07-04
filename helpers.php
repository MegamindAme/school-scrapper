<?php

$config = include 'config.php';

if (!function_exists('config')) {
    function config($accessor, $options)
    {
        $accessors = explode('.', $accessor);

        $value = include 'config.php';

        foreach ($accessors as $item) {
            $value = $value[$item];
        }

        foreach ($options as $key => $option) {
            $value = str_replace('{' . $key . '}', $option, $value);
        }
        return $value;
    }
}

if (!function_exists('dd')) {
    function dd($var)
    {
       var_dump($var);
       exit();
    }
}