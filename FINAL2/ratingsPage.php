

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
    <style>






.review-us-container {
    max-width: 1600px;
    position: relative; 
    margin: 20px auto; /* Gives some space above and below */
    padding: 40px;
    background-color: #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow-y: auto;
    width: 80vw; 
}


.container {
  position: relative;
}

/* Hide the images by default */
.mySlides {
  display: none;
}

/* Add a pointer when hovering over the thumbnail images */
.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 40%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

/* Container for image text */
.caption-container {
  text-align: center;
  background-color: #222;
  padding: 2px 16px;
  color: white;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Six columns side by side */
.column {
  float: left;
  width: 16.66%;
}

/* Add a transparency effect for thumnbail images */
.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

#starRatings .star {
    font-size: 2rem;
    cursor: pointer;
    color: lightgray;
}

#starRatings .star.active {
    color: gold;
}

#starRatings2 .star {
    font-size: 2rem;
    cursor: pointer;
    color: lightgray;
}

#starRatings2 .star.active {
    color: gold;
}


#starRatings3 .star {
    font-size: 2rem;
    cursor: pointer;
    color: lightgray;
}

#starRatings3 .star.active {
    color: gold;
}




textarea {
    width: 100%;
    padding: 10px;
    margin-top: 20px;
    resize: vertical;
    min-height: 100px;
}

        /* Star Rating Styles */
        .star-rating {
            font-size: 20px;
        }

        .star-rating i {
            color: black; /* Set the star color to black */
            cursor: pointer;
        }

        .star-rating i.active {
            color: yellow; /* Set the active (selected) star color to yellow */
        }


    </style>



</head>
 
<body>

<?php
include 'navbarBase.php';
require_once("config.php");
?>


<main>
    

<?php
$conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE)
or die("Unable to connect to db");

if (isset($_REQUEST['selectedDigsID'])  ) {
    $selectedDigsID = $_REQUEST['selectedDigsID'];
    //$_SESSION["selectedDigsIDRating"] = $selectedDigsID ;
    // Use this ID to fetch and display the desired data from the database
} else {
    echo "No Digs_ID received.";
}

$digs = "SELECT * FROM thecreatorscollective.digs WHERE Digs_ID = $selectedDigsID ; "; 
$result = mysqli_query($conn, $digs) or die("Query error");



if (mysqli_num_rows($result) > 0) {  //display slideshow
     
    while ($row = mysqli_fetch_assoc($result)) {

?>


    <div class="review-us-container" style = "margin-top: 20px;">
   



<!--  WHILE LOOP  -->
<div class="mySlides">

<!--  A count variable  -->
  <div class="numbertext">1 / 6</div>
    <img src= "//is3-dev.ict.ru.ac.za/SysDev/TheCreatorsCollective/Images/<?php echo $row['images']; ?>" style="width:100%">
</div>



<!-- Next and previous buttons -->
<a class="prev" onclick="plusSlides(-1)">&#10094;</a>
<a class="next" onclick="plusSlides(1)">&#10095;</a>

<!-- Image text -->
<div class="caption-container">
  <p id="caption"></p>
</div>

<!-- Thumbnail images -->
<div class="row">
    <!--  WHILE LOOP  -->
  <div class="column">
    <img class="demo cursor" src= "//is3-dev.ict.ru.ac.za/SysDev/TheCreatorsCollective/Images/<?php echo $row['images']; ?>" style="width:100%" onclick="currentSlide(1)" alt="<?php echo $row['Digs_name']; ?>">
  </div>

</div>




<!--  PRINT  -->
<h2><?php echo $row["Digs_name"]; ?></h2>
<h3>Description</h3>

<!--  PRINT  -->
<div id="descriptionArea"> <?php echo $row["Digs_description"]; ?><br> <br></div> 


<?php
        } // end while
    } else {
        echo "<p>No results found for your search.</p>";
    }
    ?>


