<?php
// controller to store the login details

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

// When an account with that email address is not found, return an error on the login page: "Account not found"
$errors = [];
if (!Validator::email($email)) {
    $errors['email'] = 'Please provide a valid e-mail address';
 }
 
 if (!Validator::string($password)) {
     $errors['password'] = 'Please provide a valid password';
 }

if (! empty($errors)) {
    return view('session/create.view.php', [
        'errors' => $errors
    ]);
}

//if no error, to login, first match the credentials.
//we first match the email
$user = $db->query('select * from users where email = :email', [
    'email' => $email
])->find();


//if there is a user with that email, match the password by comparing the password entered with the db hashed password.
if ($user) {
    if (password_verify($password, $user['password'])) {
        session_start();
        login([
            'email' => $user['email'],
            'firstname' => $user['firstname'],
            'lastname' => $user['lastname']
        ]);

        header('location: /dashboard');
        exit();
    }
}
return view('session/create.view.php', [
    'errors' => ['email' => 'Invalid credentials.']
    ]);



// If they equal, then a session must be created for the user using PHP sessions as well as a cookie