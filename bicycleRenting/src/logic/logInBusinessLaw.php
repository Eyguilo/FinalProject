<?php
require("../infraestructure/logInDataAccess.php");

class LogInBusinessLaw
{
    function __construct()
    {
    }
    function verifyUser($userId, $key)
    {

        $logInDataAccess = new LogInDataAccess();
        $result = $logInDataAccess->verifyUser($userId, $key);
        return $result;
    }
}
