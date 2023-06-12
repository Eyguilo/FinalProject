<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

require_once("../infraestructure/BookingDataAccess.php");
require_once("BicycleBusinessLaw.php");

class BookingBusinessLaw
{
    function __construct()
    {
    }

    function createBookingInvoice($bookingData, $datesData, $bicyclesId)
    {
        $bookingDataAccess = new BookingDataAccess();

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
            $price = $bookingDataAccess->priceBicycles($bike);
            $totalPrice += $price;
        }

        $startDate = new DateTime($datesData[0]);
        $endDate = new DateTime($datesData[1]);
        $diff = $startDate->diff($endDate);
        $numDays = $diff->days;

        if ($numDays >= 3) {
            $increment = $totalPrice * 0.02 * ($numDays - 2);
            $totalPrice += $increment;
        }

        $locator = $this->generateLocator();

        $bookingDataAccess->createBooking($bookingData, $locator, $totalPrice);

        $bicycleBusinessLaw = new BicycleBusinessLaw();
        $bicycleBusinessLaw->updateToNotAvailableBicyle($bicyclesId);

        return $locator;
    }

    function findBooking($filter)
    {
        $query = "SELECT r.code_locator, c.name, c.last_name, r.id_user,  r.start_date, r.end_date, r.id_bicycle_1, r.id_bicycle_2, r.id_bicycle_3, r.id_bicycle_4, i.reservation_date, r.state_reservation, r.last_modification_date 
        FROM T_Reservations r INNER JOIN T_Clients c ON r.id_client = c.id_client INNER JOIN T_Invoices i ON r.code_locator = i.code_locator WHERE 1 = 1";

        if (!empty($filter[0])) {
            $query .= " AND BINARY r.code_locator LIKE '" . $filter[0] . "%'";
        }

        if (!empty($filter[2])) {
            $query .= " AND r.state_reservation LIKE '" . $filter[2] . "'";
        }

        if (!empty($filter[1])) {
            if ($filter[1] == "NEWEST") {
                $query .= " ORDER BY i.reservation_date DESC";
            } elseif ($filter[1] == "OLDEST") {
                $query .= " ORDER BY i.reservation_date ASC";
            }
        }

        if (!empty($filter[3])) {
            $query .= " AND BINARY r.id_user LIKE '" . $filter[3] . "%'";
        }

        if (!empty($filter[4])) {
            $nameParts = explode(' ', $filter[4]);
            $nameClient = $nameParts[0];
            $lastNameClient = isset($nameParts[1]) ? $nameParts[1] : '';
    
            $query .= " AND c.name LIKE '" . $nameClient . "%'";

            if($lastNameClient != ''){
                $query .= " AND c.last_name LIKE '" . $lastNameClient . "%'";
            }
        }

        $createBookingDataAccess = new BookingDataAccess();
        $result = $createBookingDataAccess->listBookings($query);

        return $result;
    }

    function findInvoiceBookingByLocator($locator)
    {
        $bookingDataAccess = new BookingDataAccess();
        $result = $bookingDataAccess->findInvoiceBookingDataByLocator($locator);

        return $result;
    }

    function updateStateBooking($locator, $state)
    {

        $bookingDataAccess = new BookingDataAccess();
        $bookingDataAccess->updateStateBooking($locator, $state);

    }

    function deleteBooking($locator)
    {

        $bookingDataAccess = new BookingDataAccess();
        $bookingDataAccess->deleteBooking($locator);

    }

    private function generateLocator()
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