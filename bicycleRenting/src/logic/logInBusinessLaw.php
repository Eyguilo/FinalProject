<?php
require("../infraestructure/logInDataAccess.php");

class LogInBusinessLaw
{
    function __construct()
    {
    }
    function verifyUser($usename, $key)
    {

        $logInDataAccess = new LogInDataAccess();
        $result = $logInDataAccess->verifyUser($usename, $key);
        return $result;
    }
}
