<html>
<head></head>
<body align="center">
<h1 align="center" class="request_text"> !!! Rejected !!!</h1> </br>
           <h3 align="center"> Customer reserving parking place was rejected by admin.</h3>
             
			 <td >
                     <a href="table.php" align="center" style="background-color:yellow; padding: 5px;"> Next to table</a>
                </td>
				</body>
</html>





<?php

include "db_connection.php"; // Using database connection file here

$id = $_GET['id']; // get id through query string

$del = mysqli_query($conn,"delete from booking where id = '$id'"); // delete query
if($del)
{
    mysqli_close($conn); // Close connection
  //  header("location:OwnerView.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>
