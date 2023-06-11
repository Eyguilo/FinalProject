<?php
require("../infraestructure/UserDataAccess.php");

class UserBusinessLaw
{
    function __construct()
    {
    }

    function createUser($userData)
    {
        if($userData[3] != $userData[4]){
            return "Passwords are not the same.";
        }

        $logInDataAccess = new UserDataAccess();
        $result = $logInDataAccess->createUser($userData);
        return $result;
    }

    function verifyUser($userId, $key)
    {

        $logInDataAccess = new UserDataAccess();
        $result = $logInDataAccess->verifyUser($userId, $key);
        return $result;
    }
}
