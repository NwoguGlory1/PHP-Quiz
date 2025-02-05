<?php
namespace Controllers;

use Models\User;
class UsersContr extends User {
    public function createUser($firstname, $lastname, $email, $password) {
        $this->setUsersData($firstname, $lastname, $email, $password);
    }
}