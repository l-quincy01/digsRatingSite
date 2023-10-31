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

<div class="TenantContainer" style = "margin-top: 20px; min-height: 800px ; min-width: 800px">




<?php
if(isset($_REQUEST['submit'])){
    //fetch name from form
    $reportchosen=$_REQUEST['report'];
    //database credentials
require_once("config.php");

//connect to database 
$conn= mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE)
or die("Error:unable to connect to the database!");

if($reportchosen == "tenants"){
    //issue query instructions '
    $query = "SELECT Tenant_Fname, Tenant_Lname, Tenant_Gender
    FROM thecreatorscollective.tenant
    ORDER BY Tenant_Lname ASC;";
$result= mysqli_query($conn,$query)  or die("Error:Unable to execute query");

echo "<h2>The Registered Tenants<h2>
        <table>
        <tr>
        <td><strong>Tenant name</strong></td>
        <td><strong>Gender</strong></td>
        </tr>";
//populate table
while($row = mysqli_fetch_array($result)){
    echo "<tr>";
    echo "<td>" .$row['Tenant_Fname'] . " " . $row['Tenant_Lname']. "</td>";
    echo "<td>" . $row['Tenant_Gender'] . "</td>";
    echo "</tr>";
}
echo "</table>";
}
elseif($reportchosen == "digs"){
    //issue query instructions '
    $query = "SELECT Digs_name, Digs_address
    FROM thecreatorscollective.digs
    ORDER BY Digs_name ASC;";
$result= mysqli_query($conn,$query)  or die("Error:Unable to execute query");

echo "<h2>Agents with the most listings<h2>
        <table>
        <tr >
        <td><strong>Digs name</strong></td>
        <td><strong>Digs Address</strong></td>
        </tr>";
//populate table
while($row = mysqli_fetch_array($result)){
    echo "<tr>";
    echo "<td>" . $row['Digs_name']. "</td>";
    echo "<td>" . $row['Digs_address'] . "</td>";
    echo "</tr>";
}
echo "</table>";
}
elseif($reportchosen == "digsrated"){
    //issue query instructions '
    $query = "SELECT digs.Digs_name, ratings.rating, ratings.maintenance, ratings.noise_levels, ratings.agent_assistence 
    FROM  digs JOIN ratings ON digs.Digs_ID = ratings.Digs_ID;";
$result= mysqli_query($conn,$query)  or die("Error:Unable to execute query");

echo "<h2>Digs per selected criteria<h2>
        <table>
        <tr >
        <td><strong>Digs name</strong></td>
        <td><strong>Rating</strong></td>
        <td><strong>Maintenance</strong></td>
        <td><strong>Noise Levels</strong></td>
        <td><strong>Agent Assistence</strong></td>
        </tr>";
//populate table
while($row = mysqli_fetch_array($result)){
    echo "<tr>";
    echo "<td>" . $row['Digs_name']. "</td>";
    echo "<td>" . $row['rating'] . "</td>";
    echo "<td>" . $row['maintenance'] . "</td>";
    echo "<td>" . $row['noise_levels'] . "</td>";
    echo "<td>" . $row['agent_assistence'] . "</td>";
    echo "</tr>";
}
echo "</table>";
}
elseif($reportchosen == "listings"){
    //issue query instructions '
    $query = "SELECT Agent_Fname, Agent_Lname, count(digs.Agent_ID) 
    FROM thecreatorscollective.agent
    INNER JOIN thecreatorscollective.digs ON agent.Agent_ID = digs.Agent_ID
    GROUP BY agent.Agent_ID, digs.Agent_ID
    ORDER BY count(digs.Agent_ID) DESC ;";
    $result= mysqli_query($conn,$query)  or die("Error:Unable to execute query");
    
    echo "<h2>Agents with the most listings<h2>
            <table>
            <tr bgcolor >
            <td><strong>Agent full name</strong></td>
            <td><strong>Number of listings under agent</strong></td>
            </tr>";
    //populate table
    while($row = mysqli_fetch_array($result)){
        echo "<tr>";
        echo "<td>" .$row['Agent_Fname'] . " " . $row['Agent_Lname']. "</td>";
        echo "<td>" . $row['count(digs.Agent_ID)'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
}}
?>

</div>



</body>

</html>