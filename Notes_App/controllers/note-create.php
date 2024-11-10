<?php
$config = require('config.php');
require 'Validator.php';

// instance of the Database class
$db = new Database($config['database']);

$heading = "Create Note";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = []; //$errors array to store error messages

    $validator = new Validator();

    if ($validator ->string($_POST['body'])) {
        $errors['body'] = 'A body is required'; //$errors['body'] is adding a new key-value pair to the $errors array.
    } //same as $errors = ['body' => 'A body is required']

    if (strlen($_POST['body']) > 1000) {
        $errors['body'] = 'The body cannot be more than 1000 characters';
    }

    if (empty($errors)) { //if no errors are found
        $db->query('INSERT INTO notes(body, user_id) VALUES(:body, :user_id)', [
            'body' => $_POST['body'],
            'user_id' => 1
        ]); 
    }
}


require "views/note-create.view.php";