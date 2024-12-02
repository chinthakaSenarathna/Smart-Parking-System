<?php
session_start();
require_once './db/db_setup.php';

// Create instance of DBSetup
$dbSetup = new DBSetup();

// Assume that user ID is stored in session after login
$userId = $_SESSION['user_id'];

// Get user's bookings
$bookings = $dbSetup->getUserBookings($userId);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile - My Bookings</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #F0F8FF;
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
        header {
            background-color: #000;
            padding: 10px 0;
            text-align: center;
        }
        header h1 {
            color: #fff;
            margin: 0;
            font-size: 24px;
        }
        .header-button {
            margin-top: 10px;
        }
        .header-button button {
            background-color: #b00505; /* Green */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        .header-button button:hover {
            background-color: #eb1515;
        }
        .footer {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header>
        <h1>User Profile - My Bookings</h1>
        <div class="header-button">
            <button onclick="location.href='vehicle.php'">Booking</button>
        </div>
    </header>

    <h2 align="center">My Bookings</h2>
    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Booking Date</th>
                <th>Booking Time</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Location</th>
                <th>Status</th>
                <th>Vehicle Number</th>
                <th>Vehicle Type</th>
                <th>Vehicle Model</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?= htmlspecialchars($booking['booking_id']); ?></td>
                    <td><?= htmlspecialchars($booking['booking_date']); ?></td>
                    <td><?= htmlspecialchars($booking['booking_time']); ?></td>
                    <td><?= htmlspecialchars($booking['start_time']); ?></td>
                    <td><?= htmlspecialchars($booking['end_time']); ?></td>
                    <td><?= htmlspecialchars($booking['location_name']); ?></td>
                    <td><?= htmlspecialchars($booking['status']); ?></td>
                    <td><?= htmlspecialchars($booking['vehicle_number']); ?></td>
                    <td><?= htmlspecialchars($booking['vehicle_type']); ?></td>
                    <td><?= htmlspecialchars($booking['vehicle_model']); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="footer">
        <p>&copy; 2024 Smart Parking System. All rights reserved.</p>
    </div>
</body>
</html>
