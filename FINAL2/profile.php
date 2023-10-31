

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

<main style = "padding-top: 40px; padding-left: 40px; padding-right: 40px;">
 <!--  profile-->



 <div class="card">
    <h2>Your Profile</h2>
  

            <table>
               
                    <tr>
                        <td>First Name</td>
                        <td>:</td>
                        <td>    <?php echo $_SESSION["fName"]; ?> </td>
                    </tr>
                    <tr>
                        <td>Last Name</td>
                        <td>:</td>
                        <td>  <?php echo $_SESSION["lName"]; ?></td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>:</td>
                        <td><?php echo $_SESSION["phone"];   ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td> <?php echo $_SESSION["email"]; ?> </td>
                    </tr>
                    
              
            </table>
    
</div>


</main>

</body>



</html>