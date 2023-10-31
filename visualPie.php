

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
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          ['Female',    6],
          ['Male',      4],
        ]);

        var options = {
          title: 'Tenant Gender'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>



    <style>


.review-us-container {
    max-width: 1200px;
    position: relative; 
    margin: 20px auto; /* Gives some space above and below */
    padding: 40px;
    background-color: #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    border-radius: 10px;
    overflow-y: auto;
    width: 80vw; 
}



    </style>



</head>
 
<body>

<?php
include 'navbarBase.php';
require_once("config.php");
?>


<main>
    




    <div class="review-us-container" style = "margin-top: 20px;">
   


    <div id="piechart" style="width: 900px; height: 500px;"></div>

  


    </div>

</main>


<!--  USED TO INSERT THE RATING GIVEN INTO THE DATABASE-->
<?php

if (isset($_REQUEST['submitRating'])) 
{
    $comment = $_REQUEST["user_comment"];
    $tenantID = $_SESSION["tenantID"];
    //$starRating = $_REQUEST["star_rating"]; // Retrieving the star rating

    require_once("config.php");

    $conn =  mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) ;

    // Adjusted the query to include the star_rating value
    $query = "INSERT INTO ratings(tenant_comment, rating, Tenant_ID) VALUES('$comment' ,'$tenantID');";

    $result = mysqli_query($conn, $query) or die("insert comment query error");
    // Removed echo statement here

    header("Location:index.php");
    mysqli_close($conn);
    exit;
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


let stars = document.querySelectorAll(".star");
let ratingValue = 0;

stars.forEach(star => {
    star.addEventListener("click", function() {
        let value = this.getAttribute("data-value");
        setStarRating(value);
    });
});

function setStarRating(value) {
    ratingValue = value;
    stars.forEach(star => {
        star.classList.remove("active");
        if(star.getAttribute("data-value") <= value) {
            star.classList.add("active");
        }
    });
    // Send this ratingValue to your PHP backend. You can use hidden input field or AJAX.
    // For now, let's use a hidden input field.
    let hiddenInput = document.createElement("input");
    hiddenInput.type = "hidden";
    hiddenInput.name = "star_rating";
    hiddenInput.value = ratingValue;
    document.querySelector("form").appendChild(hiddenInput);
}


</script>


</body>
</html>