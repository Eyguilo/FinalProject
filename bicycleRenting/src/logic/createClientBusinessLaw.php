<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

require_once("../infraestructure/createClientDataAccess.php");

class CreateClientBusinessLaw
{
    private $_NAME;
    private $_LASTNAME;
    private $_EMAIL;
    private $_PHONE;
    private $_ADDRESS;



    public function __construct()
    {
    }

    private function init($name, $lastName, $email, $phone, $address)
    {
        $this->_NAME = $name;
        $this->_LASTNAME = $lastName;
        $this->_EMAIL = $email;
        $this->_PHONE = $phone;
        $this->_ADDRESS = $address;
    }

    public function getName()
    {
        return $this->_NAME;
    }

    public function getLastName()
    {
        return $this->_LASTNAME;
    }

    public function getEmail()
    {
        return $this->_EMAIL;
    }

    public function getPhone()
    {
        return $this->_PHONE;
    }

    public function getAddress()
    {
        return $this->_ADDRESS;
    }

    public function createClient($name, $lastName, $email, $phone, $address)
    {
        $createClientDataAccess = new CreateClientDataAccess();
        $result = $createClientDataAccess->createClient($name, $lastName, $email, $phone, $address);
        return $result;
    }
}