<?php

require "functions.php";
require 'router.php';
require 'Database.php';

$config = require('config.php');

// instance of the Database class
$db = new Database($config['database']);

$id = $_GET['id'];
$query = "select * from posts where id = ?";

$posts = $db->query($query, [$id])->fetch();

dd($posts);