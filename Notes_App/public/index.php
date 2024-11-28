<?php

const BASE_PATH = __DIR__ . '/../';
//base path is Notes_App dir 

require BASE_PATH . "Core/functions.php";

spl_autoload_register(function($class) {
    require base_path("Core/{$class}.php");
    //$class . '.php means /public/../Database.php" where $class is Databse
    //spl_autoload_register helps to manually import classes that have not been required.
});

require base_path('Core/router.php');

// Load the configuration for the database
$config = require('config.php');

// Create a new Database instance
$db = new Database($config['database']);
$id = $_GET['id'];

$query = "select * from posts where id = ?";

$posts = $db->query($query, [$id])->find();
 
// dd($posts);