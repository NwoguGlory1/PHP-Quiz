<?php

//  controller to show a particular note
use Core\Database;

$config = require base_path('config.php');

// instance of the Database class
$db = new Database($config['database']);


$currentUserId = 1;

    // tracks note that has an id that matches the id in query string.
    //$note is an instance of a PDO statement, object(PDOStatement)
    $note = $db->query('select * from notes where id = :id',
    [
        'id' => $_GET['id']
    ])->findorFail();


authorize($note['user_id'] == $currentUserId);

view("notes/show.view.php" , ['heading' => 'Note', 'note' => $note]);

