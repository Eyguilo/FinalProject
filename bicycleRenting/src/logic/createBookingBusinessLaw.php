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

        $createBookingDataAccess->createBooking($bookingData, $this->generateFlightLocator(), $totalPrice);

        return $totalPrice;
    }

    public function findReservations($filter)
    {
        $query = "SELECT r.code_locator, c.name, c.last_name, r.id_user,  r.start_date, r.end_date, r.id_bicycle_1, r.id_bicycle_2, r.id_bicycle_3, r.id_bicycle_4, r.reservation_date, r.state_reservation, r.last_modification_date 
        FROM T_Reservations r INNER JOIN T_Clients c ON r.id_client = c.id_client WHERE 1 = 1";

        if (!empty($filter[0])) {
            $query .= " AND r.state_reservation LIKE '" . $filter[0] . "'";
        }

        $createBookingDataAccess = new CreateBookingDataAccess();
        $result = $createBookingDataAccess->listReservations($query);

        return $result;
    }

    private function generateFlightLocator()
    {
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $locator = '';

        for ($i = 0; $i < 6; $i++) {
            $randomIndex = rand(0, strlen($characters) - 1);
            $locator .= $characters[$randomIndex];
        }

        return $locator;
    }
}