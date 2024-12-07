<?php
//  controller to delete a created note
use Core\App;
use Core\Database;

// instance of the Database class
// $db = new Database($config['database']);
// $config = require base_path('config.php');


$db = App::resolve('Core\Database');
//same as $db = App::resolve(Database::class);


$currentUserId = 1;

//query the db to pick all notes where id of the note is the id submitted in the POST request.
$note = $db->query('select * from notes where id = :id', [
    'id' => $_POST['id']
    ])->findOrFail();
    
    //perform authorization
    authorize($note['user_id'] === $currentUserId);

    //delete the note
    $db->query('delete from notes where id = :id', [
        'id' => $_POST['id']
    ]);

    //redirect the user to the list of notes
    header('location: /notes');
    exit();