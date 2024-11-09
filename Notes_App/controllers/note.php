<?php

$config = require('config.php');

// instance of the Database class
$db = new Database($config['database']);


$heading = "Note";
$currentUserId = 1;

$id = $_GET['id'];

// tracks note that has an id that matches the id in query string
$note = $db->query('select * from notes where id = :id',
 [
    'id' => $id
])->fetch();


if (!$note) {
    abort();
}


if($note['user_id'] !== $currentUserId) {
    abort(Response::FORBIDDEN);
}

require "views/note.view.php";