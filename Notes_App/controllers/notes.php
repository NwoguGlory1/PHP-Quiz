<?php

$config = require('config.php');

// instance of the Database class
$db = new Database($config['database']);


$heading = "Notes";

$notes = $db->query('select * from notes where user_id=1')->fetchAll();

dd($notes);

require "views/notes.view.php";