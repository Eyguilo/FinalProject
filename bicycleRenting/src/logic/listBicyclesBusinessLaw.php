<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

require_once("../infraestructure/listBicyclesDataAccess.php");

class ListBicyclesBusinessLaw
{
    private $_ID;
    private $_BRAND;
    private $_MODEL;
    private $_SIZE;
    private $_COLOR;
    private $_PRICE;
    private $_AVAILABLE;



    public function __construct()
    {
    }

    private function init($id, $brand, $model, $size, $color, $price, $available)
    {
        $this->_ID = $id;
        $this->_BRAND = $brand;
        $this->_MODEL = $model;
        $this->_SIZE = $size;
        $this->_COLOR = $color;
        $this->_PRICE = $price;
        $this->_AVAILABLE = $available;
    }

    public function getId()
    {
        return $this->_ID;
    }

    public function getBrand()
    {
        return $this->_BRAND;
    }

    public function getModel()
    {
        return $this->_MODEL;
    }

    public function getSize()
    {
        return $this->_SIZE;
    }

    public function getColor()
    {
        return $this->_COLOR;
    }

    public function getPrice()
    {
        return $this->_PRICE;
    }

    public function getAvailable()
    {
        return $this->_AVAILABLE;
    }

    public function findBicyles()
    {
        $listBicyclesDataAccess = new ListBicyclesDataAccess();
        $result = $listBicyclesDataAccess->findBicycles();

        foreach ($result as $bike) {
            $listBicyclesBusinessLaw = new ListBicyclesBusinessLaw();
            $listBicyclesBusinessLaw->init($bike['id'], $bike['brand'], $bike['model'], $bike['size'], $bike['color'], $bike['price'], $bike['available']);
        }
        return $result;
    }

    public function findBrands()
    {
        $listBicyclesDataAccess = new ListBicyclesDataAccess();
        $result = $listBicyclesDataAccess->findBrands();

        $brands =  array();
        while ($myrow = $result->fetch_row()) {
            array_push($brands, $myrow);
        }
        return $brands;
    }
}