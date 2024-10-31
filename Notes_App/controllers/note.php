<?php

$config = require('config.php');

// instance of the Database class
$db = new Database($config['database']);


$heading = "Note";

$id = $_GET['id'];

$note = $db->query('select * from notes where user_id = :user and id = :id',
 [
    'user' => 1,
    'id' => $id
])->fetch();

if (!$note) {
    abort();
}

require "views/note.view.php";