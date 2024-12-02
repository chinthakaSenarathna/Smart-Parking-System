<?php
session_start();
require_once './db/db_setup.php'; // Include DBSetup class

// Create instance of DBSetup
$dbSetup = new DBSetup();

// Fetch all locations
$locations = $dbSetup->getAllLocations(); // Assuming this method retrieves all locations

// Handle form submission for adding a new location
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form input
    $location_name = $_POST['location_name'];
    $capacity = $_POST['capacity'];

    // Call the addLocation method from the DBSetup class
    $result = $dbSetup->addLocation($location_name, $capacity);

    if ($result === true) {
        echo "<script>alert('Location added successfully!'); window.location.href = 'location.php';</script>";
    } else {
        echo "<script>alert('" . $result . "');</script>"; // Display error message
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart-Parking-System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #CCFFFF;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        nav {
            background-color: #000;
            padding: 10px 0;
            text-align: center;
        }
        nav a {
            color: #fff;
            margin: 0 15px;
            text-decoration: none;
            font-size: 18px;
        }
        .footer {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }
        .logo {
            margin: 20px;
        }
        form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], input[type="number"], select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="logo" align="center">
        <img src="./images/Parkk logo.jpg" alt="logo" width="105" height="88">
    </div>

    <nav>
        <a href="adminHome.php">BOOKING</a>
        <a href="location.php">LOCATION</a>
    </nav>

    <h2 align="center">Add New Location</h2>
    <form method="POST" action="">
        <label for="location_name">Location Name:</label>
        <input type="text" id="location_name" name="location_name" required>

        <label for="capacity">Capacity:</label>
        <input type="number" id="capacity" name="capacity" min="1" required>

        <input type="submit" value="Add Location">
    </form>

    <h2 align="center">Location Details View</h2>
    <table>
        <thead>
            <tr>
                <th>Location ID</th>
                <th>Location Name</th>
                <th>Capacity</th>
                <th>Occupied</th>
                <th>Remaining</th>
                <th>Status</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($locations as $location): ?>
                <tr>
                    <td><?= htmlspecialchars($location['location_id']); ?></td>
                    <td><?= htmlspecialchars($location['location_name']); ?></td>
                    <td><?= htmlspecialchars($location['capacity']); ?></td>
                    <td><?= htmlspecialchars($location['occupied']); ?></td>
                    <td><?= htmlspecialchars($location['remaining']); ?></td>
                    <td><?= htmlspecialchars($location['status']); ?></td>
                    <td><?= htmlspecialchars($location['created_at']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>Smart Parking Ltd is registered in Sri Lanka, register no. SC356265.</p>
        <p>The ultimate parent company in Sri Lanka is Smart Parking (SL) Limited, register number SCC456.</p>
        <p>Our registration address is Smart Parking Limited, Flower road, Colombo 6.</p>
    </div>
</body>
</html>
