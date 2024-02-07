<?php
// Start or resume the session
session_start();

// Check if the user is logged in
$loggedIn = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;

// Return the session status as JSON
echo json_encode(['loggedin' => $loggedIn]);
