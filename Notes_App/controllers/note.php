<?php

$config = require('config.php');

// instance of the Database class
$db = new Database($config['database']);


$heading = "Note";
$currentUserId = 1;

$id = $_GET['id'];

$note = $db->query('select * from notes where id = :id',
 [
    'id' => $id
])->fetch();

if (!$note) {
    abort();
}


if($note['user_id'] !== $currentUserId) {
    abort(403);
}

require "views/note.view.php";