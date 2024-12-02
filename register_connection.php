<?php error_reporting(0); ?> 
<?php
	
	include 'db_connection.php';





	if(isset($_POST["submit"])){ 
        $vehicleNo=$_POST['vehicleNo'];
$startTime=$_POST['startTime'];
$endTime=$_POST['endTime'];
$date=$_POST['date'];
$location=$_POST['location'];

//$query= "INSERT INTO user
        //VALUES ( '',$vehicleNo  , $stsrtTime , $endTime, $date , $location)";
		  
			  //duplicate value checking

			  $duplicate=mysqli_query($conn,"select * from booking where vehicleNo='$vehicleNo'");


	if (mysqli_num_rows($duplicate)>0)
	{
	//header("Location: Register.php?message=User name or Email id already exists.");

		echo '<script type="text/javascript">';
					echo ' alert("This Vehicle no or Password already existed")';  //not showing an alert box.
					echo '</script>';

					//header('Location: register_1.php');
	}

	else{
		$query= "INSERT INTO booking
        VALUES ( '','$vehicleNo'  , '$startTime' , '$endTime', '$location','$date' )";

mysqli_query($conn, $query);

					echo '<script type="text/javascript">';
					echo ' alert("Successfully booking You were reserving parking place No 2 ")';  //not showing an alert box.
					echo '</script>';

					//header('Location: login.php');
	}


 
		
}	

else{
	echo '<script type="text/javascript">';
					echo ' alert("Not Registered")';  //not showing an alert box.
					echo '</script>';

				//	header('Location: register_1.php');
}


	
?>


