

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
?>

<main>
    
    <div class="contact-us-container">
    
 <section class="contact">
 
    <div class="row">
       <div class="image">
          <img src="images/Picture 1.png" alt="">
       </div>
       <form action="contact.php" method="post">
         <fieldset>  
            <legend><strong>Get in Touch</strong></legend>
          <label for="Enter your name" class="labels" >Name:</label>
          <input type="text" name="name" required maxlength="50" placeholder="Enter your name" class="box">
          <label for="Enter your email" class="labels" >Email:</label>
          <input type="email" name="email_address" required maxlength="50" placeholder="Enter your email" class="box">
          <label for="Enter your number" class="labels"  >Number:</label>
          <input type="number" name="number" required maxlength="10" max="9999999999" min="0" placeholder="Enter your number" class="box">
          <label for="Enter your message" class="labels"  >Message:</label>
          <textarea name="message" placeholder="Enter your message" required maxlength="1000" cols="30" rows="10" class="box" style="border: 1px solid #000; width: 90%;"></textarea> <br>
          <br>
          <input type="submit" value="send message" name="send" class="btn" onclick="toggle()">
         </fieldset>  
       </form>
    </div>
 
 </section>
    </div>

</main>

<?php
if (isset ($_REQUEST['send'])){
    //get values from form 
    $name = $_REQUEST['name'];
    $email_address = $_REQUEST['email_address'];
    $number = $_REQUEST['number'];
    $message = $_REQUEST['message'];
    //add database credentials
    require_once("config.php");
    //make connection to database
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("Error: Unable to connect to the database!");
    
    $query = "INSERT INTO queries(name, email_address, number, message) VALUE('$name', '$email_address', '$number', '$message')";
    $result = mysqli_query($conn, $query) or die("Error: Unable to send message");
    
    //close the connection to the database
    mysqli_close($conn);

    //display message to confirm the data was inserted
    echo "<p style=\"color:blue;\"> Message was sent successfully!</p>";
}
    ?>


</body>
</html>