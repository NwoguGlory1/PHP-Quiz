<?php

const BASE_PATH = __DIR__ . '/../';
//base path is Notes_App dir 

require BASE_PATH . "Core/functions.php";

spl_autoload_register(function ($class) {
   // Core\Database
   $class = str_replace('\\', DIRECTORY_SEPARATOR, $class);

   require base_path("{$class}.php");
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