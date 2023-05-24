<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

require_once("../infraestructure/createBookingDataAccess.php");

class CreateBookingBusinessLaw
{
    public function __construct()
    {
    }

    function createBooking($bookingData)
    {
        if ($bookingData[5] == "") {
            $bookingData[5] = null;
        }
        if ($bookingData[6] == "") {
            $bookingData[6] = null;
        }
        if ($bookingData[7] == "") {
            $bookingData[7] = null;
        }

        $createBookingDataAccess = new CreateBookingDataAccess();
        $result = $createBookingDataAccess->createBooking($bookingData);
        return $result;
    }
}