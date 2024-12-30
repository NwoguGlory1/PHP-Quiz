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
        // Check if the user's role is agent and they are approved
        if ($user['role'] === 'agent' && !$user['approved']) {
            // If not approved, check if a request has already been sent
            if (!$user['request_sent']) {
                // Send the approval request
                $db->query('UPDATE users SET request_sent = TRUE WHERE id = :id', [
                    'id' => $user['id']
                ]);
                echo "Approval request sent to the supervisor.";
            }
            // Display waiting approval message
            echo "<button disabled>Waiting Approval</button>";
            exit();
        }

        // Login the user and redirect based on role
        login($user);

        if ($user['role'] === 'supervisor') {
            header('location: /supervisor-dashboard');
            exit();
        } elseif ($user['role'] === 'agent' && $user['approved']) {
            header('location: /dashboard');
            exit();
        }
    }
}

// Invalid credentials or approval status
return view('session/create.view.php', [
    'errors' => ['email' => 'Invalid credentials or account not approved.']
]);
