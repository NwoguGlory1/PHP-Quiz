<?php

use Core\Response;

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
    //putting the session start here, is it ok??
    
    //mark that the user has logged in by setting the user session
    $_SESSION['user'] = [
        'email' => $user['email'], //passing in the email the user provided
        'firstname' => $user['firstname'],
        'lastname' => $user['lastname'] 
     
        
    ];
       //create a cookie
    setcookie("auth_user", $user['id'], time() + (36000), "/");
 
    session_regenerate_id(true);
    //regenerate session id, update cookie & session file name is good practice of login
}

    function logout()
{

    /// Unset all session variables
    $_SESSION = [];

    //destroys out the session 
    session_destroy();

    //delete the cookie
    //session_get_cookie_params is used to get the path, domain, etc cause it returns an array with all these contained in it
    $params = session_get_cookie_params();
    setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain'], $params['secure'], $params['httponly']);

}
