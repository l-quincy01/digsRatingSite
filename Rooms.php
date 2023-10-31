<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
     <!-- font awesome cdn link  -->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!-- custom css file link  -->
<link rel="stylesheet" href="css/style.css">
<style>
     .code {
         font-family: Arial, sans-serif; /* Change the font to Arial */
         text-align: center; /* Center text horizontally */
         margin: 0; /* Remove default margin */
         padding: 0; /* Remove default padding */
         display: flex;
         justify-content: center; /* Center content horizontally */
         height: 100vh; /* Set the height to 100% of the viewport */
         color:#000000;
         font-size:18px;
     }

 </style>
</head>
<body>
    <!-- header section starts-->
    <header class="header">

<nav class="navbar nav-1">
   <section class="flex">
      <a href="Agentpage.php" class="logo"><i class="fas fa-house"></i>Agents</a>

      
   </section>
    </nav>
    <div>
<?php
    //fetch database credentials
    require_once("config.php");
    //connect to database
    $conn= mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE)
or die("Error:unable to connect to the database!");

//issue query instructions
$query= "SELECT * FROM thecreatorscollective.rooms ";
$result= mysqli_query($conn,$query)   
or die("Error:Unable to execute query".mysqli_error($conn));
 
        echo "<table style='border-collapse: collapse; width: 100%;' border='1'>
        <tr style=\"background-color: Aqua;\">
            <th style=\"font-size: 18px;\">Room number</th>
            <th style=\"font-size: 18px;\">Type of room</th>
            <th style=\"font-size: 18px;\">Number of occupants for room</th>
            <th style=\"font-size: 18px;\">Rent per room</th> 
        </tr>"; 
while($row = mysqli_fetch_array($result)){
    echo "<tr>";
    echo "<td style=\"font-size: 16px;\">" . $row['Room_number']. "</td>";
    echo "<td style=\"font-size: 16px;\">" . $row['Room_type']. "</td>";
    echo "<td style=\"font-size: 16px;\">" . $row['Room_Capacity']. "</td>";
    echo "<td style=\"font-size: 16px;\">" . $row['Rent_per_month']. "</td>";
    echo "<td>" . "<a href=\"deleteRooms.php?id=" . $row['Room_ID'] . "\" >
    <input type =\"button\" value=\"Delete\"onClick=\"return confirm('Are you sure you want to delete ?')\"></a>" . "</td>";
    echo "</tr>";

}
  echo   "</table>";

//close connection
mysqli_close($conn);

    ?>
     </div>
<!-- custom js file link  -->
<script src="js/script.js"></script>
</body>

<!-- footer section starts  -->
<footer class="footer">
 
 <section class="flex">

    <div class="box">
       <a href="tel:013-344-8612"><i class="fas fa-phone"></i><span>013-344-8612</span></a>
       <a href="tel:011-321-6678"><i class="fas fa-phone"></i><span>011-321-6678</span></a>
       <a href="email:digslot.ght@gmail.com"><i class="fas fa-envelope"></i><span>digslot.ght@gmail.com</span></a>
       <a href="#"><i class="fas fa-map-marker-alt"></i><span>3102 Gilbert Street Makhanda, 6139</span></a>
    </div>

    <div class="box">
       <a href="home.html"><span>home</span></a>
       <a href="about.html"><span>about</span></a>
       <a href="contact.html"><span>contact</span></a>
       <a href="listings.html"><span>all listings</span></a>
       <a href="#"><span>saved properties</span></a>
    </div>

    <div class="box">
       <a href="#"><span>facebook</span><i class="fab fa-facebook-f"></i></a>
       <a href="#"><span>twitter</span><i class="fab fa-twitter"></i></a>
       <a href="#"><span>linkedin</span><i class="fab fa-linkedin"></i></a>
       <a href="#"><span>instagram</span><i class="fab fa-instagram"></i></a>

    </div>

 </section>

 <div class="credit">&copy; copyright @ 2023 by <span>Digsalot</span> | all rights reserved!</div>

</footer>
<!-- footer section ends -->
</html>