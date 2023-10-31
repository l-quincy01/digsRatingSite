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

<table>
        <tr>
            <Td>Digs name</Td>
            <Td>Digs address </Td>
            <Td>Digs description</Td>
            <Td>Rent per room</Td> 
            
        </tr>
        
        <?php 
      
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
        or die("DATABASE ERROR: unable to validate your credentials!");
            $agentDigsQuery = "SELECT * FROM thecreatorscollective.digs;  "; 

            $result = mysqli_query($conn, $agentDigsQuery) or die("Query error");

            if (mysqli_num_rows($result) > 0) {
             
                while ($row = mysqli_fetch_assoc($result)) {
        ?>


        <tr>
         <td><?php echo $row["Digs_name"]; ?></td>
         <td><?php echo $row["Digs_address"]; ?></td>
         <td><?php echo $row["Digs_description"]; ?></td>
         <td><?php echo $row["Rent_per_room"]; ?></td>
         </tr>

         <?php
        } // end while
    } else {
        echo "<p>No results found for your search.</p>";
    }
    ?>

</table>  

</div>



</body>

</html>