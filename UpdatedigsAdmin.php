<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

//credentials
require_once("config.php");
    //fetch data from form 
    $Digs_description_up=$_REQUEST['Digs_description'];
    $Rent_per_room_up=$_REQUEST['Rent_per_room'];
     $Digs_ID_up = $_REQUEST['digsid'];

     //make connection
     $conn= mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE)
or die("Error:unable to connect to the database!");

//issue query instructions
$query= "UPDATE digs SET Digs_description = '$Digs_description_up', Rent_per_room = '$Rent_per_room_up' WHERE Digs_ID = $Digs_ID_up ";
$result= mysqli_query($conn,$query) 
or die("Error:Unable to execute query".mysqli_error($conn));

mysqli_close($conn);
header("Location:manageDigs.php");
//display message to confirm update
echo "<p style=\color:green\">The record was updated successfully</p>";
    ?>
</body>
</html>