<?php
require("../infraestructure/UserDataAccess.php");

class UserBusinessLaw
{
    function __construct()
    {
    }

    function createUser($userData)
    {
        $passwordConfirmation = $userData[4];

        unset($userData[4]);

        if ($userData[3] != $passwordConfirmation) {
            return "Passwords are not the same.";
        }

        $logInDataAccess = new UserDataAccess();
        $result = $logInDataAccess->createUser($userData);

        return $result;
    }

    function listUsers($filter)
    {
        $query = "SELECT u.name, u.last_name, u.id_user, u.profile_user FROM T_Users u WHERE 1 = 1";

        if (!empty($filter[0])) {
            $query .= " AND BINARY u.id_user LIKE '" . $filter[0] . "%'";
        }

        if (!empty($filter[1])) {
            if ($filter[1] == "Administrator") {
                $query .= " AND u.profile_user LIKE '" . $filter[1] . "'";
            } elseif ($filter[1] == "Worker") {
                $query .= " AND u.profile_user LIKE '" . $filter[1] . "'";
            }
        }

        $usersDataAccess = new UserDataAccess();
        $result = $usersDataAccess->listUsers($query);

        return $result;
    }

    function verifyUser($userId, $key)
    {

        $usersDataAccess = new UserDataAccess();
        $result = $usersDataAccess->verifyUser($userId, $key);
        return $result;
    }

    public function deleteUser($userCodeToEliminate)
    {

        $usersDataAccess = new UserDataAccess();
        $result = $usersDataAccess->deleteUser($userCodeToEliminate);
        return $result;
    }
}