<?php

$config = require('config.php');

// instance of the Database class
$db = new Database($config['database']);


$heading = "Note";

$id = $_GET['id'];

$note = $db->query('select * from notes where id = :id', ['id' => $id])->fetch();

require "views/note.view.php";