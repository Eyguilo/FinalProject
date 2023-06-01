<?php

ini_set('display_errors', 'On');
ini_set('html_errors', 1);

class CreateBookingDataAccess
{

    function __construct()
    {
    }

    function createBooking($bookingData, $locator, $totalPrice)
    {

        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');
        $query = mysqli_prepare($connection, "INSERT INTO T_Reservations (code_locator, id_client, id_user, start_date, end_date, id_bicycle_1, id_bicycle_2, id_bicycle_3, id_bicycle_4) VALUES (?,?,?,?,?,?,?,?,?);");
        $query->bind_param("sisssiiii", $locator, $bookingData[0], $bookingData[1], $bookingData[2], $bookingData[3], $bookingData[4], $bookingData[5], $bookingData[6], $bookingData[7]);
        $query->execute();

        $this->queryError($query, $connection);

        $query = mysqli_prepare($connection, "INSERT INTO T_Invoices (code_locator, total_price) VALUES (?, ?);");
        $query->bind_param("sd", $locator, $totalPrice);
        $query->execute();

        $this->queryError($query, $connection);
    }

    function priceBicycles($idBicycle)
    {
        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');

        $query = mysqli_prepare($connection, "SELECT b.rental_price_hour FROM T_Bicycles b WHERE b.id_bicycle = (?);");
        $idBicycle = mysqli_real_escape_string($connection, $idBicycle);
        $query->bind_param("i", $idBicycle);
        $query->execute();

        $this->queryError($query, $connection);

        $result = $query->get_result();

        $price = null;
        if ($row = $result->fetch_assoc()) {
            $price = $row['rental_price_hour'];
        }

        return $price;
    }

    function listReservations($sentence)
    {
        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');

        $query = mysqli_prepare($connection, $sentence);
        $query->execute();

        $this->queryError($query, $connection);

        $result = $query->get_result();

        return $result;
    }

    private function queryError($query, $connection)
    {

        if ($query === false) {
            echo "Error executing query: " . mysqli_error($connection);
            return false;
        }
    }

}