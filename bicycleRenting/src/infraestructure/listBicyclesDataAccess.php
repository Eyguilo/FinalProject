<?php

ini_set('display_errors', 'On');
ini_set('html_errors', 1);

class ListBicyclesDataAccess
{

    function __construct()
    {
    }

    function findBicycles($sentence)
    {
        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');
        $query = mysqli_prepare($connection, $sentence);
        $query->execute();
        $result = $query->get_result();

        return $result;
    }

    function findBrands()
    {
        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');
        $query = mysqli_prepare($connection, "SELECT b.name FROM T_Brands b;");
        $query->execute();
        $result = $query->get_result();

        return $result;
    }

    function findModels()
    {
        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');
        $query = mysqli_prepare($connection, "SELECT m.name FROM T_Models m;");
        $query->execute();
        $result = $query->get_result();

        return $result;
    }

    function findSizes()
    {
        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');
        $query = mysqli_prepare($connection, "SELECT s.size_cm FROM T_Size s;");
        $query->execute();
        $result = $query->get_result();

        return $result;
    }
}