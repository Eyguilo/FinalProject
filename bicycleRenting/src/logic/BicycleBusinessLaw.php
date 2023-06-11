<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

require_once("../infraestructure/BicycleDataAccess.php");
require_once("BookingBusinessLaw.php");

class BicycleBusinessLaw
{
    public function __construct()
    {
    }

    public function findBicycles($filter)
    {

        $query = "SELECT b.id_bicycle as id, br.name as brand, m.name as model, s.size_cm as size, b.color as color, b.rental_price_hour as price, b.available as available
        FROM T_Bicycles b
        INNER JOIN T_Brands br ON b.id_brand = br.id_brand
        INNER JOIN T_Size s ON b.id_size = s.id_size
        INNER JOIN T_Models m ON b.id_model = m.id_model WHERE 1 = 1";

        if (!empty($filter[0])) {
            $query .= " AND br.id_brand = " . $filter[0];
        }

        if (!empty($filter[1])) {
            $query .= " AND m.id_model = " . $filter[1];
        }

        if (!empty($filter[2])) {
            $query .= " AND s.id_size = " . $filter[2];
        }
        if (!empty($filter[3])) {
            if ($filter[3] == 1) {
                $query .= " AND b.available = 1";
            } else {
                $query .= " AND b.available = 0";
            }
        }

        $bicyclesDataAccess = new BicycleDataAccess();
        $result = $bicyclesDataAccess->findBicycles($query);

        return $result;
    }

    public function findBrands()
    {
        $bicyclesDataAccess = new BicycleDataAccess();
        $result = $bicyclesDataAccess->findBrands();

        $brands = array();
        while ($myrow = $result->fetch_row()) {
            array_push($brands, $myrow);
        }
        return $brands;
    }

    public function findModels()
    {
        $bicyclesDataAccess = new BicycleDataAccess();
        $result = $bicyclesDataAccess->findModels();

        $models = array();
        while ($myrow = $result->fetch_row()) {
            array_push($models, $myrow);
        }
        return $models;
    }

    public function findSizes()
    {
        $bicyclesDataAccess = new BicycleDataAccess();
        $result = $bicyclesDataAccess->findSizes();

        $sizes = array();
        while ($myrow = $result->fetch_row()) {
            array_push($sizes, $myrow);
        }
        return $sizes;
    }

    function updateToNotAvailableBicyle($bicyclesId)
    {
        $bicycleDataAccess = new BicycleDataAccess();

        foreach ($bicyclesId as $id) {
            $bicycleDataAccess->updateToNotAvailableBicycle($id);
        }
    }

    function updateToAvailableBicycle($locator)
    {
        $bookingBusinessLaw = new BookingBusinessLaw();
        $bicycleDataAccess = new BicycleDataAccess();

        $booking = $bookingBusinessLaw->findInvoiceBookingByLocator($locator);

        $bicyclesListToAvailable = array($booking[0]['id_bicycle_1'], $booking[0]['id_bicycle_2'], $booking[0]['id_bicycle_3'], $booking[0]['id_bicycle_4']);

        foreach ($bicyclesListToAvailable as $idBicycle) {
            
            $bicycleDataAccess->updateToAvailableBicycle($idBicycle);
        }
    }
}