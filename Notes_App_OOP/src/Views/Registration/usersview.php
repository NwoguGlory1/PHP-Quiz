<?php
namespace Views\Registration;

use Models\User;
class UsersView extends User {

    public function ShowUser($firstname, $lastname) {
    $names = $this->getUsersData($firstname, $lastname);
     echo $names[0]['firstname'] . "" . $names[0]['lastname'] . '<br>';
    }
}