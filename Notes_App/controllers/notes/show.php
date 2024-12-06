<?php

use Core\Database;

$config = require base_path('config.php');

// instance of the Database class
$db = new Database($config['database']);


$currentUserId = 1;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $note = $db->query('select * from notes where id = :id', [
        'id' => $_GET['id']
    ])->findOrFail();

    authorize($note['user_id'] === $currentUserId);

    $db->query('delete from notes where id = :id', [
        'id' => $_GET['id']
    ]);

    header('location: /notes');
    exit();
} else {
    // tracks note that has an id that matches the id in query string.
//$note is an instance of a PDO statement, object(PDOStatement)
$note = $db->query('select * from notes where id = :id',
[
   'id' => $_GET['id']
])->findorFail();


authorize($note['user_id'] == $currentUserId);

view("notes/show.view.php" , ['heading' => 'Note', 'note' => $note]);

}

