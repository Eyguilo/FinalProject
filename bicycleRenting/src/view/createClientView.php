<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create client</title>
    <link rel="stylesheet" href="../../css/createBooking.css">
</head>

<body>
    <div id="container">
        <div id="central">
            <div id="create">
                <div class="title">Create Client</div>
                <form method="POST" action="createClientView.php">
                    <div class="form-group">
                        <label for="clientName">Client name:</label>
                        <input type="text" id="clientName" name="clientName">
                        <div id="clientNameSuggestions"></div>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" placeholder="example@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="tel" id="phone" name="phone" pattern="(\+[0-9]{2,3} )?[0-9]{3}-[0-9]{3}-[0-9]{3}" placeholder="+34 656-456-789" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address:</label>
                        <input type="text" id="address" name="address">
                    </div>
                    <input type="submit" value="Create client">
                </form>
            </div>
        </div>
    </div>
</body>

</html>