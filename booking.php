<?php
session_start();
require_once './db/db_setup.php'; // Include DBSetup class

// Create an instance of the DBSetup class
$db = new DBSetup();

// Fetch all locations
$locations = $db->getAllLocationsWithIdName(); // Assuming this method retrieves all locations

// Check if the user is logged in (i.e., user_id is set in the session)
if (isset($_SESSION['user_id']) && isset($_SESSION['vehicle_id'])) {
    $user_id = $_SESSION['user_id'];
    $vehicle_id = $_SESSION['vehicle_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Get the submitted form data
        $date = $_POST['date']; // Move this line before using $date
        $start_time = $date . ' ' . $_POST['startTime'] . ':00';
        $end_time = $date . ' ' . $_POST['endTime'] . ':00';
        $location_id = $_POST['location_id']; // Use location_id instead of location

        // Register the booking
        $result = $db->registerBooking($vehicle_id, $date, $start_time, $end_time, $location_id);
        
        if ($result === true) {
            echo "<script>alert('Booking successful!');</script>";
            header("Location: userBookingView.php");
            exit; // Use exit after header redirection
        } else {
            echo "<script>alert('Error: $result');</script>";
        }
    }	
}
?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
	</head>
	<body>
		<div align="center">
			<table cellpadding="0" cellspacing="0" width="1119" height="1470" bgcolor="#CCFFFF">
			<!-- MSTableType="layout" -->
				<tr>
					<td valign="top" align="center" rowspan="3">
						<p align="left">
							<img border="0" src="./images/Parkk%20logo.jpg" width="105" height="88">
						</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td height="51">&nbsp;</td>
				</tr>
				<tr>
					<td valign="top" height="29" align="center" bgcolor="#000000" colspan="3">
						<p align="right">
							<b>
								<font size="5" color="#FFFFFF" face="Bahnschrift SemiBold">
									<a href="index.php"><font color="#FFFFFF">HOME</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="updates.php"><font color="#FFFFFF">UPDATES</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="contacts.php"><font color="#FFFFFF">CONTACT</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
									<a href="about.php"><font color="#FFFFFF">ABOUT</font></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
								</font>
							</b>
						</p>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td height="11"></td>
				</tr>
				<tr>
					<td valign="top" colspan="4" height="667" align="center">
					<img border="0" src="./images/Presentation1.png" width="1118" height="667"></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td height="87">&nbsp;</td>
				</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td valign="top" bgcolor="#CCFFFF">
					<form method="POST" action="">
					<!--webbot bot="SaveResults" U-File="C:\wamp64\www\new parking system\New parking wusl\_private\form_results.csv" S-Format="TEXT/CSV" S-Label-Fields="TRUE" -->
						<p align="center">
							<b>
								<font face="Arial Black" size="7" color="#0000FF">BOOKING</font>
							</b>
						</p>
						<p align="center">&nbsp;</p>

					<p align="left">
						<font size="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							Parking Time&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							at&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="time" name="startTime" size="40" required>
						</font>
					</p>
					<p align="left">
						<font size="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							to&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
						</font>
						<input type="time" name="endTime" size="40" required>
					</p>
					<p align="left">
						<font size="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="date" name="date" size="40" required>
						</font>
					</p>
					<p align="left">
						<font size="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
							Location&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						</font>
						<select size="1" name="location_id" required>
							<?php foreach ($locations as $location): ?>
								<option value="<?php echo $location['location_id']?>"><?php echo $location['location_name']; ?></option>
							<?php endforeach; ?>
						</select>
					</p>
						<p align="center">&nbsp;</p>
						<p align="center">
							<font size="5">
								<input type="submit" value="Booking" name="submit">
								<input type="reset" value="Reset" name="B2">
							</font>
						</p>
					</form>
					<p>&nbsp;</td>
					<td height="365">&nbsp;</td>
				</tr>
				<tr>
					<td width="115">&nbsp;</td>
					<td width="84">&nbsp;</td>
					<td width="729">&nbsp;</td>
					<td height="96" width="191">&nbsp;</td>
				</tr>
				<tr>
					<td valign="top" colspan="4" height="164" bgcolor="#000000">
					<div class="copyright_section">
						<div class="container">
							<p align="center">&nbsp;</p>
							<p align="center">
								<font color="#FFFFFF" face="Candara" size="4">
									Smart Parking Ltd is registered in Sri Lanka, register no. 
									SC356265.<br>
									The ultimate parent company in the Sri Lanka is Smart Parking 
									(SL) Limited, also registered in the Sri Lanka register number 
									SCC456.<br>
									Our registration address is Smart Parking Limited, Flower road, 
									Colombo 6.<br>
									Company V.A.T. Reg. No 55560672
								</font>
							</p>
						</div>
					</div>
					<p>&nbsp;</td>
				</tr>
			</table>
		</div>
		<p align="center">&nbsp;</p>
	</body>
</html>




