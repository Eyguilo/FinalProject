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

        // if (!empty($filter[0])) {
        //     $query .= " AND BINARY r.code_locator LIKE '" . $filter[0] . "%'";
        // }

        // if (!empty($filter[2])) {
        //     $query .= " AND r.state_reservation LIKE '" . $filter[2] . "'";
        // }

        // if (!empty($filter[1])) {
        //     if ($filter[1] == "NEWEST") {
        //         $query .= " ORDER BY i.reservation_date DESC";
        //     } elseif ($filter[1] == "OLDEST") {
        //         $query .= " ORDER BY i.reservation_date ASC";
        //     }
        // }

        $usersDataAccess = new UserDataAccess();
        $result = $usersDataAccess->listUsers($query);

        return $result;
    }

    function verifyUser($userId, $key)
    {

        $logInDataAccess = new UserDataAccess();
        $result = $logInDataAccess->verifyUser($userId, $key);
        return $result;
    }
}