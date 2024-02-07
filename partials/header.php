<!-- Improved Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <div class="nav-logo">
            <a class="navbar-brand" href="<?= $functions->getSetting('site_url'); ?>"><img src="<?= $functions->getSetting('header_logo'); ?>" alt="Logo"></a>
        </div>

        <!-- Add a toggle button for small screens -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation links on the far right -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?= $functions->getSetting('site_url'); ?>">Home</a>
                </li>
                <?php if(isset($_SESSION['user_mail'])){ ?>
                <li class="nav-item">
                    <a class="btn btn-primary" href="<?= $functions->getSetting('site_url'); ?>user/dashboard.php">Dashboard</a>
                </li> 
                <?php } else {?>
                <li class="nav-item">
                    <a class="btn btn-primary" href="<?= $functions->getSetting('site_url'); ?>index.php">Join Now</a>
                </li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
