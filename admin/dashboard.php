<?php
    
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');
    // Start or resume the session
    session_start();
    include __DIR__ . '/db.php';

    // Include the functions file
    include __DIR__ . '/functions.php';
    include __DIR__ . '/payment.php';

    // Create an instance of the Functions class
    $functions = new Functions($conn);

    // Get the total number of rows in purchases
    $totalUsers = $functions->getNumUsers() ?? 0;    
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $functions->getSetting('site_url'); ?>assets/styles/admin.css">
</head>
<body>
<?php include __DIR__ . '/components/header.php'; ?>
<div class="container">

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="glassmorphism">
                <h2>Statistics</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text"><?= $totalUsers; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</div>

<?php include __DIR__ . '/components/footer.php'; ?>
</body>
</html>
