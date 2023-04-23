<?php

ini_set('display_errors', 'On');
ini_set('html_errors', 1);

class CreateClientDataAccess
{

    function __construct()
    {
    }

    function createClient($name, $lastName, $email, $phone, $address)
    {

        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');
        $query = mysqli_prepare($connection, "INSERT INTO T_Clients (name, last_name, email, phone, address)VALUES (?,?,?,?,?);");
        $query->bind_param("sssss", $name, $lastName, $email, $phone, $address);
        $result = $query->execute();

        return $result;
    }
}