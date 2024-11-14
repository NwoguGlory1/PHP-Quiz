<?php

const BASE_PATH = __DIR__ . '/../';
//base path is Notes_App dir 

require BASE_PATH . "functions.php";

require base_path('Database.php');
require base_path('Response.php');
require base_path('router.php');

// Load the configuration for the database
$config = require('config.php');

// Create a new Database instance
$db = new Database($config['database']);
$id = $_GET['id'];

$query = "select * from posts where id = ?";

$posts = $db->query($query, [$id])->find();

// dd($posts);