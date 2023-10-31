<?php
  require_once("secure.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digsalot Index</title>
    <script src="https://kit.fontawesome.com/909be56dda.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">
    <style>

/* button styling*/
.viewButton {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: lightblue;
  text-align: center;
  cursor: pointer;
  border-radius: 8px;
  width: 100%;
  font-size: 18px;
}


.viewButton:hover, a:hover {
  opacity: 0.7;
}

    </style>
    
</head>
 
<body>


<?php
include 'navbarBase.php';
require_once("config.php");
?>

<?php
// include 'digsFetch.php';
?>



<!-- MAIN  -->
<main>
    <!--  Property grid  -->
    <?php
    // Check if search was performed
    if (isset($_REQUEST['submitSearch'])) {
        $searchInput = $_REQUEST["searchInput"];
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
            or die("Unable to connect to db");
        $searchQuery = "SELECT * FROM thecreatorscollective.digs WHERE Digs_name LIKE '%$searchInput%' OR Digs_address LIKE '%$searchInput%';";
      
      } else {
        $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
            or die("DATABASE ERROR: unable to validate your credentials!");
        $searchQuery = "SELECT * FROM thecreatorscollective.digs;";




    }

    $result = mysqli_query($conn, $searchQuery) or die("Query error");

    if (mysqli_num_rows($result) > 0) {
     
        while ($row = mysqli_fetch_assoc($result)) {
            ?>

            <div class="property-card" id="property1">
                <div class="property-image" style="max-width: 100%; max-height: 100%;">
                    <img src="//is3-dev.ict.ru.ac.za/SysDev/TheCreatorsCollective/Images/<?php echo $row['images']; ?>" style="max-width: 100%; min-height: 100%;">
                </div>
                <div class="property-details">
                    <div class="property-title"><?php echo $row["Digs_name"]; ?></div>
                    <div class="property-location"><?php echo $row["Digs_address"]; ?></div>
                    <div class="property-price"> R<?php echo $row["Rent_per_room"]; ?></div>
                    <div class="property-description"><?php echo $row["Digs_description"]; ?></div>
                    <form action="ratingsPage.php" method="post">
                        <input type="hidden" name="selectedDigsID" value="  <?php echo $row["Digs_ID"]; ?> ">
                             <button class = "viewButton" type="submit">View</button>
                    </form>
                    

                </div>
            </div>

            <?php
        } // end while
    } else {
        echo "<p>No results found for your search.</p>";
    }
    ?>
    <!-- END Property grid  -->
</main>

  
</body>



</html>