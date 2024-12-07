<?php

namespace Core;

//we can now use App::container to reference the container in the other files that will need access to these: $config = require base_path('config.php');$db = new Database($config['database']); instead of

class App

{
    protected static $container;

    public static function setContainer($container)
    {
        static::$container = $container; 
        //initialises the static $container property to the arg, $container
    }

    public static function container()
    {
        return static::$container;
    }

    public static function bind($key, $resolver)
    {
        static::container()->bind($key, $resolver);
    }

    public static function resolve($key)
    {
        return static::container()->resolve($key);
    }
}