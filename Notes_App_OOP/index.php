<?php

     include 'includes/autoloader.inc.php';
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

    $house1 = new House("Ajah", 6);
    echo $house1->getAddress();
    echo "<br>";


    // $router = new Framework\Router;
    // echo get_class($router);
    ?>
</body>
</html>