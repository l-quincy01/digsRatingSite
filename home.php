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
button {
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

a {
  text-decoration: none;
  font-size: 22px;
  color: black;
}

button:hover, a:hover {
  opacity: 0.7;
}

/* Style the tab */
.tab {
  overflow: hidden;
  color: black ;
  background-color: white;
  display: flex;
  width: 60% ;
align-items: center;
justify-content: space-between;
margin-top: 5% ;
            
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
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


<!-- Tab links -->
<center>
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')">London</button>
  <button class="tablinks" onclick="openCity(event, 'Paris')">Paris</button>
  <button class="tablinks" onclick="openCity(event, 'Tokyo')">Tokyo</button>
</div> </center>

<!-- Tab content -->
<div id="London" class="tabcontent">
  <h3>London</h3>
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
            digs.images
            LIMIT 4; "; }

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
                             for ($k = 1; $k <= $row["total_rating"]; $k++) {
                                echo '<i class="fa fa-star star-rating" style = "color: hsl(52, 54%, 47%)  "></i>';
                             }?>
                        
                        <span>  ( <?php echo $row["total_rating"]; ?> Reviews )</span>
                    </div>
                    </center>
                  
                    <form action="ratingsPage.php" method="post">
                        <input type="hidden" name="selectedDigsID" value="  <?php echo $row["Digs_ID"]; ?> ">
                             <button type="submit">View</button>
                    </form>
                    

                </div>
            </div>

            <?php
        } // end while
    } else {
        echo "<p>No results found for your search.</p>";
    }
    ?>


</main>
</div>

<div id="Paris" class="tabcontent">
  <h3>Paris</h3>
  
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
            digs.images
            LIMIT 4; "; }

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
                             for ($k = 1; $k <= $row["total_rating"]; $k++) {
                                echo '<i class="fa fa-star star-rating" style = "color: hsl(52, 54%, 47%)  "></i>';
                             }?>
                        
                        <span>  ( <?php echo $row["total_rating"]; ?> Reviews )</span>
                    </div>
                    </center>
                  
                    <form action="ratingsPage.php" method="post">
                        <input type="hidden" name="selectedDigsID" value="  <?php echo $row["Digs_ID"]; ?> ">
                             <button type="submit">View</button>
                    </form>
                    

                </div>
            </div>

            <?php
        } // end while
    } else {
        echo "<p>No results found for your search.</p>";
    }
    ?>


</main>
</div>

<div id="Tokyo" class="tabcontent">
  <h3>Tokyo</h3>
  
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
            digs.images
            LIMIT 4; "; }

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
                             for ($k = 1; $k <= $row["total_rating"]; $k++) {
                                echo '<i class="fa fa-star star-rating" style = "color: hsl(52, 54%, 47%)  "></i>';
                             }?>
                        
                        <span>  ( <?php echo $row["total_rating"]; ?> Reviews )</span>
                    </div>
                    </center>
                  
                    <form action="ratingsPage.php" method="post">
                        <input type="hidden" name="selectedDigsID" value="  <?php echo $row["Digs_ID"]; ?> ">
                             <button type="submit">View</button>
                    </form>
                    

                </div>
            </div>

            <?php
        } // end while
    } else {
        echo "<p>No results found for your search.</p>";
    }
    ?>
</main>


</div>




<!-- MAIN  -->

    
  
    <!-- END Property grid  -->




<script>

function openCity(evt, cityName) {
  // Declare all variables
  var i, tabcontent, tablinks;

  // Get all elements with class="tabcontent" and hide them
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Get all elements with class="tablinks" and remove the class "active"
  tablinks = document.getElementsByClassName("tablinks");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Show the current tab, and add an "active" class to the button that opened the tab
  document.getElementById(cityName).style.display = "block";
  evt.currentTarget.className += " active";
}
    
   // Function to handle star rating selection
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