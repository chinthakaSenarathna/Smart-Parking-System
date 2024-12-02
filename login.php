<?php
session_start();
require_once './db/db_setup.php'; // Include DBSetup class

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Create instance of DBSetup
    $dbSetup = new DBSetup();

    // Authenticate user
    $loginResult = $dbSetup->authenticateUser($email, $password);

    if ($loginResult === true) {
        echo '<script>alert("Login successful");</script>';
        
        $user_id = $_SESSION['user_id'];

        // Check if the user has any vehicles using the new method
        if ($dbSetup->userHasVehicles($user_id)) {
            // User has vehicles, redirect to userBookingView.php
            header("Location: userBookingView.php");
        } else {
            // User has no vehicles, redirect to vehicle.php
            header("Location: vehicle.php");
        }

        exit();
    } else {
        // Display error message if login fails
        echo '<script>alert("' . $loginResult . '");</script>';
    }
}
?>





<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Document</title>
		<script>
			// Function to reset the form
			function resetForm() {
				document.getElementById("login").reset();
			}
		</script>
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
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td height="51">&nbsp;</td>
					</td>
				<tr>
					<td valign="top" height="29" align="center" bgcolor="#000000" colspan="5">
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
					<td></td>
					<td></td>
					<td height="11"></td>
				</tr>
				<tr>
					<td valign="top" colspan="6" height="667" align="center">
						<img border="0" src="./images/Presentation1.png" width="1118" height="667">
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td height="87">&nbsp;</td>
					</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td valign="top" bgcolor="#CCFFFF" colspan="3">
						<p align="center">
							<b>
								<font size="7" face="Arial Black" color="#0000FF">LOGIN</font>
							</b>
						</p>
						<form align="center" method="POST" name="login" id="login" action="">
							<table align="center" width="100%" cellpadding="10">
								<tr>
									<td>
										<label for="email" style="margin-left: 100px;">
											<font size="4" face="Bahnschrift SemiBold">Email</font>
										</label>
									</td>
									<td>
										<input type="text" name="email" id="email" maxlength="100" style="width: 350px; margin-right: 150px;" required>
									</td>
								</tr>
								<tr>
									<td>
										<label style="margin-left: 100px;">
											<font size="4" face="Bahnschrift SemiBold">Password</font>
										</label>
									</td>
									<td>
										<input type="password" name="password" id="password" minlength="8" style="width: 350px; margin-right: 150px;" required>
									</td>
                            	</tr>
								<tr>
									<td></td>
									<td>
										<input type="reset" value="Reset" onclick="resetForm()" style="margin-left: 20px;">
										<input type="submit" name="submit" value="Login" style="margin-left: 110px;">
									</td>
                            	</tr>
							</table>
						</form>
						<p>&nbsp;
						</td>
					<td height="236">&nbsp;</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td height="13"></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td></td>
					
					<td></td>
					<td height="19"></td>
				</tr>
				<tr>
					<td width="115">&nbsp;</td>
					<td width="84">&nbsp;</td>
					<td width="338">&nbsp;</td>
					<td width="68">&nbsp;</td>
					<td width="323">&nbsp;</td>
					<td height="193" width="191">&nbsp;</td>
				</tr>
				<tr>
					<td valign="top" colspan="6" height="164" bgcolor="#000000">
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
					<p>&nbsp;
					</td>
				</tr>
			</table>
		</div>
		<p align="center">&nbsp;</p>
	</body>
</html>