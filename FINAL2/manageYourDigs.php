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

$agentID = $_SESSION["agentID"];
//issue query instructions
$query= "SELECT * FROM thecreatorscollective.digs WHERE Agent_ID = $agentID ";
$result= mysqli_query($conn,$query) 
or die("Error:Unable to execute query".mysqli_error($conn));

if (mysqli_num_rows($result) > 0) {
    echo "<table>
        <tr>
            <Td>Images</Td>
            <Td>Digs name</Td>
            <Td>Digs address</Td>
            <Td>Digs description</Td> 
            <Td>Monthly Rent per room</Td>  
        </tr>";
while($row = mysqli_fetch_array($result)){
    echo "<tr>";
    echo "<td>" . $row['Digs_name']. "</td>";
    echo "<td>" . $row['Digs_address']. "</td>";
    echo "<td>" . $row['Digs_description']. "</td>";
    echo "<td>" . $row['Rent_per_room']. "</td>";
    echo "<td>" . "<a href=\"editDigs.php?id=" . $row['Digs_ID'] . "\" ><input type =\"button\"  class=\"btn\" value=\"Edit\">" . "</td>";
    echo "</tr>";
    echo   "</table>";
} 




}else {

    echo "<table>
    <tr>
        <Td> You Have No Digs Added</Td>
        
    </tr>
    </table>";

}

 





//close connection
mysqli_close($conn);
    ?>

</div>


<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>

</html>