<?php
session_start();
require_once './db/db_setup.php'; // Include the DBSetup class

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $data = [
        'firstName' => $_POST["firstName"],
        'lastName' => $_POST["lastName"],
        'email' => $_POST["email"],
        'telephone' => $_POST["telephone"],
        'address' => $_POST["address"],
        'password' => password_hash($_POST["password"], PASSWORD_DEFAULT) // Securely hash the password
    ];

    // Create instance of DBSetup
    $dbSetup = new DBSetup();

    // Register user
    $result = $dbSetup->registerUser($data);

    if ($result === true) {
        echo '<script>alert("Successfully Registered");</script>';
        // Redirect to login page after successful registration
        header("Location: login.php");
        exit();
    } else {
        // Display error message
        echo '<script>alert("' . $result . '");</script>';
    }

    // Close the database connection
    $dbSetup->closeConnection();
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registration Page</title>
    <script>
        // Function to reset the form
        function resetForm() {
            document.getElementById("register").reset();
        }
    </script>
</head>
<body>
    <!-- Your HTML code here -->
    <div align="center">
        <table cellpadding="0" cellspacing="0" width="1119" height="1470" bgcolor="#CCFFFF">
            <!-- MSTableType="layout" -->
            <tr>
                <td valign="top" align="center" rowspan="3">
                    <p align="left">
                        <img border="0" src="./images/logo.png" width="105" height="88" style="margin-left: 5px;">
                    </p>
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
                                <a href="index.php" style="margin-right: 65px;">
                                    <font color="#FFFFFF">HOME</font>
                                </a>
                                <a href="updates.php" style="margin-right: 65px;">
                                    <font color="#FFFFFF">UPDATES</font>
                                </a>
                                <a href="contacts.php" style="margin-right: 65px;">
                                    <font color="#FFFFFF">CONTACT</font>
                                </a>
                                <a href="about.php" style="margin-right: 65px;">
                                    <font color="#FFFFFF">ABOUT</font>
                                </a>
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
                <td valign="top" colspan="4" height="500" align="center">
                    <img border="0" src="./images/Presentation1.png" width="1118" height="500">
                </td>
            </tr>
            <tr>
                <td height="1">&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td valign="top">
                    <form method="POST" name="register" id="register" action="">
                        <p align="center">
                            <b>
                                <font size="7" color="#0000FF">REGISTER</font>
                            </b>
                        </p>
                        <table align="center" width="100%" cellpadding="10">
                            <tr>
                                <td>
                                    <label for="firstName" style="margin-left: 100px;">
                                        <font size="4" face="Bahnschrift SemiBold">Customer First Name</font>
                                    </label>
                                </td>
                                <td>
                                    <input type="text" name="firstName" id="firstName" style="width: 350px; margin-right: 150px;" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="lastName" style="margin-left: 100px;">
                                        <font size="4" face="Bahnschrift SemiBold">Customer Last Name</font>
                                    </label>
                                </td>
                                <td>
                                    <input type="text" name="lastName" id="lastName" style="width: 350px; margin-right: 150px;" required> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="email" style="margin-left: 100px;">
                                        <font size="4" face="Bahnschrift SemiBold">Customer Email</font>
                                    </label>
                                </td>
                                <td>
                                    <input type="text" name="email" id="email" maxlength="100" style="width: 350px; margin-right: 150px;" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="telephone" style="margin-left: 100px;">
                                        <font size="4" face="Bahnschrift SemiBold">Customer Telephone</font>
                                    </label>
                                </td>
                                <td>
                                    <input type="text" name="telephone" id="telephone" style="width: 350px; margin-right: 150px;" required> 
                                </td>
                            </tr>
                            <!-- <tr>
                                <td>
                                    <label style="margin-left: 100px;">
                                        <font size="4" face="Bahnschrift SemiBold">Vehicle Category</font>
                                    </label>
                                </td>
                                <td>
                                    <select size="1" name="vehicleCategory" id="vehicleCategory" style="width: 350px; margin-right: 150px;" required>
                                        <option value="Car">Car</option>
                                        <option value="Bike">Bike</option>
                                        <option value="Van">Van</option>
                                        <option value="Three Wheel">Three Wheel</option>
                                    </select>
                                </td>
                            </tr> -->
                            <!-- <tr>
                                <td>
                                    <label style="margin-left: 100px;">
                                        <font size="4" face="Bahnschrift SemiBold">Fuel Type</font>
                                    </label>
                                </td>
                                <td>
                                    <label for="Petrol">Petrol</label><input type="radio" name="fuelType" value="Petrol" required>
                                    <label for="Diesel">Diesel</label><input type="radio" name="fuelType" value="Diesel" required>
                                </td>
                            </tr> -->
                            <!-- <tr>
                                <td>
                                    <label style="margin-left: 100px;">
                                        <font size="4" face="Bahnschrift SemiBold">Location</font>
                                    </label>
                                </td>
                                <td>
                                    <select size="1" name="location" id="location" style="width: 350px; margin-right: 150px;" required >
                                        <option value="Colombo">Colombo</option>
                                        <option value="Gampaha">Gampaha</option>
                                        <option value="Negombo">Negombo</option>
                                        <option value="Kurunegala">Kurunagala</option>
                                        <option value="Galle">Galle</option>
                                    </select>
                                </td>
                            </tr> -->
                            <tr>
                                <td>
                                    <label for="address" style="margin-left: 100px;">
                                        <font size="4" face="Bahnschrift SemiBold">Address</font>
                                    </label>
                                </td>
                                <td>
                                    <input type="text" name="address" id="address" style="width: 350px; margin-right: 150px;" required> 
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
                                    <input type="submit" name="submit" value="Register" style="margin-left: 110px;">
                                </td>
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
