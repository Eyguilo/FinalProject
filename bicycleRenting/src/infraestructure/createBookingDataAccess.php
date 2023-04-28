<?php

ini_set('display_errors', 'On');
ini_set('html_errors', 1);

class CreateBookingDataAccess
{

    function __construct()
    {
    }

    function findClients($name, $lastName)
    {

        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');
        $query = mysqli_prepare($connection, "SELECT c.id_client, CONCAT(c.name, ' ', c.last_name) as complete_name
        FROM T_Clients c WHERE c.name = '%(?)%' OR c.last_name = '%(?)%'");
        $query->bind_param("ss", $name, $lastName);
        $result = $query->execute();

        return $result;
    }
}