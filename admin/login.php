<?php
    // Start or resume the session
    session_start();

    include 'db.php';

    // Include the functions file
    include 'functions.php';

    // Create an instance of the Functions class
    $functions = new Functions($conn);

    // Check if the user is already logged in
    if ($_SESSION['loggedin'] === true) {
      header('Location: dashboard.php');
      exit;
    }
    
    // Check for login request
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
      // Validate and sanitize user input
      $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
      $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    
      // Check if user exists
      $admin = $functions->getAdmin($username);
    
      // Verify login credentials
      if ($admin !== null && password_verify($password, $admin->password)) {
        // Login successful
        $_SESSION['loggedin'] = true;
        
        // header('Location: dashboard.php');
        // exit;
        echo "<script>window.location.href='dashboard.php'</script>";
      } else {
        // Invalid login credentials
        $loginError = "Invalid username or password. Please try again.";
        
        // header('Location: dashboard.php?err='.$loginError);
        // exit;
        echo "<script>window.location.href='dashboard.php?err=$loginError'</script>";
      }
    }
    
?>