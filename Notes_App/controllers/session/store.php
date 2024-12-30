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
        login($user);

// Redirect based on role
    if ($_SESSION['role'] == 'supervisor') {
        // Supervisors can access the dashboard directly
        header('location: /supervisor-dashboard');
        exit();   
    } elseif ($_SESSION['role'] == 'agent') {
        // If the agent is approved, they can access the dashboard
        if ($_SESSION['approved'] == true) {
            header('location: /dashboard');
            exit();
        }
    
        // If the agent is not approved, send the approval request
    if ($_SESSION['approved'] == false && (!$_SESSION['request_sent'])) {
            // Agents who are not approved cannot access the dashboard
            //find() was not called on the update query cause nothing is being retrieved
            $stmt = $db->query('UPDATE users SET request_sent = TRUE WHERE id = :id', [
                'id' => $user['id']
            ]);

            // Display a message for the agent
            echo "Approval request sent to the supervisor.";       
           // Display waiting approval message
            echo "<button disabled>Waiting Approval</button>";
            exit();
        }
    }
}
return view('session/create.view.php', [
    'errors' => ['email' => 'Invalid credentials.']
    ]);
}