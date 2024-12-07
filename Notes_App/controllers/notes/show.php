<?php
use Core\App;
use Core\Database;

//  controller to show a particular note
$db = App::resolve(Database::class);


$currentUserId = 1;

    // tracks note that has an id that matches the id in query string.
    //$note is an instance of a PDO statement, object(PDOStatement)
    $note = $db->query('select * from notes where id = :id',
    [
        'id' => $_GET['id']
    ])->findorFail();


authorize($note['user_id'] == $currentUserId);

view("notes/show.view.php" , ['heading' => 'Note', 'note' => $note]);

