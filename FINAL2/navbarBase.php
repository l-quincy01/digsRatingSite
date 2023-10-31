<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function(){
    var previousScroll = 0;
    $(window).scroll(function(){
        var currentScroll = $(this).scrollTop();
        if (currentScroll > previousScroll){
            // Down scroll
            $('nav').addClass('shrink');
        } else {
            // Up scroll
            $('nav').removeClass('shrink');
        }
        previousScroll = currentScroll;
    });
});

</script>

<?php
session_start();
// //session variables declared
// //$_SESSION['loggedIn'] = null;
// $_SESSION['accountType'] = null;


?>

  <div id="overlay" class="overlay"></div>

  <nav>
    <div class="container">
        <h2>Digsalot</h2>

        <div class="search-bar">
            <form action="index.php" method="POST">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="search" name="searchInput" placeholder="search for anything">
                <input type="submit" name="submitSearch" value="Go" placeholder="search for anything">
            </form>
        </div>

        <div class="button">
            <?php
            $accountType = isset($_SESSION['accountType']) ? $_SESSION['accountType'] : null;

            if ($accountType == "admin") {
                // Admin-specific navbar sections
                ?>
                <!-- Update Dropdown -->
                <div class="dropdown">
                    <button class="btn">Update <i class="fa fa-caret-down"></i></button>
                    <div class="dropdown-content">
                        <a href="allTenants.php" class="link"> Update Tenant</a>
                        <a href="allAgents.php" class="link"> Update Agent</a>
                        <a href="manageDigs.php" class="link"> Update Digs</a>
                    </div>
                </div>


                

                <div class="dropdown">
    <button class="btn">Delete
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="images.php">Delete Images</a>
      <a href="Rooms.php">Delete Rooms</a>
    </div>
  </div>

           <div class="dropdown">
    <button class="btn">Reports
      <i class="fa fa-caret-down"></i>
    </button>
    <div class="dropdown-content">
      <a href="#">Moderate Comments</a>
      <a href="allDigs.php">All Digs Reistered</a>
      <a href="allTenants.php">All Tenants Registered</a>
      <a href="visualPie.php">Gender Pie Chart</a>
      <a href="logout.php">Logout</a>
     
    </div>
  </div>
                <!-- Other admin dropdowns... -->
               

                <?php
            } else {
                ?>  <!-- Not admin navbar options... -->

                <?php  if ($accountType == "tenant") { ?>
                <a href="home.php" class="link"> Home</a>
                <?php  } ?>
                
                
                <a href="index.php" class="link"> View All</a>
                <a href="aboutUS.php" class="link"> About</a>
                <a href="contact.php" class="link"> Contact</a>

               

                <?php  if ($accountType == "tenant") { ?>
                    <a href="#" class="link"> View Your Ratings</a>

                <?php  } else if ($accountType == "agent") { ?>
                 <div class="dropdown">
                 <button class="btn">For Agent
                    <i class="fa fa-caret-down"></i>
                     </button>
                     <div class="dropdown-content">
                     <a href="manageYourDigs.php"> Manage Your Digs</a>
                    
                     <a href="addDigs.php"> Add a digs</a>
                    </div>
                 </div> 
                 <?php } ?>


                <div class="dropdown">
                    <button class="btn">Profile<i class="fa fa-caret-down"></i></button>
                    <div class="dropdown-content">
                        <?php if ($accountType) { ?>
                            <a href="profile.php">View Profile</a>
                        <?php } else { ?>
                            <a href="#" class="link" onclick="openLogin()">Login</a>
                        <?php } ?>

                        <?php if ($accountType) { ?>
                            <a href="logout.php">Logout</a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</nav>






<!-- Login  -->

<form method="POST" action="index.php" class="modern-login-form" id="loginForm">
    <h1>Login</h1>
    <div>
        <input type="text" placeholder="Username" name="username">
    </div>
    <div>
        <input type="password" placeholder="Password" name="password">
    </div>
    
    <input type="submit" name="loginClick" value="Login">
    <input type="button" class="btnClose" value="Close" onclick="closeLogin()">
    <div class="signup-link">
        Don't have an account?
        <br>
        <a href="#" onclick="openSignUp()">Sign up</a>
    </div>
</form>


<?php 

if (isset($_REQUEST['loginClick'])) {
    require_once("config.php");

    // Get values from form
    $username = $_REQUEST["username"];
    $password = $_REQUEST['password'];

    // Establish a connection to the database
    $conn = new mysqli(SERVERNAME, USERNAME, PASSWORD, DATABASE);

    if ($conn->connect_error) {
        die("DATABASE ERROR: " . $conn->connect_error);
    }

    // Issue query instructions
    $query = "SELECT * FROM thecreatorscollective.usercredentials WHERE Username = '$username' AND Pswd = SHA1('$password');";
    $result = $conn->query($query);

    if (!$result) {
        die("QUERY ERROR: " . $conn->error);
    }

    // Check if the user exists in the database
    if ($result->num_rows == 1) { // therefore it exists
       

        $row = $result->fetch_assoc();
        $accountTypeCheck = $row['IsAgent']; // Make sure the column name is 'IsAgent'
        $userID = $row['UserID']; // Make sure the column name is 'UserID'

        $_SESSION["userID"] = $userID; //set userID session

        if ($userID == 67) {
            //admin
          
            $_SESSION['accountType'] = "admin"; //set accountType
            header("Location:indexAdmin.php");
            exit;
        } elseif ($accountTypeCheck == 0) { // Tenant
            $_SESSION['accountType'] = "tenant";  //set accountType
            //$_SESSION['loggedIn'] = "0";
            $query2 = "SELECT * FROM thecreatorscollective.tenant WHERE userID = $userID;";
            $result2 = $conn->query($query2);

            if (!$result2) {
                die("QUERY ERROR: " . $conn->error);
            }

            $row2 = $result2->fetch_assoc();
            $_SESSION["tenantID"] = $row2['Tenant_ID'];
            $_SESSION["fName"] = $row2['Tenant_Fname'];
            $_SESSION["lName"] = $row2['Tenant_Lname'];
            $_SESSION["phone"] = $row2['Tenant_Phone'];
            $_SESSION["email"] = $row2['Tenant_email'];
            echo "<script>alert('Successfully logged in as a tenant');
            window.location.href='landing.php';</script>";
      header("Location: index.php");

        } elseif ($accountTypeCheck == 1) { // Agent
            $_SESSION['accountType'] = "agent";  //set accountType
            $query3 = "SELECT * FROM thecreatorscollective.agent WHERE UserID = $userID;";
            $result3 = $conn->query($query3);

            if (!$result3) {
                die("QUERY ERROR: " . $conn->error);
            }

            $row3 = $result3->fetch_assoc();
            
            $_SESSION["agentID"] = $row3['Agent_ID'];
            $_SESSION["fName"] = $row3['Agent_Fname'];
            $_SESSION["lName"] = $row3['Agent_Lname'];
            $_SESSION["phone"] = $row3['Agent_phone'];
            $_SESSION["email"] = $row3['Agent_email_address'];
            echo "<script>alert('Successfully logged in as a agent');
            window.location.href='landing.php';</script>";
      header("Location: index.php");
      exit;

        } else {
            echo "Account type check error";
        }

       
        exit;
    } //does not exist at ALL
    else {
        echo "<script>
        alert('Invalid username or password.');
        window.location.href='landing.php';
      </script>";
exit;
    }

    $conn->close();
}
?>

<!-- Login  -->




<!-- Sign up  -->

<form method="POST" action="index.php" class="modern-signup-form" id="signUpForm">
    <h1>Sign Up</h1>

    <div>
        <label for="fname">First Name:</label>
        <input type="text" id="fname" placeholder="Enter First Name" name="fname" required>
    </div>
    <div>
        <label for="lname">Last Name:</label>
        <input type="text" id="lname" placeholder="Enter Last Name" name="lname" required>
    </div>
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" placeholder="Enter Email" name="email" required>
    </div>
    <div>
        <label for="number">Contact Number:</label>
        <input type="tel" id="number" placeholder="Enter Contact Number" name="number" pattern="[0-9]{10}" required title="Please enter a valid 10 digit phone number">
    </div>
    <div>
        <label for="username">Username:</label>
        <input type="text" id="username" placeholder="Create Username" name="username" required>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" id="password" placeholder="Create Password" name="password" required>
    </div>
    <div>
        <label for="verifyPassword">Verify Password:</label>
        <input type="password" id="verifyPassword" placeholder="Verify Password" onkeyup="checkPasswords()" required>
    </div>
    <div>
        <label for="gender">Select gender:</label>
        <select id="gender" name="gender">
            <option value="male">male</option>
            <option value="female">female</option>
        </select>
    </div>
    <div>
        <label for="isAgent">Select Account type:</label>
        <select id="isAgent" name="isAgent">
            <option value="tenant">Tenant</option>
            <option value="agent">Agent</option>
        </select>
    </div>

    <input type="submit" name="signupClick" value="Sign Up">
    <input type="button" class="btnClose" value="Close" onclick="closeSignUp()">
</form>

<script>
    function checkPasswords() {
        const pass = document.getElementById("password");
        const verifyPass = document.getElementById("verifyPassword");
        const submitBtn = document.getElementById("signupSubmit");

        if (pass.value !== verifyPass.value) {
            verifyPass.style.backgroundColor = "red";
            submitBtn.disabled = true; // Disable the submit button

            /*alert('Invalid Passwords do not match');
        window.location.href='landing.php';*/ 
        } else {
            verifyPass.style.backgroundColor = "";  // Resetting to default color
            submitBtn.disabled = false; // Enable the submit button
        }
    }

    function validateForm() {
        const pass = document.getElementById("password");
        const verifyPass = document.getElementById("verifyPassword");

        if (pass.value !== verifyPass.value) {
            alert("Passwords do not match!");
            return false;
        }
        return true;
    }
</script>


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
       echo "<script>  alert('Username already exits');
       window.location.href='landing.php';</script>" ;//***** */
       
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
            $query2 = "SELECT * FROM thecreatorscollective.Tenant WHERE userID =  $userID;";
            $result2 = mysqli_query($conn, $query2) or die("QUERY ERROR: unable to retrieve tenant data!");
            $row2 = mysqli_fetch_assoc($result2);

            // Set session variables for tenant
            $_SESSION["tenantID"] = $row2['Tenant_ID'];
            $_SESSION["fName"] = $row2['Tenant_Fname'];
            $_SESSION["lName"] = $row2['Tenant_LName'];
            $_SESSION["phone"] = $row2['Tenant_Phone'];
            $_SESSION["email"] = $row2['Tenant_email'];
            $_SESSION["userID"] =  $userID;
            echo "<script>alert('Successfully logged in as a tenant');
            window.location.href='landing.php';</script>";
      header("Location: index.php");
      
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
            $_SESSION["lName"] = $row3['Agent_LName'];
            $_SESSION["phone"] = $row3['Agent_Phone'];
            $_SESSION["email"] = $row3['Agent_email_address'];
            $_SESSION["userID"] =  $userID;
            echo "<script>alert('Successfully logged in as a agent');
      window.location.href='landing.php';</script>";
header("Location: index.php");

            
        }



       
    }
    mysqli_close($conn);
}

?>


<script>
    /*unction redirectToLogin() {
      // Replace 'login.php' with the actual path to your login page.
      window.location.href = 'login.php';

      
    }*/
function openLogin() {
  document.getElementById("loginForm").style.display = "block";
  document.getElementById("overlay").style.display = "block";
}

function closeLogin() {
  document.getElementById("loginForm").style.display = "none";
  document.getElementById("overlay").style.display = "none";
}


function openSignUp() {
 document.getElementById("loginForm").style.display = "none";
  document.getElementById("signUpForm").style.display = "block";
  document.getElementById("overlay").style.display = "block";
}

function closeSignUp() {
  document.getElementById("signUpForm").style.display = "none";
  document.getElementById("overlay").style.display = "none";
}


    </script>


<footer>
    <!-- Your footer content goes here -->
    <p>&copy; 2023 Digsalot. All rights reserved.</p>
    
</footer>


