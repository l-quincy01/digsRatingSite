<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php

//credentials
require_once("config.php");
    //fetch data from form 
    $Tenant_Fname = $_REQUEST['Tenant_Fname'];
    $Tenant_Lname=$_REQUEST['Tenant_Lname'];
    $Tenant_email_up=$_REQUEST['Tenant_email'];
     $Tenant_Phone_up=$_REQUEST['Tenant_Phone'];
     $Tenant_ID_up = $_REQUEST['tenantid'];

     //make connection
     $conn= mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE)
or die("Error:unable to connect to the database!");

//issue query instructions
$query= "UPDATE tenant SET Tenant_Fname = '$Tenant_Fname', Tenant_Lname = '$Tenant_Lname', Tenant_email = '$Tenant_email_up' , Tenant_Phone = '$Tenant_Phone_up' WHERE Tenant_ID = $Tenant_ID_up ";
$result= mysqli_query($conn,$query) 
or die("Error:Unable to execute query".mysqli_error($conn));

mysqli_close($conn);
//display message to confirm update
echo "<p style=\color:green\">The record was updated successfully</p>";
header("Location:allTenants.php");
    ?>
</body>
</html>