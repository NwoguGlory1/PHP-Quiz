<?php

use Core\Response;
use Core\App;
use Core\Database;

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "<pre>";

    die();
}

function urlIs($value) {
    return $_SERVER['REQUEST_URI'] === $value;
}

function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}

function authorize($condition, $status = Response::FORBIDDEN){
    if (!$condition) {
        abort($status);
    }
}

function base_path($path)
{
    return BASE_PATH . $path;
}

function view($path, $attributes = [])
{
    extract($attributes);
    //accepts array & turns it to a set of variables where name of variable is the key and the value of the variable is the value associated with the key

   require base_path('views/' . $path);
    //for view("index.view.php"), will load views/index.view.php

}

function login($user) {    
    
    //mark that the user has logged in by setting the user session
    $_SESSION['user'] = [
        'email' => $user['email'], //passing in the email the user provided
        'firstname' => $user['firstname'],
        'lastname' => $user['lastname'],
        'role' => $user['role'],
        'approved' => $user['approved'],
        'request_sent' => $user['request_sent'],    
    ];

    //you have to set the session role and other stuffs before you can access it in session/store.php
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role']; // Store the role
    $_SESSION['approved'] = $user['approved']; // Store approval status
    $_SESSION['request_sent'] = $user['request_sent'];

    // Set session expiration tracking
    $_SESSION['last_activity'] = time(); // Current time
    $_SESSION['expire_time'] = 120; // Session duration: 1 hour (3600 seconds)

    //sets a cookie, auth_user with an expiration time
    setcookie("auth_user", $user['id'], time() + (120), "/");
    
 
    session_regenerate_id(true);
    //regenerates session id
    //regenerate session id, update cookie & session file name is good practice of login

}

function logout()
{
     // Resolve the database instance
     $db = App::resolve(Database::class);
     
    // Reset approval status in the database
    $db->query('UPDATE users SET approved = FALSE WHERE id = :id', [
        'id' => $_SESSION['user_id']
]);
    /// Unset all session variables
    $_SESSION = [];


    //destroys out the session  data on the server
    session_destroy();

    // this actually deletes the cookie
    //session_get_cookie_params is used to get the path, domain, etc cause it returns an array with all these contained in it
    $params = session_get_cookie_params();
    setcookie("auth_user", '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

    // Close the session explicitly
    //this does not delete PHPSESSID, it is a good practice to release locks and ensure the session is not being actively used
    session_write_close();
    
}

