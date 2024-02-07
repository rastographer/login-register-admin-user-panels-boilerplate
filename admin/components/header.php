<!-- Blur Background Wrapper -->
<div class="blur-background" id="blurWrapper"></div>

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container">
        <a class="navbar-brand" href="<?= $functions->getSetting('site_url'); ?>admin/dashboard.php">Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Super Admin
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="<?= $functions->getSetting('site_url'); ?>" target="_blank">View Site</a></li>
                        <li><a class="dropdown-item" href="<?= $functions->getSetting('site_url'); ?>admin/dashboard.php">Dashboard</a></li>
                        <li><a class="dropdown-item" href="<?= $functions->getSetting('site_url'); ?>admin/manage_users.php">Users</a></li>
                        <li><a class="dropdown-item" href="<?= $functions->getSetting('site_url'); ?>admin/general_settings.php">Global Settings</a></li>
                        <li><a class="dropdown-item" href="<?= $functions->getSetting('site_url'); ?>admin/logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>