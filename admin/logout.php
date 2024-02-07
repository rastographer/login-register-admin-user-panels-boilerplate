<?php
// Start or resume the session
session_start();

// Destroy the session
session_unset();
session_destroy();

// Redirect to the login page
header("Location: dashboard.php");
exit;
?>
