<?php
session_start();
require_once './db/db_setup.php';

$dbSetup = new DBSetup();

// Handle booking approval
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_id'])) {
    $booking_id = intval($_POST['booking_id']);
    
    // Get the location_id from the booking record
    $booking = $dbSetup->getBookingById($booking_id); // You'll need to implement this method
    if ($booking) {
        $location_id = $booking['location_id'];
        
        // Update booking status
        $dbSetup->approveBooking($booking_id); // You'll need to implement this method

        // Update location occupancy
        $dbSetup->updateLocationOccupancy($location_id); // You'll need to implement this method
    }
}

$bookings = $dbSetup->getAllBookings();
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
            background-color: #CCFFFF; /* Light Blue */
            color: #333; /* Dark Gray */
        }

        .table-container {
            overflow-x: auto; /* Enables horizontal scrolling */
            margin: 20px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #f4f4f4; /* Light Gray */
            color: #000; /* Black */
        }

        nav {
            background-color: #000; /* Black */
            padding: 10px 0;
            text-align: center;
        }

        nav a {
            color: #fff; /* White */
            margin: 0 15px;
            text-decoration: none;
            font-size: 18px;
        }

        nav a:hover {
            background-color: rgba(255, 255, 255, 0.2); /* White with slight transparency */
        }

        .footer {
            background-color: #000; /* Black */
            color: #fff; /* White */
            text-align: center;
            padding: 20px;
            font-size: 14px;
        }

        .logo {
            margin: 20px;
        }

        .approve-button {
            background-color: #007BFF; /* Green */
            color: white;
            border: none;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            cursor: pointer;
        }

        .approve-button:hover {
            background-color: #007BFF; /* Darker Green */
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            nav {
                text-align: left; /* Left-align links on smaller screens */
                padding: 10px;
            }

            nav a {
                display: block;
                margin-bottom: 10px; /* Stack links */
            }

            .logo img {
                width: 80px;
                height: auto;
            }
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

    <h2 align="center">Admin Booking View</h2>
    <div class="table-container">
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
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>Vehicle Number</th>
                    <th>Vehicle Type</th>
                    <th>Vehicle Model</th>
                    <th>Actions</th>
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
                        <td><?= htmlspecialchars($booking['status'] ? 'Active' : 'Inactive'); ?></td>
                        <td><?= htmlspecialchars($booking['firstName'] . ' ' . $booking['lastName']); ?></td>
                        <td><?= htmlspecialchars($booking['email']); ?></td>
                        <td><?= htmlspecialchars($booking['telephone']); ?></td>
                        <td><?= htmlspecialchars($booking['vehicle_number']); ?></td>
                        <td><?= htmlspecialchars($booking['vehicle_type']); ?></td>
                        <td><?= htmlspecialchars($booking['vehicle_model']); ?></td>
                        <td>
                            <form action="" method="POST">
                                <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking['booking_id']); ?>">
                                <button type="submit" class="approve-button" onclick="return confirm('Are you sure you want to approve this booking?');">Approve</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Smart Parking Ltd is registered in Sri Lanka, register no. SC356265.</p>
        <p>The ultimate parent company in Sri Lanka is Smart Parking (SL) Limited, register number SCC456.</p>
        <p>Our registration address is Smart Parking Limited, Flower road, Colombo 6.</p>
    </div>
</body>
</html>


