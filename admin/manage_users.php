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

    // Get the total sum of amounts
    $users = $functions->getAllUsers();  
    
    // var_dump($users);
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

    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="glassmorphism">
                <h2>All Users</h2>
                <table class="table mt-3">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">WhatsApp</th>
                            <th scope="col">Email</th>
                            <th scope="col">Status</th>
                            <th scope="col">Reg Date</th>
                            <th scope="col">Action</th>
                            <!-- Add other relevant headers as needed -->
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $counter = 1;
                        foreach ($users as $user) {
                    ?>
                                <tr>
                                    <th scope="row"><?= $counter++; ?></th>
                                    <td><?= $user->full_name; ?></td>
                                    <td><?= $user->phone; ?></td>
                                    <td><?= $user->email; ?></td>
                                    <td><?= $user->status; ?></td>
                                    <td><?= $user->created_at; ?></td>
                                    <td><button class="btn btn-primary px-2" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#userModal"
                                    data-user-email="<?= $user->email; ?>"
                                    data-user-name="<?= $user->full_name; ?>"
                                    >
                                    Send Mail</button></td>
                                    <!-- Add other relevant data as needed -->
                                </tr>
                    <?php
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- Add this modal HTML at the end of the body section -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="purchaseModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="purchaseModalLabel">Send Email To User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="clientEmailForm">
                    <div class="mb-3">
                        <label for="userEmail" class="form-label text-dark">User's Email</label>
                        <input type="text" class="form-control" id="clientEmail" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="itemDetails" class="form-label text-dark">Info (No need to introduce yourself, Just say the message)</label>
                        <textarea class="form-control" id="clientDetails" rows="4"></textarea>
                    </div>                    
                    <input type="hidden" class="form-control" id="clientFullName">
                    <button type="button" class="btn btn-primary" id="sendUserEmail">Send Email</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/components/footer.php'; ?>
</body>
</html>
