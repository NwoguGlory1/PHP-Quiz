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
    //mark that the user has logged in by setting the user session
    $_SESSION['user'] = [
        'email' => $user['email'] //passing in the email the user provided
    ];

}