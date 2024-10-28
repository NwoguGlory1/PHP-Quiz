<?php

require "functions.php";
// require 'router.php';

// connect to MySQL databse;
$dsn = "mysql:host=localhost;port=3306;dbname=myapp;user=root;charset=utf8mb4";

$pdo = new PDO($dsn);

$statement = $pdo->prepare("select * from posts");
$statement ->execute();

$posts = $statement->fetchAll();

dd($posts);