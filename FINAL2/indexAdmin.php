<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <script src="https://kit.fontawesome.com/909be56dda.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles.css">


    <style>

.TenantContainer {
    min-width: 800px;
    min-height: 800px; /* Or whatever height you want it to be */
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



</head>
 
<body>

<?php
include 'navbarBase.php';
require_once("config.php");
?>



<main>
    


<!--  Property grid  -->
 <!--  <div class="property-grid">  -->


 <div class="TenantContainer" style = "margin-top: 20px;">


 <?php 
 
 
 echo "

 <center> <h1> Welcome Back Digs Alot Admin. Manage the system using the navigation links above</h1> </center>
     
 ";


 ?>

 
</div>



 <!--   </div> -->
<!-- END Property grid  -->

</main>





<!-- MAIN  -->

































<!-- Login/Sign up script  -->
<script>
    /*function redirectToLogin() {
      // Replace 'login.php' with the actual path to your login page.
      window.location.href = 'login.php';

      
    }*/
function openLogin() {
  document.getElementById("loginForm").style.display = "block";
}

function closeLogin() {
  document.getElementById("loginForm").style.display = "none";
}


function openSignUp() {
 document.getElementById("loginForm").style.display = "none";
  document.getElementById("signUpForm").style.display = "block";
}

function closeSignUp() {
  document.getElementById("signUpForm").style.display = "none";
}

    </script>

<!-- Login/Sign up script  -->


<footer>
    <!-- Your footer content goes here -->
    <p>&copy; 2023 Digsalot. All rights reserved.</p>
</footer>


    
</body>



</html>