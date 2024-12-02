<?php

include "db_connection.php"; // Using database connection file here

if(isset($_POST['submit'])) {

$id = $_GET['id']; // get id through query string
$vehicleNo=$_GET['vehicleNo'];
$vehicleType=$_GET['vehicleType'];
$date=$_GET['date'];
$startTime=$_GET['startTime'];
$endTime=$_GET['endTime'];
$location=$_GET['location'];

$del = mysqli_query($conn,"INSERT INTO accepted (SELECT * from booking where id='$id' )"); 

if($del)
{
    mysqli_close($conn); // Close connection
    header("location:OwnerView.php"); // redirects to all records page
    exit;	
}
else
{
    //echo "Error deleting record"; // display error message if not delete
}}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Accepted Bookings</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
      <!-- owl stylesheets --> 
      <link href="https://fonts.googleapis.com/css?family=Poppins:400,700|Raleway:400,700,800&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="css/owl.carousel.min.css">
      <link rel="stylesoeet" href="css/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">

   </head>
   <body align="center">
      
     
       <div class="contact_section layout_padding">
         <div class="container">
            <div class="contact_main">
           <h1 align="center" class="request_text">Check Bookings</h1> </br>
           <h3 align="center"> Customer reserving parking place No 2 </h3>
             
			 <td >
                     <a href="table.php" align="center" style="background-color:yellow; padding: 5px;"> Next to table</a>
                </td>
			 
			 
			 
            </div>
         </div>
      </div>
       
   </body>
</html>
