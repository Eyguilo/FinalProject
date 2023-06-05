<?php

session_start();
$userId = $_SESSION['userId'];
if (!isset($userId)) {
    header("Location: LogInView.php");
}

require_once("../logic/BookingBusinessLaw.php");
$bookingBusinessLaw = new BookingBusinessLaw();


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $bookingBusinessLaw = new BookingBusinessLaw();
    $filterData = array($_POST['state']);
    $reservations = $bookingBusinessLaw->findBooking($filterData);

} else {
    $falseFilter = "";
    $reservations = $bookingBusinessLaw->findBooking($falseFilter);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List bookings</title>
    <link rel="stylesheet" href="../../css/listBookings.css">
    <link rel="stylesheet" href="../../images/bicycle.svg" type="image/x-icon">
    <link rel="icon" type="image/svg+xml"
        href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M4 4.5a.5.5 0 0 1 .5-.5H6a.5.5 0 0 1 0 1v.5h4.14l.386-1.158A.5.5 0 0 1 11 4h1a.5.5 0 0 1 0 1h-.64l-.311.935.807 1.29a3 3 0 1 1-.848.53l-.508-.812-2.076 3.322A.5.5 0 0 1 8 10.5H5.959a3 3 0 1 1-1.815-3.274L5 5.856V5h-.5a.5.5 0 0 1-.5-.5zm1.5 2.443-.508.814c.5.444.85 1.054.967 1.743h1.139L5.5 6.943zM8 9.057 9.598 6.5H6.402L8 9.057zM4.937 9.5a1.997 1.997 0 0 0-.487-.877l-.548.877h1.035zM3.603 8.092A2 2 0 1 0 4.937 10.5H3a.5.5 0 0 1-.424-.765l1.027-1.643zm7.947.53a2 2 0 1 0 .848-.53l1.026 1.643a.5.5 0 1 1-.848.53L11.55 8.623z'/%3E%3C/svg%3E">
</head>

<body>
    <div id="container">
        <div id="homeButton">
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
                                <form id="listReservationsForm" method="POST"
                                    action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                    <th>
                                        <label for="clientName">Locator</label>
                                    </th>
                                    <th>
                                        <label for="idUser">Client</label>
                                    </th>
                                    <th>
                                        <label for="locator">ID User</label>
                                    </th>
                                    <th>
                                        <label for="startDate">Start date</label>
                                    </th>
                                    <th>
                                        <label for="endDate">End date</label>
                                    </th>
                                    <th>
                                        <label for="bike1">Bike 1</label>
                                    </th>
                                    <th>
                                        <label for="bike2">Bike 2</label>
                                    </th>
                                    <th>
                                        <label for="bike3">Bike 3</label>
                                    </th>
                                    <th>
                                        <label for="bike4">Bike 4</label>
                                    </th>
                                    <th>
                                        <label for="reservationDate">Reservation date</label>
                                    </th>
                                    <th>
                                        <select id="state" name="state" onchange="this.form.submit()">
                                            <?php
                                            $selectedState = isset($_POST['state']) ? $_POST['state'] : "";
                                            echo "<option value='' selected>Select state</option>";
                                            echo "<option value='PENDING' " . ($selectedState == 'PENDING' ? 'selected' : '') . ">PENDING</option>";
                                            echo "<option value='PAID' " . ($selectedState == 'PAID' ? 'selected' : '') . ">PAID</option>";
                                            echo "<option value='CANCELLED' " . ($selectedState == 'CANCELLED' ? 'selected' : '') . ">CANCELLED</option>";
                                            ?>
                                        </select>
                                    </th>
                                    <th>
                                        <label for="modification">Last modification</label>
                                    </th>
                                    <th>
                                        <label for="invoice">Invoice</label>
                                    </th>
                                </form>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($reservations as $booking) {
                                $availabilityClass = ($booking['state_reservation'] == "CANCELLED") ? 'unavailable' : '';
                                echo "
                                    <tr class='" . $availabilityClass . "'>
                                        <td>" . $booking['code_locator'] . "</td>
                                        <td>" . $booking['name'] . " " . $booking['last_name'] . "</td>
                                        <td>" . $booking['id_user'] . "</td>
                                        <td>" . $booking['start_date'] . "</td>
                                        <td>" . $booking['end_date'] . "</td>
                                        <td>" . $booking['id_bicycle_1'] . "</td>
                                        <td>" . $booking['id_bicycle_2'] . "</td>
                                        <td>" . $booking['id_bicycle_3'] . "</td>
                                        <td>" . $booking['id_bicycle_4'] . "</td>
                                        <td>" . $booking['reservation_date'] . "</td>
                                        <td>" . $booking['state_reservation'] . "</td>
                                        <td>" . $booking['last_modification_date'] . "</td>
                                        <td>
                                            <div id='invoiceButton'>    
                                                <a href='ShowInvoiceView.php?locator=" . $booking['code_locator'] . "'>
                                                    <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-file-earmark-medical' viewBox='0 0 16 16'>
                                                        <path d='M7.5 5.5a.5.5 0 0 0-1 0v.634l-.549-.317a.5.5 0 1 0-.5.866L6 7l-.549.317a.5.5 0 1 0 .5.866l.549-.317V8.5a.5.5 0 1 0 1 0v-.634l.549.317a.5.5 0 1 0 .5-.866L8 7l.549-.317a.5.5 0 1 0-.5-.866l-.549.317V5.5zm-2 4.5a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 2a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5z'/>
                                                        <path d='M14 14V4.5L9.5 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2zM9.5 3A1.5 1.5 0 0 0 11 4.5h2V14a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h5.5v2z'/>
                                                    </svg>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>