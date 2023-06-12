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
        $result = $clientDataAccess->createClient($name, $lastName, $email, $phone, $address, $postalCode);
        return $result;
    }

    function listClients($filter)
    {
        $query = "SELECT c.id_client, c.name, c.last_name, c.email, c.phone, c.address, c.postal_code FROM T_Clients c WHERE 1 = 1";


    
        if (!empty($filter[0])) {
            $nameParts = explode(' ', $filter[0]);
            $nameClient = $nameParts[0];
            $lastNameClient = isset($nameParts[1]) ? $nameParts[1] : '';
    
            $query .= " AND c.name LIKE '" . $nameClient . "%'";

            if($lastNameClient != ''){
                $query .= " AND c.last_name LIKE '" . $lastNameClient . "%'";
            }
        }
    
        $clientDataAccess = new ClientDataAccess();
        $result = $clientDataAccess->listClients($query);
    
        return $result;
    }

    public function deleteClient($clientId)
    {
        $clientDataAccess = new ClientDataAccess();
        $result = $clientDataAccess->deleteClient($clientId);
        return $result;
    }

}