<?php

$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

$router->get('/notes', 'controllers/notes/index.php')->only('auth');
$router->get('/note', 'controllers/notes/show.php')->only('auth');
$router->delete('/note', 'controllers/notes/destroy.php')->only('auth');

$router->get('/note/edit', 'controllers/notes/edit.php')->only('auth');
$router->patch('/note', 'controllers/notes/update.php')->only('auth');

$router->get('/notes/create', 'controllers/notes/create.php')->only('auth');
$router->post('/notes', 'controllers/notes/store.php')->only('auth');

$router->get('/register', 'controllers/registration/create.php')->only('guest');
$router->post('/register', 'controllers/registration/store.php')->only('guest');

$router->get('/login', 'controllers/session/create.php')->only('guest');
$router->post('/login', 'controllers/session/store.php')->only('guest');

//only accessible by authenticated supervisors and approved agents
$router->get('/dashboard', 'controllers/dashboard.php')->only('auth');

$router->delete('/session', 'controllers/session/destroy.php')->only('auth');
