<?php

    //  include 'includes/autoloader.inc.php';

    require 'vendor/autoload.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
</head>
<body>
    <?php
    $person1 = new Person\Person("Daniel", 28);
    echo $person1->getPerson();
    echo "<br>";

    $house1 = new House\House("Ajah", 6);
    echo $house1->getAddress();
    echo "<br>";


    $router = new Framework\Router;
    echo get_class($router);

    echo "<br>";
    $houseyear1 = new House\HouseYear();
    echo get_class($houseyear1) . '<br>';

    //this gets data directly from User.php
    $test = new Models\User(); 
    $names = $test ->getUsersData("Glory", "Nwogu");
     foreach ($names as $name) {
            echo $name['lastname'] . '<br>';
        }

    //this updates data directly in User.php without a controller  
    // $test ->setUsersData("Mitchell", "Obama", "mo@gmail.com", 1234);
    
    //this gets data directly from usersview.php
    $usersobj = new Views\Registration\UsersView();
    $usersobj->ShowUser("Glory", "Nwogu");

    //this updates data directly in User.php with a controller  
    $usersobj2  = new Controllers\UsersContr();
    $usersobj2->createUser("John", "Doe", "johndoe@example.com", "1234");
    ?>
</body>
</html>