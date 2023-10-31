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
$conn= mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE)
or die("Error:unable to connect to the database!");
 
//issue query instructions
$query= "DELETE FROM thecreatorscollective.images WHERE images_ID=$id";
$result= mysqli_query($conn,$query) 
or die("Error:Unable to execute query".mysqli_error($conn));
//close connection 
mysqli_close($conn);
//redirect to the page
header ("Location: images.php")
    ?> 
    
</body>
</html>