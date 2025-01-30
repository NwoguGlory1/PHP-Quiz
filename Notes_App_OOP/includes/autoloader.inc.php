<?php

spl_autoload_register('myAutoLoader');

function myAutoLoader($className) {
    $path = "src/classes/";
    $extension = ".class.php";
    $fullPath = $path . str_replace('\\', '/', $className) . $extension;

    // var_dump($fullPath) = src/classes/Person/Person.class.php
    if (!file_exists($fullPath)) {
        return false;
    }

    include_once $fullPath;
}

//  $router = new Router;
//  var_dump($router);
    // echo get_class($router);