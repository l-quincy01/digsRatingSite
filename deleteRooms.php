<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
//add database credentials
require_once("config.php");

//fetch values from the form
    $id = $_REQUEST['id'];

//making a connection to the database 
//connect to database
$conn= mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE)
or die("Error:unable to connect to the database!");

//issue query instructions
$query= "DELETE FROM thecreatorscollective.rooms WHERE Room_ID=$id";
$result= mysqli_query($conn,$query) 
or die("Error:Unable to execute query");
//close connection 
mysqli_close($conn);
//redirect to the page
header ("Location: Rooms.php")
    ?> 
</body>
</html>

