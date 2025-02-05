<?php

namespace Models;
use Core\Database;

class User extends Database {

    public function getUsersData($firstname, $lastname){
        $sql = "SELECT * FROM users WHERE firstname= ? AND lastname= ?";
        $stmnt = $this->connect()->prepare($sql);
        $stmnt ->execute([$firstname, $lastname]);
        $names = $stmnt->fetchAll();
        return $names;
        // foreach ($names as $name) {
        //     echo $name['lastname'] . '<br>';
        // }
    }

    public function setUsersData($firstname, $lastname, $email, $password){
        $sql = "INSERT INTO users(firstname, lastname, email, password) VALUES (?, ?, ?, ?)";
        $stmnt = $this->connect()->prepare($sql);
        $stmnt ->execute([$firstname, $lastname, $email, $password]);
    }
}