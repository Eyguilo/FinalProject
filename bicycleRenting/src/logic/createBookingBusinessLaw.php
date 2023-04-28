<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

require_once("../infraestructure/createBookingDataAccess.php");

class CreateBookingBusinessLaw
{

    public function __construct()
    {
    }


    public function findClients($completeName)
    {

        $nameParts = explode(" ", $completeName);
        $name = $nameParts[0];
        $lastName = $nameParts[1];

        $createBookingDataAccess = new CreateBookingDataAccess();
        $createBookingDataAccess->findClients($name, $lastName);

        echo var_dump($dataObtained);

        $clientsName = array();
        while ($myrow = $createBookingDataAccess->mysqli_fetch_row()) {
            array_push($clientsName, $myrow);
        }

        return $clientsName;
    }
}