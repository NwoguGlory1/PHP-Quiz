<?php
// controller for where the registered user info is stored

use Core\App;
use Core\Database;
use Core\Validator;

$db = App::resolve(Database::class);

$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];
$password = $_POST['password'];

//validate the form inputs, check if there is error in all create form inputs
$errors = [];
if (!Validator::name($firstname)) {
    $errors['firstname'] = 'Please provide a valid first name.';
}

if (!Validator::name($lastname)) {
    $errors['lastname'] = 'Please provide a valid last name.';
}

if (!Validator::email($email)) {
   $errors['email'] = 'Please provide a valid email address.';
}

if (!Validator::string($password, 7, 255)) {
    $errors['password'] = 'Please provide a password of at least seven characters.';
}

//if there is error, return the create form again
if (! empty($errors)) {
    return view('registration/create.view.php', [
        'errors' => $errors
    ]);
}

//check if the account already exists by querying the db passing in only the unique identifier of the user like email
$user = $db->query('select * from users where email = :email', [
    'email' => $email

])->find();

  //if yes, throw an error, redirect to register form
   if ($user) {
    $_SESSION['errors'] = ['email' => 'Email address exists'];
    header('location: /register');
    exit();
} else {
     //if not, save one to the db and then log the user in and redirect.

    $db->query('INSERT INTO users(firstname, lastname, email, password) VALUES(:firstname, :lastname, :email, :password)', [
        'firstname' => $firstname,
        'lastname' => $lastname,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT) // NEVER store database passwords in clear text. We'll fix this in the login form episode. :)
    ]);

    login($user);


    header('location: /login');
    exit();
}