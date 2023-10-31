<?php

// Start or resume the session
session_start();

// Unset all of the session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the landing page
header("Location: landing.php");
exit;

?>