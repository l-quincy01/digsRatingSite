<?php
if (isset($_REQUEST['signupClick'])) {
    require_once("config.php");

    // get values from form
    $email = $_REQUEST["email"];
    $username = $_REQUEST["username"];
    $password = $_REQUEST['password'];
    $fname = $_REQUEST['fname'];
    $lname = $_REQUEST['lname'];
    $number = $_REQUEST["number"];
    $gender = $_REQUEST["gender"];
    $isAgent = $_REQUEST["isAgent"];

    if ($isAgent == "tenant") {
        $isAgentBoolean = 0;
    } elseif ($isAgent == "agent") {
        $isAgentBoolean = 1;
    } else {
        echo "Account type error";
    }

    // make connection to database
    $conn = mysqli_connect(SERVERNAME, USERNAME, PASSWORD, DATABASE) or die("DATABASE ERROR: unable to validate your credentials!");

    // Check if user exists before insertion
    $checkUserQuery = "SELECT * FROM thecreatorscollective.usercredentials WHERE Email = '$email' OR Username = '$username';";
    $checkResult = mysqli_query($conn, $checkUserQuery);

    if (mysqli_num_rows($checkResult) > 0) {
      
        $loginError = "Username or email already exists";
        echo "<script>
                let feedbackDiv = document.getElementById('feedbackMessage');
                feedbackDiv.textContent = '$loginError';
                feedbackDiv.style.display = 'block';
              </script>";
    } else {
        // Insert user credentials
        $query = "INSERT INTO thecreatorscollective.usercredentials(Username, Pswd, Email, IsAgent) VALUES('$username', SHA1('$password'), '$email', '$isAgentBoolean');";
        $result = mysqli_query($conn, $query) or die("QUERY ERROR! User credentials");

        // Retrieve the last inserted UserID
        $userID = mysqli_insert_id($conn);

        // Insert based on account type
        if ($isAgentBoolean == 0) {
            $_SESSION['accountType'] = "tenant";  //set accountType
            $query2 = "INSERT INTO thecreatorscollective.tenant(Tenant_Fname, Tenant_Lname, Tenant_Phone, Tenant_email, Tenant_Gender, UserID) VALUES('$fname', '$lname', '$number','$email', '$gender', '$userID');";
            $result2 = mysqli_query($conn, $query2) or die("QUERY ERROR! User credentials");

            // Fetching data for tenant
            $query2 = "SELECT * FROM thecreatorscollective.Tenant WHERE userID =  '$userID';";
            $result2 = mysqli_query($conn, $query2) or die("QUERY ERROR: unable to retrieve tenant data!");
            $row2 = mysqli_fetch_assoc($result2);

            // Set session variables for tenant
            $_SESSION["tenantID"] = $row2['Tenant_ID'];
            $_SESSION["fName"] = $row2['Tenant_Fname'];
            $_SESSION["lName"] = $row2['Tenant_lName'];
            $_SESSION["phone"] = $row2['Tenant_Phone'];
            $_SESSION["email"] = $row2['Tenant_email'];
            $_SESSION["userID"] = $row2['userID'];
        } elseif ($isAgentBoolean == 1) {
            $_SESSION['accountType'] = "agent";  //set accountType
            $query3 = "INSERT INTO thecreatorscollective.agent(Agent_Fname, Agent_Lname, Agent_email_address, Agent_Phone, UserID) VALUES('$fname', '$lname','$email', '$number', '$userID');";
            $result3 = mysqli_query($conn, $query3) or die("QUERY ERROR! Inserting Agent");

            // Fetching data for agent
            $query3 = "SELECT * FROM thecreatorscollective.agent WHERE userID =  $userID;";
            $result3 = mysqli_query($conn, $query3) or die("QUERY ERROR: unable to retrieve agent data!");
            $row3 = mysqli_fetch_assoc($result3);

            // Set session variables for agent
            $_SESSION["agentID"] = $row3['Agent_ID'];
            $_SESSION["fName"] = $row3['Agent_Fname'];
            $_SESSION["lName"] = $row3['Agent_lName'];
            $_SESSION["phone"] = $row3['Agent_Phone'];
            $_SESSION["email"] = $row3['Agent_email_address'];
            $_SESSION["userID"] = $row3['userID'];
        }

        $loginError = "Successfully registered and welcome";
        echo "<script>
                let feedbackDiv = document.getElementById('feedbackMessage');
                feedbackDiv.textContent = '$loginError';
                feedbackDiv.style.display = 'block';
              </script>";
        header("Location:index.php");
    }
    mysqli_close($conn);
}

?>