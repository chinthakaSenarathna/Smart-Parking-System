<?php
session_start();
require_once './db/db_setup.php'; // Include DBSetup class

// Create an instance of the DBSetup class
$db = new DBSetup();

// Check if the user is logged in (i.e., user_id is set in the session)
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    // Check if the form has been submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the vehicle details from the form submission
        $vehicle_number = $_POST['vehicleNo'] ?? '';
        $vehicle_type = $_POST['vehicleType'] ?? '';
        $vehicle_model = $_POST['vehicleModel'] ?? '';

        // Register the vehicle
        $result = $db->registerVehicle($user_id, $vehicle_number, $vehicle_type, $vehicle_model);

        if ($result === true) {
            echo "Vehicle registered successfully!";
            header("Location: booking.php");
        } else {
            if(isset($_SESSION['vehicle_id'])){
                header("Location: booking.php");
            }
            echo $result; // Display error message
        }
    }
} else {
    echo "You must be logged in to register a vehicle.";
}

// Close the database connection
$db->closeConnection();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Registration - Smart Parking</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
        }
        .container {
            width: 80%;
            max-width: 1200px;
            margin: auto;
            background-color: #CCFFFF;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .header, .footer {
            background-color: #000000;
            color: #ffffff;
            padding: 10px;
            text-align: center;
        }
        .footer p {
            font-size: 0.9em;
        }
        .header img {
            float: left;
            margin-right: 15px;
        }
        .nav-links a {
            color: #ffffff;
            margin: 0 20px;
            text-decoration: none;
            font-weight: bold;
        }
        .booking-form {
            margin-top: 20px;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .booking-form label {
            font-size: 1.2em;
            display: block;
            margin-top: 15px;
        }
        .booking-form input, .booking-form select {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            margin-top: 5px;
            border: 1px solid #cccccc;
            border-radius: 5px;
        }
        .booking-form button {
            padding: 10px 20px;
            font-size: 1.2em;
            margin: 20px 10px 0 0;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .submit-btn { background-color: #4CAF50; color: white; }
        .reset-btn { background-color: #f44336; color: white; }
    </style>
    <script>
        // Function to reset the form
        function resetForm() {
            document.getElementById("register").reset();
        }
    </script>
</head>
<body>

<div class="container">
    <!-- Header with logo and navigation -->
    <div class="header">
        <img src="./images/Parkk%20logo.jpg" width="105" height="88" alt="Logo">
        <div class="nav-links">
            <a href="index.php">HOME</a>
            <a href="updates.php">UPDATES</a>
            <a href="contacts.php">CONTACT</a>
            <a href="about.php">ABOUT</a>
        </div>
    </div>

    <!-- Main Image -->
    <div class="main-image" align="center">
        <img src="./images/Presentation1.png" width="100%" alt="Main Image">
    </div>

    <!-- Booking Form -->
    <div class="booking-form">
        <h2 align="center" style="color: #0000FF;">Vehicle Registration</h2>
        
        <form method="POST" action="">
            <?php
                $vehicleNo = $_POST['vehicleNo'] ?? '';
                $vehicleType = $_POST['vehicleType'] ?? '';
                $vehicleModel = $_POST['vehicleModel'] ?? '';
            ?>
            
            <label for="vehicleNo">Vehicle Number</label>
            <input type="text" id="vehicleNo" name="vehicleNo" size="40" value="<?php echo htmlspecialchars($vehicleNo); ?>" required>

            <label for="vehicleType">Vehicle Type</label>
            <input type="text" id="vehicleType" name="vehicleType" size="40" value="<?php echo htmlspecialchars($vehicleType); ?>" required>

            <label for="vehicleModel">Vehicle Model</label>
            <input type="text" id="vehicleModel" name="vehicleModel" size="40" value="<?php echo htmlspecialchars($vehicleModel); ?>" required>

            <div align="center">
                <button type="submit" class="submit-btn">Register Vehicle</button>
                <button type="reset" click="resetForm()" class="reset-btn">Reset</button>
            </div>
        </form>
    </div>


    <!-- Footer -->
    <div class="footer">
        <p>Smart Parking Ltd is registered in Sri Lanka, register no. SC356265.<br>
        The ultimate parent company in Sri Lanka is Smart Parking (SL) Limited, also registered in Sri Lanka, register number SCC456.<br>
        Our registration address is Smart Parking Limited, Flower Road, Colombo 6.<br>
        Company V.A.T. Reg. No 55560672.</p>
    </div>
</div>

</body>
</html>
