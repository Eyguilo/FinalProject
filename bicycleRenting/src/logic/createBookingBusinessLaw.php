<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

require_once("../infraestructure/createBookingDataAccess.php");

class CreateBookingDataAccess
{
    private $_USERID;
    private $_NAME;
    private $_LASTNAME;
    private $_PROFILEUSER;


    public function __construct()
    {
    }

    private function init($userId, $name, $lastName, $prfofileUser)
    {
        $this->_USERID = $userId;
        $this->_NAME = $name;
        $this->_LASTNAME = $lastName;
        $this->_PROFILEUSER = $prfofileUser;
    }

    public function getUserId()
    {
        return $this->_USERID;
    }

    public function getName()
    {
        return $this->_NAME;
    }

    public function getLastName()
    {
        return $this->_LASTNAME;
    }

    public function getProfileUser()
    {
        return $this->_PROFILEUSER;
    }

    public function obtainUserData($userId)
    {
        $menuStartAdminDataAccess = new MenuStartAdminDataAccess();
        $dataObtained = $menuStartAdminDataAccess->obtainUserData($userId);

        foreach ($dataObtained as $user) {
            $menuStartAdminBusinessLaw = new MenuStartAdminBusinessLaw();
            $menuStartAdminBusinessLaw->init($user['id_user'], $user['name'], $user['last_name'], $user['profile_user']);
        }

        return $menuStartAdminBusinessLaw;
    }
}