<?php

ini_set('display_errors', 'On');
ini_set('html_errors', 1);

class ListBicyclesDataAccess
{

    function __construct()
    {
    }

    function findBicycles()
    {
        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');
        $query = mysqli_prepare($connection, "SELECT b.id_bicycle as id, br.name as brand, m.name as model, s.size_cm as size, b.color as color, b.rental_price_hour as price, b.available as available
        FROM T_Bicycles b
        INNER JOIN T_Brands br ON b.id_brand = br.id_brand
        INNER JOIN T_Size s ON b.id_size = s.id_size
        INNER JOIN T_Models m ON b.id_model = m.id_model;");
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
}