<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://kit.fontawesome.com/909be56dda.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">

</head>
 
<body>

<?php
include 'navbarBase.php';
require_once("config.php");
?>

<main>


<?php
    //fetching the ID from Agent.php
    $Digs_ID = $_REQUEST['id'];
    //fetch database credentials
    require_once("config.php");
    //connect to database
    $conn= mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE)
or die("Error:unable to connect to the database!");

//issue query instructions
$query= "SELECT * FROM thecreatorscollective.digs WHERE Digs_ID = $Digs_ID ";
$result= mysqli_query($conn,$query) 
or die("Error:Unable to execute query".mysqli_error($conn));
//fetching data from database
while($row = mysqli_fetch_array($result)){
            $Digs_name = $row['Digs_name'];
            $Digs_address=$row['Digs_address'];
            $Digs_description=$row['Digs_description'];
            $Rent_per_room=$row['Rent_per_room'];
}
 
mysqli_close($conn);
    ?>

<form action="UpdatedigsAdmin.php" method="POST" class="modern-form ">
      
      <h1>Update Digs</h1>
      
                        <label for ="Digs_name">Digs Name</label><br>
                        <input type="text" name="Digs_name" id="Digs_name" value="<?php echo $Digs_name;?>"required><br>
                        <label for ="Digs_address">Digs address</label><br>
                        <input type="text" name="Digs_address" id="Digs_address" value="<?php echo $Digs_address;?>"required><br>
                        <label for ="Digs_description">Description</label><br>
                        <input type="text" name="Digs_description" id="Digs_description" value="<?php echo $Digs_description;?>"required><br>
                        <label for ="Rent_per_room">Monthly Rent</label><br>
                        <input type="number" name="Rent_per_room" id="Rent_per_room" value="<?php echo $Rent_per_room;?>"required><br>
                        <input type="hidden" name="digsid" id="digsid" value="<?php echo $Digs_ID;?>"required><br>
                        <input type="submit" name="submit" value="Update"> 
        
     
 
</form>







</main>

<footer>
    <!-- Your footer content goes here -->
    <p>&copy; 2023 Your Website Name. All rights reserved.</p>
</footer>


</body>
</html>