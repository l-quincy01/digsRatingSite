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
            <Td>Tenant First name</Td>
            <Td>Tenant Last name</Td>
            <Td>Tenant Phone name</Td>
            <Td>Tenant email</Td>
            <Td>Tenant gender</Td>
            
        </tr>
        
        <?php 
       
    
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
        or die("DATABASE ERROR: unable to validate your credentials!");
            $agentDigsQuery = "SELECT * FROM thecreatorscollective.tenant;  "; //where agentID = agentID

            $result = mysqli_query($conn, $agentDigsQuery) or die("Query error");

            if (mysqli_num_rows($result) > 0) {
             
                while ($row = mysqli_fetch_assoc($result)) {
        ?>


        <tr>
         <td><?php echo $row["Tenant_Fname"]; ?></td>
         <td><?php echo $row["Tenant_Lname"]; ?></td>
         <td><?php echo $row["Tenant_Phone"]; ?></td>
         <td><?php echo $row["Tenant_email"]; ?></td>
         <td><?php echo $row["Tenant_Gender"]; ?></td>
         <?php echo "<td style='border: 1px solid #000; padding: 8px;'> <a href=\"editTenant.php?id=" . $row['Tenant_ID'] . "\" ><input type =\"button\" value=\"Edit\" class=\"btn\">" . "</td>"; ?>
       

    
         </tr>

         <?php
        } // end while
    } else {
        echo "<p>No results found for your search.</p>";
    }
    ?>

</table>  

</div>


<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>

</html>