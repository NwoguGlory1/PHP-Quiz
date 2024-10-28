<?php

require "functions.php";
// require 'router.php';

class Database {
    public function query()
    {
        // connect to MySQL databse;
    $dsn = "mysql:host=localhost;port=3306;dbname=myapp;user=root;charset=utf8mb4";

    $pdo = new PDO($dsn);

    $statement = $pdo->prepare("select * from posts");
    $statement ->execute();

    return $statement->fetchAll(PDO::FETCH_ASSOC);

    }
}

$db = new Database();
// instance of the Database class
$posts = $db->query();

foreach ($posts as $post) {
    echo "<li>" . $post['title'] .  "</li>" ;
}