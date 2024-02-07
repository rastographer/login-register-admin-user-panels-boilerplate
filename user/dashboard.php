<?php 
session_start();

if(isset($_SESSION['user_mail'])){
    //echo $_SESSION['user_mail'];
    // Include necessary files and initialize the Functions class
    include '../admin/db.php';
    include '../admin/functions.php';
    include '../admin/payment.php';
    include 'user.php';

    // Create an instance of the Functions class
    $functions = new Functions($conn);
    $user = new User($conn);

    $user_details = $user->getUser($_SESSION['user_mail']);

    $userName  = $user_details->full_name;
    $userAlias  = $user_details->username;
    $userPhone = $user_details->phone;
    $userEmail = $user_details->email;
    $userRole = $user_details->role;
    $userStatus = $user_details->status;
    $user_id = $user_details->id;

    $greeting = $user->greetingBasedOnTimezone($userName);

} else {
    $err = "Session Expired! Please reload this page and login again.";
    header('Location: index.php?err='.$err);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $functions->getSetting('site_url'); ?>assets/styles/user.css">
    <link rel="stylesheet" href="<?= $functions->getSetting('site_url'); ?>assets/styles/main.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
     
    <style>
        body {
            padding-top: 56px; /* Adjusted for fixed navbar height */
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container container-fluid px-5">
        <a class="navbar-brand" href="<?= $functions->getSetting('site_url'); ?>">
            <img src="<?= $functions->getSetting('footer_logo'); ?>" alt="Your Logo" height="40">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Menu
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">  
                        <li><a class="dropdown-item" href="dashboard.php">My Dashboard</a></li> 
                        <li><a class="dropdown-item" href="?content=my-profile">My Profile</a></li>
                        <li><a class="dropdown-item" href="../logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Main Content -->
<main class="container mt-5 p-5">

    <h4 class="mb-4"><?= $greeting; ?></h4>
    <?php 
    if (isset($_GET["content"])) {
        $content = $_GET["content"];
        include "includes/$content.php";
    } else {
        include "includes/dashboard-content.php";
    }
    ?>
</main>

<!-- Floating WhatsApp Button -->
<div class="whatsapp-button">
    <a href="<?= $functions->getSetting('whatsapp_contact'); ?>" class="wapp" target="_blank" title="Chat with us on WhatsApp">
        <img src="<?= $functions->getSetting('whatsapp_icon'); ?>" class="my_float" alt="WhatsApp Icon" height="40">
    </a>
</div>
<!-- Footer -->
<footer class="bg-dark text-white text-center p-3">
    <div class="copyright">
        &copy; <?php echo date("Y"); ?> [Name of Business]
    </div>
    <div class="terms">
        <a class="text-white" href="<?= $functions->getSetting('site_url'); ?>pages/view_page.php?id=2">Terms of Service</a>
    </div>
</footer>


<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script 
    type="text/javascript" 
    id="dashboard-js" 
    src="<?= $functions->getSetting('site_url'); ?>assets/js/dashboard.js" 
    data-user-id="<?= (isset($_SESSION['user_mail']))?$user_id:''; ?>"
></script>
</body>
</html>

