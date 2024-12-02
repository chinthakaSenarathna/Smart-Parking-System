<?php
	session_start();

	include './db/db_setup.php';
	// Rest of your index.php code goes here
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Parking System</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #F3F4F6;
            color: #333;
        }

        /* Header Styles */
        header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            background-color: #1A202C; /* Dark gray */
            color: #fff;
            flex-wrap: wrap;
        }

        header img {
            width: 60px;
            height: auto;
        }

        nav {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 5px 10px;
            font-size: 1em;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        nav a:hover {
            background-color: #4A5568; /* Lighter gray */
        }

        nav a.register {
            background-color: #E53E3E; /* Red */
        }

        nav a.login {
            background-color: #E53E3E; /* Red */
        }

        nav a.admin {
            color: #48BB78; /* Green */
        }

        /* Hero Section */
        .hero-section {
            text-align: center;
            margin: 20px 0;
        }

        .hero-section img {
            width: 100%;
            max-width: 1118px;
            height: auto;
        }

        /* Content Section */
        .section {
            padding: 40px 20px;
            text-align: center;
            background-color: #EDF2F7; /* Light gray */
        }

        .section h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            color: #2D3748; /* Darker text */
        }

        .section p {
            font-size: 1.2em;
            line-height: 1.6;
            max-width: 900px;
            margin: 0 auto;
            color: #4A5568; /* Medium text */
        }

        /* Two-Column Layout */
        .two-column {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 40px 20px;
            background-color: #E2E8F0; /* Very light gray */
        }

        .column {
            flex: 1;
            max-width: 45%;
            text-align: center;
            background-color: #fff;
            border: 1px solid #CBD5E0; /* Light border */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .column img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
            border-radius: 5px;
        }

        .column h1 {
            margin-top: 10px;
            font-size: 1.8em;
            color: #2D3748;
        }

        .column p {
            color: #4A5568;
        }

        /* Footer Styles */
        footer {
            background-color: #1A202C;
            color: #fff;
            text-align: center;
            padding: 20px 10px;
        }

        footer p {
            margin: 5px 0;
            font-size: 0.9em;
            color: #CBD5E0; /* Light gray text */
        }

        footer a {
            color: #63B3ED; /* Light blue */
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            header img {
                display: none;
            }

            nav {
                justify-content: space-between;
            }

            .column {
                max-width: 100%; /* Stack columns on smaller screens */
            }
        }
    </style>
</head>
<body>

<header>
    <img src="./images/Parkk logo.jpg" alt="Smart Parking System Logo">
    <nav>
        <a href="index.php">Home</a>
        <a href="updates.php">Updates</a>
        <a href="contacts.php">Contact</a>
        <a href="about.php">About</a>
        <a href="register.php" class="register">Register</a>
        <a href="login.php" class="login">Login</a>
        <a href="adminLogin.php" class="admin">Admin</a>
    </nav>
</header>

<div class="hero-section">
    <img src="./images/Presentation1.png" alt="Hero Image">
</div>

<section class="section">
    <h1>We Know Parking</h1>
    <p>
        Parking System is a full-service parking management company with a reputation for excellence in valet service, parking management, transportation service, facility maintenance, revenue control, and consulting. We service more than 30 locations and accommodate over 1 million vehicles annually. Our trained parking professionals are recognizable throughout Sri Lanka.
    </p>
</section>

<div class="two-column">
    <div class="column">
        <img src="./images/6459874955_b9ec274b0e.jpg" alt="Services">
        <h1>Services</h1>
        <p>
            We specialize in providing a wide array of parking and transportation services for Hospitals, Hotels, Office Buildings, Condominiums, Schools, Factories, and Special Events.
        </p>
    </div>
    <div class="column">
        <img src="./images/OnnIP.jpg" alt="Our System">
        <h1>Our System</h1>
        <p>
            Parking System's long-term success and continuing growth result from experienced management focused on meeting and exceeding client expectations.
        </p>
    </div>
</div>

<footer>
    <p>Smart Parking Ltd is registered in Sri Lanka, register no. SC356265.</p>
    <p>The ultimate parent company in Sri Lanka is Smart Parking (SL) Limited, register number SCC456.</p>
    <p>Our registration address is Smart Parking Limited, Flower Road, Colombo 6.</p>
    <p>Company V.A.T. Reg. No 55560672</p>
</footer>

</body>
</html>







<?php error_reporting(0); ?> 
<?php
	
	include 'db_connection.php';

	if(isset($_POST["submit"])){ 
        $vehicleNo=$_POST['vehicleNo'];
		$startTime=$_POST['startTime'];
		$endTime=$_POST['endTime'];
		$date=$_POST['date'];
		$location=$_POST['location'];

		// $query= "INSERT INTO user VALUES ( '',$vehicleNo  , $stsrtTime , $endTime, $date , $location)";
		  
		//duplicate value checking
		$duplicate=mysqli_query($conn,"select * from booking where vehicleNo='$vehicleNo'");


		if (mysqli_num_rows($duplicate)>0){
			//header("Location: Register.php?message=User name or Email id already exists.");

			echo '<script type="text/javascript">';
						echo ' alert("This Vehicle no or Password already existed")';  //not showing an alert box.
						echo '</script>';

			//header('Location: register_1.php');
		}

		else{
			$query= "INSERT INTO booking VALUES ( '','$vehicleNo'  , '$startTime' , '$endTime', '$location','$date' )";

			mysqli_query($conn, $query);

			echo '<script type="text/javascript">';
			echo ' alert("Successfully booking You were reserving parking place")';  //not showing an alert box.
			echo '</script>';

			//header('Location: login.php');
		}	
	}	
?>