<?php

ini_set('display_errors', 'On');
ini_set('html_errors', 1);

class ClientDataAccess
{

    function __construct()
    {
    }

    function createClient($name, $lastName, $email, $phone, $address, $postalCode)
    {

        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');
        $query = mysqli_prepare($connection, "INSERT INTO T_Clients (name, last_name, email, phone, address, postal_code) VALUES (?,?,?,?,?,?);");
        $query->bind_param("sssssi", $name, $lastName, $email, $phone, $address, $postalCode);
        $result = $query->execute();

        $this->queryError($query, $connection);

        return $result;
    }

    function listClients($sentence)
    {
        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');
        $query = mysqli_prepare($connection, $sentence);
        $query->execute();

        $this->queryError($query, $connection);

        $result = $query->get_result();

        return $result;
    }

    public function deleteClient($clientId)
    {
        $connection = mysqli_connect('localhost', 'root', '1234');
        if (mysqli_connect_errno()) {
            echo "Error connecting to MySQL: " . mysqli_connect_error();
        }

        mysqli_select_db($connection, 'db_bicycle_renting');
        $query = mysqli_prepare($connection, "DELETE FROM T_Clients WHERE id_client = (?)");
        $query->bind_param("i", $clientId);
        $result = $query->execute();

        $this->queryError($query, $connection);

        return $result;
    }


    private function queryError($query, $connection)
    {

        if ($query === false) {
            echo "Error executing query: " . mysqli_error($connection);
        }
    }
}