


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tenant</title>
 <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="styles.css">
</head>

<style>

.TenantContainer {
    max-width: 1600px;
    max-height: 800px; /* Or whatever height you want it to be */
    
    margin: 20px auto; /* Gives some space above and below */
    padding: 40px;
    background-color: #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow-y: auto;
    width: 80vw; 
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    
}


</style>




<body>

<?php
include 'navbarBase.php';
require_once("config.php");
session_start();
?>

<div class="TenantContainer" style = "margin-top: 20px;">

<?php
    //fetch database credentials
    require_once("config.php");
    //connect to database
    $conn= mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE)
or die("Error:unable to connect to the database!");

//issue query instructions
$query= "SELECT * FROM thecreatorscollective.agent ";
$result= mysqli_query($conn,$query)   
or die("Error:Unable to execute query".mysqli_error($conn));


        echo "<table style='border-collapse: collapse; width: 100%;' border='1'>
        <tr >
            <th >Agent name</th>
            <th >Agent surname</th>
            <th >Office address</th>
            <th >Email</th> 
            <th >Phone number</th>  
        </tr>";
while($row = mysqli_fetch_array($result)){
    echo "<tr>";
    echo "<td style='border: 1px solid #000; padding: 8px;'>" . $row['Agent_Fname']. "</td>";
    echo "<td style='border: 1px solid #000; padding: 8px;'>" . $row['Agent_Lname']. "</td>";
    echo "<td style='border: 1px solid #000; padding: 8px;'>" . $row['Agent_office_address']. "</td>";
    echo "<td style='border: 1px solid #000; padding: 8px;'>" . $row['Agent_email_address']. "</td>";
    echo "<td style='border: 1px solid #000; padding: 8px;'>" . $row['Agent_phone']. "</td>";
    echo "<td style='border: 1px solid #000; padding: 8px;'>" . "<a href=\"editAgent.php?id=" . $row['Agent_ID'] . "\" ><input type =\"button\" value=\"Edit\" class=\"btn\">" . "</td>";
              
    echo "</tr>";

}
  echo   "</table>";





//close connection
mysqli_close($conn);


    ?>  

</div>



</body>

</html>