<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

require_once("../infraestructure/createBookingDataAccess.php");

class CreateBookingBusinessLaw
{
    public function __construct()
    {
    }

    function createBookingInvoice($bookingData, $dateData, $bicyclesId)
    {
        $createBookingDataAccess = new CreateBookingDataAccess();

        if ($bookingData[5] == "") {
            $bookingData[5] = null;
        }
        if ($bookingData[6] == "") {
            $bookingData[6] = null;
        }
        if ($bookingData[7] == "") {
            $bookingData[7] = null;
        }

        $totalPrice = 0;
        foreach ($bicyclesId as $bike) {
            $price = $createBookingDataAccess->priceBicycles($bike);
            $totalPrice += $price;
        }

        $startDate = new DateTime($dateData[0]);
        $endDate = new DateTime($dateData[1]);
        $diff = $startDate->diff($endDate);
        $numDays = $diff->days;

        if ($numDays >= 3) {
            $increment = $totalPrice * 0.02 * ($numDays - 2);
            $totalPrice += $increment;
        }
        
        $createBookingDataAccess->createBooking($bookingData, $totalPrice);

        return $totalPrice;
    }
}