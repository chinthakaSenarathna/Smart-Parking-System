<?php session_start(); ?>
<?php 

if (isset($_POST['submit'])) {
   $username=$_POST['username'];
   $password=$_POST['password'];

   if ($username="admin" && $password="admin123") {
      echo '<script type="text/javascript">';
               echo ' alert("Admin login success")';  //not showing an alert box.
               echo '</script>';
               //header('Location: table.php');
   }
   else{
      echo '<script type="text/javascript">';
               echo ' alert("Try again! wrong username or password)';  //not showing an alert box.
               echo '</script>';
   }
}

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
      <title>Bookings</title>
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
   <body>
      
	 
	   <div class="contact_section layout_padding">
         <div class="container">
            <div class="contact_main">
           <h1 class="request_text">Bookings</h1> 
           <form method="post" action="" >

              <table border="4" style="border-color: black; width: 100%; align: center; margin-left: 10px;">
               <thead>
                      <tr>
                 <th style="font-size:20px; color: black;">Vehicle Number</th>
                 <th style="font-size:20px; color: black;">Start Time</th>
                 <th style="font-size:20px; color: black;">End Time</th>
                 <th style="font-size:20px; color: black;">Location</th>
                 <th style="font-size:20px; color: black;">Date</th>
                 <th style="font-size:20px; color: black;">Action</th>
</tr>
               </thead> 
            
<tbody>
                 <?php 
                include('db_connection.php');
        $query=mysqli_query($conn,"select * from booking")or die(mysqli_error());
        while($row=mysqli_fetch_array($query)){
                                     
?>
            
               <tr style="padding:5px">
               
               <td style="font-size:15px; color: black;"><?php echo $row['vehicleNo'];?></td>
               <td style="font-size:15px; color: black;"><?php echo $row['startTime'];?></td>
               <td style="font-size:15px; color: black;"><?php echo $row['endTime'];?></td>
               <td style="font-size:15px; color: black;"><?php echo $row['location'];?></td>
               <td style="font-size:15px; color: black;"><?php echo $row['date'];?></td>
               <td>
                     <a href="accept.php?id=<?php echo $row['id']; ?>" style="background-color:greenyellow; padding: 5px;"> check</a>  
                   <a href="delete.php?id=<?php echo $row['id']; ?>" style="background-color:red; padding: 5px" onclick="DeleteConfirm();"> Reject</a>
                </td>
            </tr>
            
 <?php }  ?>
              </tbody>
           

              </table>

</form>
             


<h1 style="margin-top: 80px;">Registered List</h1>


              <table border="4" style="border-color: black; width: 100%; align: center; margin-left: 10px; margin-top: 80px;">
               <thead>
                      <tr>
                 <th style="font-size:20px; color: black;">CustomerName</th>
                 <th style="font-size:20px; color: black;">Telephone</th>
                 <th style="font-size:20px; color: black;">vehicleNo</th>
                 <th style="font-size:20px; color: black;">vehicleCategory</th>
                 <th style="font-size:20px; color: black;">fuelType</th>
                 <th style="font-size:20px; color: black;">location</th>
                
</tr>
               </thead> 
            
<tbody>
                 <?php 
                include('db_connection.php');
        $query=mysqli_query($conn,"select * from user")or die(mysqli_error());
        while($row=mysqli_fetch_array($query)){
                                     
?>
            
               <tr style="padding:5px">
               
               <td style="font-size:15px; color: black;"><?php echo $row['customerFirstName'];?></td>
			   <td style="font-size:15px; color: black;"><?php echo $row['customerLastName'];?></td>
               <td style="font-size:15px; color: black;"><?php echo $row['telephone'];?></td>
               <td style="font-size:15px; color: black;"><?php echo $row['vehicleNo'];?></td>
               <td style="font-size:15px; color: black;"><?php echo $row['vehicleCategory'];?></td>
               <td style="font-size:15px; color: black;"><?php echo $row['fuelType'];?></td>
               <td style="font-size:15px; color: black;"><?php echo $row['location'];?></td>
             
            </tr>
            
 <?php }  ?>
              </tbody>
           

              </table>



            </div>
         </div>
      </div>
       
       
   </body>
</html>

<script>
    function DeleteConfirm() {
      confirm("Are you sure to decline the booking");
     }
 </script>