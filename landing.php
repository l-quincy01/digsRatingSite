<?php
session_start();
//$_SESSION['accountType'] = null;
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

.error {
    color: red;
    font-weight: bold;
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

        $searchQuery = "SELECT 
        digs.Digs_ID,
        digs.Digs_name,
        digs.Digs_address,
        digs.Rent_per_room,
        digs.Digs_description,
        digs.images,
        COUNT(Digs_name) As reviewCount,
        ROUND(AVG(((ratings.rating + ratings.maintenance + ratings.noise_levels + ratings.agent_assistence) / 20) * 5), 0) AS total_rating
    FROM
        digs 
         JOIN
        ratings ON digs.Digs_ID = ratings.Digs_ID
    GROUP BY
        digs.Digs_ID,
        digs.Digs_name,
        digs.Digs_address,
        digs.Rent_per_room,
        digs.Digs_description,
        digs.images; ";


   



    }

  //  $result2 = mysqli_query($conn, $avgRatingQuery) or die("Query error");
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
                    <center>
                    <div class="property-rating" > Average Rating: 
                     

                        <?php 
                        if( $row["total_rating"] == 0 ){

                                echo 'NO RATING FOR THIS DIGS';
                        }
                         else{

                            for ($k = 1; $k <= $row["total_rating"]; $k++) {
                                echo '<i class="fa fa-star star-rating" style = "color: hsl(52, 54%, 47%)  "></i>';
                             }
                         }
                             
                             
                             ?>
                        
                        <span>  ( <?php 
                        if( $row["total_rating"] == 0 ) {

                            echo "No Reviews" ;
                        } 
                        else {
                            echo $row["reviewCount"];
                        }
                        
                        
                        
                        ?> Reviews )
                    
                    </span>

                    </div>
                    </center>
                  
                    <form action="viewDigs.php" method="post">
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


<script>

function handleStarRating(ratingInput, ratingValue) {
            const stars = document.querySelectorAll(`${ratingInput} i`);
            stars.forEach((star, index) => {
                star.addEventListener("click", () => {
                    // Set the hidden input value to the selected rating
                    document.querySelector(`input[name="${ratingInput.substring(1)}"]`).value = index + 1;
                    stars.forEach((s, i) => {
                        s.classList.toggle("active", i <= index);
                    });
                });
            });
        }

        // Call the function for cleanliness, maintenance, noise levels, and agent assistance ratings
        handleStarRating("#cleanliness", 3); // Initialize with a default rating of 3
        handleStarRating("#maintenance", 3); // Initialize with a default rating of 3
        handleStarRating("#noise_levels", 3); // Initialize with a default rating of 3
        handleStarRating("#agent_assistence", 3); // Initialize with a default rating of 3


</script>

  
</body>



</html>