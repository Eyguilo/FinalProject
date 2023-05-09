<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

require_once("../infraestructure/createClientDataAccess.php");

class CreateClientBusinessLaw
{
    public function __construct()
    {
    }

    public function createClient($name, $lastName, $email, $phone, $address, $postalCode)
    {
        $createClientDataAccess = new CreateClientDataAccess();
        $result = $createClientDataAccess->createClient($name, $lastName, $email, $phone, $address,  $postalCode);
        return $result;
    }
}