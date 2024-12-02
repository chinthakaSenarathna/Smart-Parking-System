<?php
session_start();
require_once './db/db_setup.php'; // Include DBSetup class

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Create instance of DBSetup
    $dbSetup = new DBSetup();

    // Authenticate user
    $loginResult = $dbSetup->authenticateAdmin($email, $password);

    if ($loginResult === true) {
        echo '<script>alert("Login successful");</script>';
        // Redirect to a dashboard or homepage after successful login
        header("Location: adminHome.php");
        exit();
    } else {
        // Display error message if login fails
        echo '<script>alert("' . $loginResult . '");</script>';
    }

    // Close the database connection
    $dbSetup->closeConnection();
}
?>


<html>

<head>
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>New Page 1</title>
</head>

<body>

<div align="center">

<table cellpadding="0" cellspacing="0" bgcolor="#C0C0C0" width="1170" height="501">
	<!-- MSTableType="layout" -->
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td height="28">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td valign="top" colspan="3">
		<p align="center"><font size="5" color="#FF0000">!!</font><font color="#008080" size="5"> 
		Admin Property </font><font size="5" color="#FF0000">!!</font></p>
		<p align="center"><font size="4" color="#FF0000">Only admin can login 
		this page through the specific user name and password .</font></td>
		<td height="86">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td height="106">&nbsp;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td valign="top">
		<form method="POST" action="">
			<!--webbot bot="SaveResults" U-File="C:\xampp\htdocs\new parking system\New parking wusl\_private\form_results.csv" S-Format="TEXT/CSV" S-Label-Fields="TRUE" -->
			<p>&nbsp;</p>
			<p align="center">Email&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="text" name="email" id="email" size="20" required></p>
			<p align="center">Password&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			<input type="password" name="password" id="password" size="20" required></p>
			<p align="center"><input type="submit" value="Submit" name="submit"  >
			<input type="reset" value="Reset" name="B2"></p>
		</form>
		<p>&nbsp;</td>
		<td>&nbsp;</td>
		<td height="176">&nbsp;</td>
	</tr>
	<tr>
		<td width="227">&nbsp;</td>
		<td width="144">&nbsp;</td>
		<td width="426">&nbsp;</td>
		<td width="101">&nbsp;</td>
		<td height="105" width="272">&nbsp;</td>
	</tr>
</table>

</div>

</body>

<script type="text/javascript">
	/*function adminLogin(){
		String name=document.getElementById("username");
		String pass=document.getElementById("password");

		if(name="admin" && pass="admin123"){
			alert("Admin login success");
		}

		else{
			alert("Admin login failed");
		}
	} */
</script>

</html>
