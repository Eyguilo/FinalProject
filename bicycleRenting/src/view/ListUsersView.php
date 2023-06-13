<?php

try {

    session_start();
    $userId = $_SESSION['userId'];
    if (!isset($userId)) {
        header("Location: LogInView.php");
    }

    require_once("../logic/UserBusinessLaw.php");
    $userBusinessLaw = new UserBusinessLaw();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $filterData = array($_POST['userCode'], $_POST['userProfile']);
        $filteredUsers = $userBusinessLaw->listUsers($filterData);

        if (!empty($_POST['userCode'])) {

            if ($_POST['userCode'] != $userId) {
                $userBusinessLaw->deleteUser($_POST['userCode']);

                $filterData = array("", "");
                $filteredUsers = $userBusinessLaw->listUsers($filterData);
            } else {
                $errorMessage = "You can not remove yourself from the system.";
            }
        }

    } else {

        $falseFilter = "";
        $filteredUsers = $userBusinessLaw->listUsers($falseFilter);
    }

} catch (Exception $e) {
    header("Location: ErrorView.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List users</title>
    <link rel="stylesheet" href="../../css/listUsers.css">
    <link rel="stylesheet" href="../../images/bicycle.svg" type="image/x-icon">
    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M4 4.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1v.5h4.14l.386-1.158A.5.5 0 0 1 11 4h1a.5.5 0 0 1 0 1h-.64l-.311.935.807 1.29a3 3 0 1 1-.848.53l-.508-.812-2.076 3.322A.5.5 0 0 1 8 10.5H5.959a3 3 0 1 1-1.815-3.274L5 5.856V5h-.5a.5.5 0 0 1-.5-.5zm1.5 2.443-.508.814c.5.444.85 1.054.967 1.743h1.139L5.5 6.943zM8 9.057 9.598 6.5H6.402L8 9.057zM4.937 9.5a1.997 1.997 0 0 0-.487-.877l-.548.877h1.035zM3.603 8.092A2 2 0 1 0 4.937 10.5H3a.5.5 0 0 1-.424-.765l1.027-1.643zm7.947.53a2 2 0 1 0 .848-.53l1.026 1.643a.5.5 0 1 1-.848.53L11.55 8.623z'/%3E%3C/svg%3E">
</head>

<body>
    <div id="container">
        <div id="back-button">
            <a href="MenuStartView.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                    <path
                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                </svg>
            </a>
        </div>
        <div id="centralList">
            <div id="create">
                <div class="table">
                    <table>
                        <thead>
                            <tr>

                                <form id="listBicyclesForm" method="POST"
                                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <th>
                                        <input type="text" id="userCode" name="userCode" autocomplete="off"
                                            placeholder="JMGL000" onchange="this.form.submit()">
                                    </th>
                                    <th>
                                        <label for="name">Name</label>
                                    </th>
                                    <th>
                                        <select id="userProfile" name="userProfile" onchange="this.form.submit()">
                                            <?php
                                            $selectedUser = isset($_POST['userProfile']) ? $_POST['userProfile'] : "";
                                            echo "<option value='' selected>Select profile</option>";
                                            echo "<option value='Administrator' " . ($selectedUser == 'Administrator' ? 'selected' : '') . ">Administrator</option>";
                                            echo "<option value='Worker' " . ($selectedUser == 'Worker' ? 'selected' : '') . ">Worker</option>";
                                            ?>
                                        </select>
                                    </th>
                                    <th>
                                    </th>
                                </form>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            foreach ($filteredUsers as $user) {
                                $deleteFormId = "deleteUserForm" . $i;
                                echo "
                                    <tr>
                                        <td>" . $user['id_user'] . "</td>
                                        <td>" . $user['name'] . " " . $user['last_name'] . "</td>
                                        <td>" . $user['profile_user'] . "</td>
                                        <td>";
                                if ($user['id_user'] != "CLNT000") {
                                    echo "                                         <form action='ListUsersView.php' method='POST' class='deleteUserForm' id='" . $deleteFormId . "'>
                                            <input type='hidden' name='userCode' value='" . $user['id_user'] . "'>
                                            <input type='hidden' name='userProfile' value=''>
                                            <button id='deleteUser' type='submit'>
                                                <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash' viewBox='0 0 16 16'>
                                                    <path d='M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z'/>
                                                    <path d='M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z'/>
                                                </svg>
                                            </button>
                                        </form>";
                                }
                                echo "
                                        </td>
                                    </tr>";
                                $i++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../../js/EliminateButtonUser.js"></script>
    </div>
    <?php
    if (!empty($errorMessage)) {
        echo "<p class='errorMessage'>$errorMessage</p>";
    }
    ?>
</body>

</html>