<?php
// container class is necessary to avoid always refering this: $config = require base_path('config.php'); & $db = new Database($config['database']);
// we can throw in all the db config inside the container inside the container
namespace Core;

use Exception;

class Container 
{
    protected $bindings = [];

    //function to bind the object to the conatiner
    public function bind($key, $resolver)
    {
        $this->bindings[$key] = $resolver;
    }

    //function to take the object out of the conatiner
    public function resolve($key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new Exception("No matching binding found for {$key}");
        }

        $resolver = $this->bindings[$key];

        return call_user_func($resolver);
    }
}