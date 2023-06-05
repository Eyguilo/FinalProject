<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

require_once("../infraestructure/ClientDataAccess.php");

class ClientBusinessLaw
{
    public function __construct()
    {
    }

    public function createClient($name, $lastName, $email, $phone, $address, $postalCode)
    {
        $clientDataAccess = new ClientDataAccess();
        $result = $clientDataAccess->createClient($name, $lastName, $email, $phone, $address,  $postalCode);
        return $result;
    }
}