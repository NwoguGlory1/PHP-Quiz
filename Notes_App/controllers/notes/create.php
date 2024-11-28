<?php
$config = require base_path('config.php');
require base_path('Validator.php');

// instance of the Database class
$db = new Database($config['database']);

$errors = []; //$errors array to store error messages

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (!Validator::string($_POST['body'], 1, 1000)) {
        $errors['body'] = 'A body of not more than 1000 characters is required'; //$errors['body'] is adding a new key-value pair to the $errors array.
    } //same as $errors = ['body' => 'A body is required']


    if (empty($errors)) { //if no errors are found
        $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
            'body' => $_POST['body'],
            'user_id' => 1
        ]); 
    }
}


view("notes/create.view.php" , ['heading' => 'Create Note', 'errors' => $errors]);