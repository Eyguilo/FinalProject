<?php
require("../infraestructure/LogInDataAccess.php");

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
