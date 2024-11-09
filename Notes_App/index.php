<?php

require "functions.php";
require 'Database.php';
require 'Response.php';
require 'router.php';
// Load the configuration for the database
$config = require('config.php');

// Create a new Database instance
$db = new Database($config['database']);
$id = $_GET['id'];

$query = "select * from posts where id = ?";

$posts = $db->query($query, [$id])->find();

// dd($posts);