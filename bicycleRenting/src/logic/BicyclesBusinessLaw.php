<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

require_once("../infraestructure/BicyclesDataAccess.php");

class BicyclesBusinessLaw
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

        $bicyclesDataAccess = new BicyclesDataAccess();
        $result = $bicyclesDataAccess->findBicycles($query);

        return $result;
    }

    public function findBrands()
    {
        $bicyclesDataAccess = new BicyclesDataAccess();
        $result = $bicyclesDataAccess->findBrands();

        $brands = array();
        while ($myrow = $result->fetch_row()) {
            array_push($brands, $myrow);
        }
        return $brands;
    }

    public function findModels()
    {
        $bicyclesDataAccess = new BicyclesDataAccess();
        $result = $bicyclesDataAccess->findModels();

        $models = array();
        while ($myrow = $result->fetch_row()) {
            array_push($models, $myrow);
        }
        return $models;
    }

    public function findSizes()
    {
        $bicyclesDataAccess = new BicyclesDataAccess();
        $result = $bicyclesDataAccess->findSizes();

        $sizes = array();
        while ($myrow = $result->fetch_row()) {
            array_push($sizes, $myrow);
        }
        return $sizes;
    }
}