<form action="ratingsPage.php" method="post">
            <!-- Adjust the size of the input field -->
            <div class="input-field">
                <!--<label for="username">Enter Digs Name: </label>-->
                <!--<input type="text" name="username" id="username" required>-->
                <br>
                <!-- Cleanliness Rating -->
                <label for="cleanliness">Cleanliness Rating:</label>
                <div class="star-rating" id="cleanliness">
                    <i class="fa fa-star" data-rating="1"></i>
                    <i class="fa fa-star" data-rating="2"></i>
                    <i class="fa fa-star" data-rating="3"></i>
                    <i class="fa fa-star" data-rating="4"></i>
                    <i class="fa fa-star" data-rating="5"></i>
                </div>
                <input type="hidden" name="cleanliness" value="3"> <!-- Hidden input to store the selected rating -->
                <br>
                <!-- Maintenance Rating -->
                <label for="maintenance">Maintenance Rating:</label>
                <div class="star-rating" id="maintenance">
                    <i class="fa fa-star" data-rating="1"></i>
                    <i class="fa fa-star" data-rating="2"></i>
                    <i class="fa fa-star" data-rating="3"></i>
                    <i class="fa fa-star" data-rating="4"></i>
                    <i class="fa fa-star" data-rating="5"></i>
                </div>
                <input type="hidden" name="maintenance" value="3"> <!-- Hidden input to store the selected rating -->
                <br>
                <!-- Noise levels Rating -->
                <label for="noise_levels">Noise levels Rating:</label>
                <div class="star-rating" id="noise_levels">
                    <i class="fa fa-star" data-rating="1"></i>
                    <i class="fa fa-star" data-rating="2"></i>
                    <i class="fa fa-star" data-rating="3"></i>
                    <i class="fa fa-star" data-rating="4"></i>
                    <i class="fa fa-star" data-rating="5"></i>
                </div>
                <input type="hidden" name="noise_levels" value="3"> <!-- Hidden input to store the selected rating -->
                <br>
                <!-- Agent assistance Rating -->
                <label for="agent_assistence">Agent Assistance Rating:</label>
                <div class="star-rating" id="agent_assistence">
                    <i class="fa fa-star" data-rating="1"></i>
                    <i class="fa fa-star" data-rating="2"></i>
                    <i class="fa fa-star" data-rating="3"></i>
                    <i class="fa fa-star" data-rating="4"></i>
                    <i class="fa fa-star" data-rating="5"></i>
                </div>
                <input type="hidden" name="agent_assistence" value="3"> <!-- Hidden input to store the selected rating -->
                <br>
                <label for="comment">Comment:</label><br>
                <textarea name="comment" id="comment" rows="4" cols="50" required></textarea>
                <input type="hidden" name="selectedDigsID" value="<?php echo $selectedDigsID; ?>">
                <br>
                <input type="submit" value="Submit Rating">
            </div>
        </form>




        <?php
     $selectedDigsID = $_POST["selectedDigsID"];

        // Query to retrieve comments (adjust the LIMIT as needed)
        $sql = "SELECT   tenant.Tenant_Fname, ratings.tenant_comment, ratings.rating, ratings.maintenance, ratings.noise_levels, ratings.agent_assistence
                FROM ratings
                JOIN tenant ON ratings.Tenant_ID = tenant.Tenant_ID
                WHERE ratings.Digs_ID = $selectedDigsID ;";


        $result = $conn->query($sql);

        if (!$result) {
            die("Error: " . $conn->error);
        }

        // Check if there are rows returned
        if ($result->num_rows > 0) {

          echo '<div style = "flex-container"> ' ; 
            while ($row = $result->fetch_assoc()) {
                // Generate a card for each comment


               
               
                echo  ' <div class="property-card"  id="property1"  >';
               
                echo '<div class="comment-cell">' .'<strong>'. "Comment: " .'</strong>'. "<br>" . $row["tenant_comment"] . "<br>" .'</div>';
                
                // Display the star rating for cleanliness
                echo '<strong>'."Cleanliness: ".'</strong>' . "<br>";
                for ($i = 1; $i <= $row["rating"]; $i++) {
                    echo '<i class="fa fa-star star-rating"></i>';
                }
                echo '<br>';

                // Display the star rating for maintenance
                echo '<strong>'."Maintenance: " . '</strong>'."<br>";
                for ($k = 1; $k <= $row["maintenance"]; $k++) {
                    echo '<i class="fa fa-star star-rating"></i>';
                }
                echo "<br>";
                // Display the star rating for noise levels
                echo '<strong>'. "Noise Levels: " .'</strong>'. "<br>";
                for ($i = 1; $i <= $row["noise_levels"]; $i++) {
                    echo '<i class="fa fa-star star-rating"></i>';
                }
                echo "<br>";
                // Display the star rating for agent assistance
                echo '<strong>'."Agent Assistance: " .'</strong>'. "<br>";
                for ($i = 1; $i <= $row["agent_assistence"]; $i++) {
                    echo '<i class="fa fa-star star-rating"></i>';
                }

                echo ' </div>';
            
            }

            echo '</div>';


        } else {
            echo "No comments found.";
        }
        ?>
	
    </div>

</main>


<!--  USED TO INSERT THE RATING GIVEN INTO THE DATABASE-->
<?php
require_once("secure.php");
require_once("config.php");

// Connect to database
$conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get ratings and comments
    $rating = $_POST['cleanliness'];
    $comment = $_POST['comment'];
    $maintenance = $_POST['maintenance'];
    $noise_levels = $_POST['noise_levels'];
    $agent_assistence = $_POST['agent_assistence'];
    $Tenant_ID = $_SESSION["tenantID"];
    $selectedDigsID = $_POST["selectedDigsID"];

    // Insert into the database
    $stmt = $conn->prepare("INSERT INTO ratings (tenant_comment, rating, maintenance, noise_levels, agent_assistence, Tenant_ID, Digs_ID) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("siiiiii", $comment, $rating, $maintenance, $noise_levels, $agent_assistence, $Tenant_ID, $selectedDigsID);
    if ($stmt->execute()) {
        $message = "Rating and comment submitted successfully!";
        echo "   Rating and comment submitted successfully!  ";
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}

$selectedDigsID = $_REQUEST['selectedDigsID'] ?? null;
$digs = [];
if ($selectedDigsID) {
    $stmt = $conn->prepare("SELECT * FROM thecreatorscollective.digs WHERE Digs_ID = ?");
    $stmt->bind_param("i", $selectedDigsID);
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $digs[] = $row;
    }
    $stmt->close();
}

?>

<script>

let slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let dots = document.getElementsByClassName("demo");
  let captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
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