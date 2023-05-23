<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

require_once("../infraestructure/createBookingDataAccess.php");

class CreateBookingBusinessLaw
{

    public function __construct()
    {
    }

    function createBooking($bookingData){
        
        $bookingData[4] = intval($bookingData[4]);

        if(empty($bookingData[5])){
            $bookingData[5] = 0;
        } else{
            $bookingData[5] = intval($bookingData[5]);
        }
        if(empty($bookingData[6])){
            $bookingData[6] = 0;
        } else{
            $bookingData[6] = intval($bookingData[6]);
        }
        if(empty($bookingData[7])){
            $bookingData[7] = 0;
        } else{
            $bookingData[7] = intval($bookingData[7]);
        }
        
        var_dump($bookingData);
        $createBookingDataAccess = new CreateBookingDataAccess();
        $result = $createBookingDataAccess->createBooking($bookingData);

        return $result;
    }
}