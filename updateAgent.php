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
    $Agent_Fname = $_REQUEST['Agent_Fname'];
    $Agent_Lname=$_REQUEST['Agent_Lname'];
    $Agent_office_address_up=$_REQUEST['Agent_office_address'];
    $Agent_email_address_up=$_REQUEST['Agent_email_address'];
     $Agent_phone_up=$_REQUEST['Agent_phone'];
     $Agent_ID_up = $_REQUEST['agentid'];
  
     //make connection
     $conn= mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE)
or die("Error:unable to connect to the database!");

//issue query instructions
$query= "UPDATE agent SET  Agent_Fname = '$Agent_Fname', Agent_Lname = '$Agent_Lname', Agent_office_address = '$Agent_office_address_up', Agent_email_address = '$Agent_email_address_up' , Agent_phone = '$Agent_phone_up' WHERE Agent_ID = $Agent_ID_up ";
$result= mysqli_query($conn,$query) 
or die("Error:Unable to execute query".mysqli_error($conn));

//display message
echo "<p style=\color:green\">The record was updated successfully</p>";
mysqli_close($conn);

header("Location:allAgents.php");
    ?>
</body>
</html>