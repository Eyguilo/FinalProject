<?php
ini_set('display_errors', 'On');
ini_set('html_errors', 1);

require_once("../infraestructure/menuStartDataAccess.php");

class MenuStartBusinessLaw
{
    private $_USERID;
    private $_NAME;
    private $_PROFILEUSER;


    public function __construct()
    {
    }

    private function init($userId, $name, $prfofileUser)
    {
        $this->_USERID = $userId;
        $this->_NAME = $name;
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

    public function getProfileUser()
    {
        return $this->_PROFILEUSER;
    }

    public function obtainUserData($userId)
    {
        $menuStartAdminDataAccess = new MenuStartDataAccess();
        $dataObtained = $menuStartAdminDataAccess->obtainUserData($userId);

        foreach ($dataObtained as $user) {
            $menuStartAdminBusinessLaw = new MenuStartBusinessLaw();
            $menuStartAdminBusinessLaw->init($user['id_user'], $user['name'], $user['profile_user']);
        }

        return $menuStartAdminBusinessLaw;
    }
}