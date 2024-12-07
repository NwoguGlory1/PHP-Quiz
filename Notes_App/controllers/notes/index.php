<?php

//  controller to list all created notes
use Core\Database;

$config = require base_path('config.php');

// instance of the Database class
$db = new Database($config['database']);


$notes = $db->query('select * from notes where user_id=1')->get();

view("notes/index.view.php" , ['heading' => 'My Notes', 'notes' => $notes]);