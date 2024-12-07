<?php

use Core\App;
use Core\Container;
use Core\Database;

$container = new Container();

//binds things to the container class using the container instance, $conatiner
//the Core\Database represents the key, then the function is the resolver according to :    public function bind($key, $resolver) in Container.php

$container->bind('Core\Database', function () {
    $config = require base_path('config.php');

    return new Database($config['database']);
});

App::setContainer($container);