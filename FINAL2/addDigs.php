
<?php
  require_once("secure.php");
?>

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
session_start();
?>

<main> 
    
<form action="adddigs.php" method="post" enctype="multipart/form-data" class="modern-form" style = "top: 52.5%;">
      <div class="images-name">
        <label for="images">Picture:</label><br>
        <input type="file" name="images" id="images" width="450" height="350"  required><br>
        <label for="Digs_name" >Digs:</label><br>
        <input type="text" name= "Digs_name" ID="Digs_name"  required><br> 
        <label for="Digs_address" >Address:</label><br>
        <input type="text" name="Digs_address" id="Digs_address"  required><br>
        <label for="Digs_description" >Description:</label><br>
        <textarea id="Digs_description" name="Digs_description" rows="20" col="300" required></textarea><br>
        <label for="Rent_per_room" >Montly Rent:</label><br>
        <input type="text" name="Rent_per_room" id="Rent_per_room" required><br>
        <input type="submit" name="addDigs" value="Add">
    </form>
    <?php
if(isset($_REQUEST["addDigs"])){
    //fetching values
    $Digs_name= $_REQUEST['Digs_name'];
    $Digs_address= $_REQUEST['Digs_address'];
    $Digs_description = $_REQUEST['Digs_description'];
    $Rent_per_room =$_REQUEST['Rent_per_room'];
    $Digs_agent_number=$_REQUEST['Digs_agent_number'];
    
    $Agent_ID = $_SESSION["agentID"];
    
    //making it unique 
    $images =time() . $_FILES['images']['name'];

   //move the file to the upload folder 
    $destination= "Images/" . $images;
    move_uploaded_file($_FILES['images']['tmp_name'], $destination);


    //Adding database credentials
    require_once("config.php");

    //connecting to database
    $conn= mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
    or die("Error: Unable to connect to database");

    //issuing instructions
    $query= "INSERT INTO thecreatorscollective.digs(images, Digs_name, Digs_address , Digs_description, Rent_per_room, Agent_ID)
    VALUES('$images', '$Digs_name', '$Digs_address', '$Digs_description', '$Rent_per_room', '$Agent_ID')";
    $result= mysqli_query($conn,$query) 
    or die ("Error: Unable to execute query" .mysqli_error($conn));

    //close connection
    mysqli_close($conn);

    //message indicating successful indication 
    echo"<p style='color:blue;'>New Digs has been added</p>";

}
?>




</main>




</body>
</html>