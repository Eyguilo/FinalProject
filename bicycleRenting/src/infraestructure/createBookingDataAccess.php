<?php

ini_set('display_errors', 'On');
ini_set('html_errors', 1);

class CreateBookingDataAccess
{

    function __construct()
    {
    }

    function createBooking($bookingData){

        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');
        $query = mysqli_prepare($connection, "INSERT INTO T_Reservations (id_client, id_user, start_date, end_date, id_bicycle_1, id_bicycle_2, id_bicycle_3, id_bicycle_4) VALUES (?,?,?,?,?,?,?,?);");
        $query->bind_param("isssiiii", $bookingData[0], $bookingData[1], $bookingData[2], $bookingData[3], $bookingData[4], $bookingData[5], $bookingData[6], $bookingData[7]);
        $result = $query->execute();

        return $result;
    }

}