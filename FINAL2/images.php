<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Images</title>
     <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

<!-- custom css file link  -->
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

<main>



<div class="TenantContainer" style = "margin-top: 20px;">
<?php
    //fetch database credentials
    require_once("config.php");
    //connect to database
    $conn= mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE)
or die("Error:unable to connect to the database!");

//issue query instructions
$query= "SELECT * FROM thecreatorscollective.images ";
$result= mysqli_query($conn,$query) 
or die("Error:Unable to execute query".mysqli_error($conn));

    echo "<table >
        <tr style=\"background-color: aqua;\">
            <Td '>Images</Td>
            <Td '>Image name</Td>
            <Td '>Image description</Td> 
            <Td '>Monthly Rent per room</Td>  
        </tr>";
while($row = mysqli_fetch_array($result)){
    echo "<tr>";
    echo "<td '>" . "<img src=\"//is3-dev.ict.ru.ac.za/SysDev/TheCreatorsCollective/Images/" . $row['images']."\">" . "</td>";


    echo "<td '>" . $row['images_name']. "</td>";
    echo "<td '>" . $row['images_description']. "</td>";
    echo "<td '>" . "<a href=\"deleteimages.php?id=" . $row['images_ID'] . "\" >
    <input type =\"button\" value=\"Delete\"onClick=\"return confirm('Are you sure you want to delete ?')\"></a>" . "</td>";
    echo "</tr>";

}
  echo   "</table>";

//close connection
mysqli_close($conn);
    ?>

</div>

</main>

</body>
<!-- footer section ends -->
</html>