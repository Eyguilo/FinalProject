<?php
session_start();
$userId = $_SESSION['userId'];
if (!isset($userId)) {
    header("Location: LogInView.php");
}

require_once("../logic/UserBusinessLaw.php");
$clientBusinessLaw = new UserBusinessLaw();

$errorMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $createClientBusinessLaw = new UserBusinessLaw();
    $userData = array($_POST['userCode'], $_POST['userName'], $_POST['userLastName'], $_POST['password1'], $_POST['password2'], $_POST['profileUser']);

    try {
        $create = $createClientBusinessLaw->createUser($userData);
        if ($_POST['password1'] == $_POST['password2']) {
            header("Location: MenuStartView.php");
        } else {
            $errorMessage = "Passwords are not the same.";
        }
    } catch (Exception $e) {
        $errorMessage = "This user code is already introduced.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create user</title>
    <link rel="stylesheet" href="../../css/createUser.css">
</head>

<body>
    <div id="container">
        <div id="central">
            <div id="create">
                <div id="back-button">
                    <a href="MenuStartView.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-house-fill" viewBox="0 0 16 16">
                            <path
                                d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                            <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                        </svg>
                    </a>
                </div>
                <div class="title">Create user</div>
                <form method="POST" action="CreateUserView.php">
                    <div class="form-group">
                        <label for="userName">Client name:</label>
                        <input type="text" id="userName" name="userName" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="userLastName">Last name:</label>
                        <input type="text" id="userLastName" name="userLastName" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <label for="userCode">Code:</label>
                        <input type="text" id="userCode" name="userCode" pattern="[A-Z]{4}[0-9]{3}"
                            placeholder="4 capital letters 3 numbers" required autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password1">Password:</label>
                        <input type="password" id="password1" name="password1" required>
                    </div>
                    <div class="form-group">
                        <label for="password2">Repeat the password:</label>
                        <input type="password" id="password2" name="password2" required>
                    </div>
                    <div class="form-group">
                        <label for="profileUser">Profile:</label>
                        <select id="profileUser" name="profileUser" required>
                            <option value="" disabled selected>Select profile</option>
                            <option value="Administrator">Administrator</option>
                            <option value="Worker">Worker</option>
                        </select>
                    </div>
                    <input type="submit" value="Create user">
                </form>
                <?php
                if (!empty($errorMessage)) {
                    echo "<p class='errorMessage'>$errorMessage</p>";
                }
                ?>
            </div>
        </div>
    </div>
</body>

</html>