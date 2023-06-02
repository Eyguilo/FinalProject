<?php
session_start();
$userId = $_SESSION['userId'];
if (!isset($userId)) {
    header("Location: logInView.php");
}

require_once("../logic/listBicyclesBusinessLaw.php");
$listBicyclesBusinessLaw = new ListBicyclesBusinessLaw();

require_once("../logic/createBookingBusinessLaw.php");
$createBookingBusinessLaw = new CreateBookingBusinessLaw();

$listBicyclesPostValues = array(
    'brand' => isset($_POST['brand']) ? $_POST['brand'] : '',
    'model' => isset($_POST['model']) ? $_POST['model'] : '',
    'size' => isset($_POST['size']) ? $_POST['size'] : '',
    'available' => isset($_POST['available']) ? $_POST['available'] : ''
);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $listBicyclesBusinessLaw = new ListBicyclesBusinessLaw();
    $filterData = array($listBicyclesPostValues['brand'], $listBicyclesPostValues['model'], $listBicyclesPostValues['size'], $listBicyclesPostValues['available']);
    $filteredBicycles = $listBicyclesBusinessLaw->findBicycles($filterData);

    if (!empty($_POST['clientList'])) {

        $bookingData = array($_POST['clientList'], $userId, $_POST['startDate'], $_POST['endDate'], $_POST['bicycle1'], $_POST['bicycle2'], $_POST['bicycle3'], $_POST['bicycle4']);
        $dateData = array($_POST['startDate'], $_POST['endDate']);
        $bicyclesId = array($_POST['bicycle1'], $_POST['bicycle2'], $_POST['bicycle3'], $_POST['bicycle4']);
        $createBookingBusinessLaw->createBookingInvoice($bookingData, $dateData, $bicyclesId);

        header("Location: menuStartView.php");
        exit();
    }
} else {
    $falseFilter = "";
    $filteredBicycles = $listBicyclesBusinessLaw->findBicycles($falseFilter);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create booking</title>
    <link rel="stylesheet" href="../../css/createBooking.css">
    <link rel="stylesheet" href="../../images/bicycle.svg" type="image/x-icon">
    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M4 4.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1v.5h4.14l.386-1.158A.5.5 0 0 1 11 4h1a.5.5 0 0 1 0 1h-.64l-.311.935.807 1.29a3 3 0 1 1-.848.53l-.508-.812-2.076 3.322A.5.5 0 0 1 8 10.5H5.959a3 3 0 1 1-1.815-3.274L5 5.856V5h-.5a.5.5 0 0 1-.5-.5zm1.5 2.443-.508.814c.5.444.85 1.054.967 1.743h1.139L5.5 6.943zM8 9.057 9.598 6.5H6.402L8 9.057zM4.937 9.5a1.997 1.997 0 0 0-.487-.877l-.548.877h1.035zM3.603 8.092A2 2 0 1 0 4.937 10.5H3a.5.5 0 0 1-.424-.765l1.027-1.643zm7.947.53a2 2 0 1 0 .848-.53l1.026 1.643a.5.5 0 1 1-.848.53L11.55 8.623z'/%3E%3C/svg%3E">
</head>

<body>
    <div id="container">
        <div id="back-button">
            <a href="menuStartView.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                    fill="currentColor" class="bi bi-house-fill" viewBox="0 0 16 16">
                    <path
                        d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L8 2.207l6.646 6.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.707 1.5Z" />
                    <path d="m8 3.293 6 6V13.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5V9.293l6-6Z" />
                </svg>
            </a>
        </div>
        <div id="centralBooking">
            <div id="create">
                <div class="title">Create Booking</div>
                <form id="createBookingForm" method="POST" action="createBookingView.php">
                    <div class="form-group">
                        <label>Worker:
                            <?php echo $userId; ?>
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="clientName">Client:</label>
                        <input type="text" id="clientName" name="clientName" autocomplete="off"
                            placeholder="ex. Jaume Aguiló"><br><br>
                        <select id="clientList" name="clientList" required>
                            <option value="" selected>Select a client</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="startDate">Give bicycles date:</label>
                        <input type="date" id="startDate" name="startDate" required min=<?php $today = date("Y-m-d");
                        echo $today; ?>>
                    </div>
                    <div class="form-group">
                        <label for="endDate">Return bicycles date:</label>
                        <input type="date" id="endDate" name="endDate" required min=<?php $today = date("Y-m-d");
                        echo $today; ?>>
                    </div>
                    <div class="form-group-2">
                        <label for="bicycle1">Bicycle 1:</label>
                        <input type="text" id="bicycle1" name="bicycle1" autocomplete="off" placeholder="1"
                            pattern="[1-9]|[1-9][0-9]{1,5}|1000000)" required>
                    </div>
                    <div class="form-group-2">
                        <label for="bicycle2">Bicycle 2:</label>
                        <input type="text" id="bicycle2" name="bicycle2" autocomplete="off" placeholder="2"
                            pattern="[1-9]|[1-9][0-9]{1,5}|1000000)">
                    </div>
                    <div class="form-group-2">
                        <label for="bicycle3">Bicycle 3:</label>
                        <input type="text" id="bicycle3" name="bicycle3" autocomplete="off" placeholder="3"
                            pattern="[1-9]|[1-9][0-9]{1,5}|1000000)">
                    </div>
                    <div class="form-group-2">
                        <label for="bicycle4">Bicycle 4:</label>
                        <input type="text" id="bicycle4" name="bicycle4" autocomplete="off" placeholder="4"
                            pattern="[1-9]|[1-9][0-9]{1,5}|1000000)">
                    </div>

                    <input type="submit" value="Create booking">
                </form>
            </div>
        </div>
        <div id="centralList">
            <div id="create">
                <div class="table">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <form id="listBicyclesForm" method="POST"
                                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <th>
                                        <label for="brand">Brand:</label>
                                        <select id="brand" name="brand" onchange="this.form.submit()">
                                            <?php
                                            $resultBrands = $listBicyclesBusinessLaw->findBrands();
                                            $valueBrand = 1;
                                            $selectedBrand = isset($_POST['brand']) ? $_POST['brand'] : "";
                                            echo "<option value='' selected>Select a brand</option>";
                                            foreach ($resultBrands as $brand) {
                                                $selected = ($selectedBrand == $valueBrand) ? "selected" : "";
                                                echo "<option value='" . $valueBrand . "' " . $selected . ">" . $brand[0] . "</option>";
                                                $valueBrand++;
                                            }
                                            ?>
                                        </select>
                                    </th>
                                    <th>
                                        <label for="model">Model:</label>
                                        <select id="model" name="model" onchange="this.form.submit()">
                                            <?php
                                            $resultModels = $listBicyclesBusinessLaw->findModels();
                                            $valueModel = 1;
                                            $selectedModel = isset($_POST['model']) ? $_POST['model'] : "";
                                            echo "<option value='' selected>Select a model</option>";
                                            foreach ($resultModels as $model) {
                                                $selected = ($selectedModel == $valueModel) ? "selected" : "";
                                                echo "<option value='" . $valueModel . "' " . $selected . ">" . $model[0] . "</option>";
                                                $valueModel++;
                                            }
                                            ?>
                                        </select>
                                    </th>
                                    <th>
                                        <label for="size">Size:</label>
                                        <select id="size" name="size" onchange="this.form.submit()">
                                            <?php
                                            $resultSizes = $listBicyclesBusinessLaw->findSizes();
                                            $valueSize = 1;
                                            $selectedSize = isset($_POST['size']) ? $_POST['size'] : "";
                                            echo "<option value='' selected>Select a size</option>";
                                            foreach ($resultSizes as $size) {
                                                $selected = ($selectedSize == $valueSize) ? "selected" : "";
                                                echo "<option value='" . $valueSize . "' " . $selected . ">" . $size[0] . "</option>";
                                                $valueSize++;
                                            }
                                            ?>
                                        </select>
                                    </th>
                                    <th>
                                        <label for="brand">Color</label>
                                    </th>
                                    <th>
                                        <label for="brand">Price / hour</label>
                                    </th>
                                    <th>
                                        <label for="available">Available</label>
                                        <select id="available" name="available" onchange="this.form.submit()">
                                            <?php
                                            $selectedAvailable = isset($_POST['available']) ? $_POST['available'] : "";
                                            echo "<option value='' selected>Select availability</option>";
                                            echo "<option value='1' " . ($selectedAvailable == '1' ? 'selected' : '') . ">Available</option>";
                                            echo "<option value='2' " . ($selectedAvailable == '2' ? 'selected' : '') . ">Not available</option>";
                                            ?>
                                        </select>
                                    </th>
                                </form>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($filteredBicycles as $bike) {
                                $availabilityClass = ($bike['available'] == 0) ? 'unavailable' : '';
                                echo "
                                    <tr class='" . $availabilityClass . "'>
                                        <td>" . $bike['id'] . "</td>
                                        <td>" . $bike['brand'] . "</td>
                                        <td>" . $bike['model'] . "</td>
                                        <td>" . $bike['size'] . "</td>
                                        <td>" . $bike['color'] . "</td>
                                        <td>" . $bike['price'] . "</td>
                                        <td>" . $bike['available'] . "</td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../../js/findClients.js"></script>
        <script src="../../js/confirmationBooking.js"></script>
    </div>
</body>

</html>