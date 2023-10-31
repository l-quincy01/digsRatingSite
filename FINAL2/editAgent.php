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
.TenantContainer {
    max-width: 1600px;
    max-height: 800px; /* Or whatever height you want it to be */
    
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

<div class="TenantContainer" style = "margin-top: 20px;">

<?php
    //fetching the ID from Agent.php
    $Agent_ID = $_REQUEST["id"];
    //fetch database credentials
    require_once("config.php");
    //connect to database
    $conn= mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DATABASE)
or die("Error:unable to connect to the database!");

//issue query instructions
$query= "SELECT * FROM thecreatorscollective.agent WHERE Agent_ID = $Agent_ID ";
$result= mysqli_query($conn,$query) 
or die("Error:Unable to execute query".mysqli_error($conn));
//fetching data from database
while($row = mysqli_fetch_array($result)){
            $Agent_Fname = $row['Agent_Fname'];
            $Agent_Lname=$row['Agent_Lname'];
            $Agent_office_address=$row['Agent_office_address'];
            $Agent_email_address=$row['Agent_email_address'];
            $Agent_phone=$row['Agent_phone'];
}

mysqli_close($conn);
    ?>

    <form action="updateAgent.php" method="POST">
     
            <h1>Update Agents</h1>
            <table>
                <tr>
                    <td>
                        <label for ="Agent_Fname">Agent First Name</label><br>
                        <input type="text" name="Agent_Fname" id="Agent_Fname" value="<?php echo $Agent_Fname;?>"required><br>
                        <label for ="Agent_Lname">Agent Last Name</label><br>
                        <input type="text" name="Agent_Lname" id="Agent_Lname" value="<?php echo $Agent_Lname;?>"required><br>
                        <label for ="Agent_office_address">Office Address</label><br>
                        <input type="text" name="Agent_office_address" id="Agent_office_address" value="<?php echo $Agent_office_address;?>"required><br>
                        <label for ="Agent_email_address">Agent email</label><br>
                        <input type="email" name="Agent_email_address" id="Agent_email_address" value="<?php echo $Agent_email_address;?>"required><br>
                        <label for ="Agent_phone">Agent phone number</label><br>
                        <input type="number" name="Agent_phone" id="Agent_phone" value="<?php echo $Agent_phone;?>"required><br>
                        <input type="hidden" name="agentid" id="agentid" value="<?php echo $Agent_ID;?>"required><br>
                        <input type="submit" name="submit" value="Update"> 
                    </td>
                </tr>
            </table>
       
    </form>



    </div>

</main>




</body>
</html>