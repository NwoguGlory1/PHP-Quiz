<?php
use Core\App;
use Core\Database;

//  controller to list all created notes
$db = App::resolve(Database::class);


$notes = $db->query('select * from notes where user_id=1')->get();

view("notes/index.view.php" , ['heading' => 'My Notes', 'notes' => $notes]);