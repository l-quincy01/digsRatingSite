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
require_once("config.php");
?>

<main>

<?php
    //fetching the ID from Tenant.php
    $Tenant_ID = $_REQUEST['id'];
    //fetch database credentials
    require_once("config.php");
    //connect to database
    $conn= mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE)
or die("Error:unable to connect to the database!");

//issue query instructions
$query= "SELECT * FROM thecreatorscollective.tenant WHERE Tenant_ID = $Tenant_ID ";
$result= mysqli_query($conn,$query) 
or die("Error:Unable to execute query".mysqli_error($conn));
//fetching data from database
while($row = mysqli_fetch_array($result)){
            $Tenant_Fname = $row['Tenant_Fname'];
            $Tenant_Lname=$row['Tenant_Lname'];
            $Tenant_Phone=$row['Tenant_Phone'];
            $Tenant_email=$row['Tenant_email'];
            $Tenant_Gender=$row['Tenant_Gender'];
}

mysqli_close($conn)
    ?>

    <form action="updatetenant.php" method="POST">
        <fieldset>
            <h1>Update Tenants</h1>
            <table>
                <tr>
                    <td>
                        <label for ="Tenant_Fname">Tenant First Name</label><br>
                        <input type="text" name="Tenant_Fname" id="Tenant_Fname" value="<?php echo $Tenant_Fname;?>"required><br>
                        <label for ="Tenant_Lname">Tenant Last Name</label><br>
                        <input type="text" name="Tenant_Lname" id="Tenant_Lname" value="<?php echo $Tenant_Lname;?>"required><br>
                        <label for ="Tenant_Phone">Tenant Phone number</label><br>
                        <input type="text" name="Tenant_Phone" id="Tenant_Phone" value="<?php echo $Tenant_Phone;?>"required><br>
                        <label for ="Tenant_email">Tenant email</label><br>
                        <input type="email" name="Tenant_email" id="Tenant_email" value="<?php echo $Tenant_email;?>"required><br>
                        <label for ="Tenant_Gender">Gender</label><br>
                        <input type="text" name="Tenant_Gender" id="Tenant_Gender" value="<?php echo $Tenant_Gender;?>"required><br>
                        <input type="hidden" name="tenantid" id="tenantid" value="<?php echo $Tenant_ID;?>"required><br>
                        <input type="submit" name="submit" value="Update"> 
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>



</main>

<footer>
    <!-- Your footer content goes here -->
    <p>&copy; 2023 Your Website Name. All rights reserved.</p>
</footer>


</body>
</html>