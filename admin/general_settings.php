<?php
// Include necessary files and start the session
include 'db.php';
include 'functions.php';

$functions = new Functions($conn);

// Get all global variables
$header_logo = $functions->getSetting('header_logo');
$footer_logo = $functions->getSetting('footer_logo');
$contact_phone = $functions->getSetting('contact_phone');
$contact_email = $functions->getSetting('contact_email');
$na_address = $functions->getSetting('na_address');
$eu_address = $functions->getSetting('eu_address');
$whatsapp_contact = $functions->getSetting('whatsapp_contact');
$whatsapp_icon = $functions->getSetting('whatsapp_icon');
$site_name = $functions->getSetting('site_name');
$site_url = $functions->getSetting('site_url');
$site_description = $functions->getSetting('site_description');
$footer_description = $functions->getSetting('footer_description');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize form data and update settings
    $header_logo = $functions->sanitizeInput($_POST['header_logo']);
    $footer_logo = $functions->sanitizeInput($_POST['footer_logo']);
    $contact_phone = $functions->sanitizeInput($_POST['contact_phone']);
    $contact_email = $functions->sanitizeInput($_POST['contact_email']);
    $na_address = $functions->sanitizeInput($_POST['na_address']);
    $eu_address = $functions->sanitizeInput($_POST['eu_address']);
    $whatsapp_contact = $functions->sanitizeInput($_POST['whatsapp_contact']);
    $whatsapp_icon = $functions->sanitizeInput($_POST['whatsapp_icon']);
    $site_name = $functions->sanitizeInput($_POST['site_name']);
    $site_url = $functions->sanitizeInput($_POST['site_url']);
    $site_description = $functions->sanitizeInput($_POST['site_description']);
    $footer_description = $functions->sanitizeInput($_POST['footer_description']);

    // Update settings in the database
    $functions->updateSetting('header_logo', $header_logo);
    $functions->updateSetting('footer_logo', $footer_logo);
    $functions->updateSetting('contact_phone', $contact_phone);
    $functions->updateSetting('contact_email', $contact_email);
    $functions->updateSetting('na_address', $na_address);
    $functions->updateSetting('eu_address', $eu_address);
    $functions->updateSetting('whatsapp_contact', $whatsapp_contact);
    $functions->updateSetting('whatsapp_icon', $whatsapp_icon);
    $functions->updateSetting('site_name', $site_name);
    $functions->updateSetting('site_url', $site_url);
    $functions->updateSetting('site_description', $site_description);
    $functions->updateSetting('footer_description', $footer_description);
}

?>

<!-- HTML for edit_settings.php with styling similar to dashboard.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= $functions->getSetting('site_url'); ?>assets/styles/admin.css">
</head>
<body>
    <?php include_once('components/header.php'); ?>

    <div class="container mt-5">
        <div class="glassmorphism p-4">
            <h2>Edit Settings</h2>
            <form method="post" action="" enctype="multipart/form-data">

                <!-- Header Logo -->
                <div class="mb-3">
                    <label for="header_logo" class="form-label">Header Logo</label>
                    <input type="text" class="form-control" id="header_logo" name="header_logo" value="<?= $header_logo; ?>" required>
                </div>

                <!-- Footer Logo -->
                <div class="mb-3">
                    <label for="footer_logo" class="form-label">Footer Logo</label>
                    <input type="text" class="form-control" id="footer_logo" name="footer_logo" value="<?= $footer_logo; ?>" required>
                </div>

                <!-- Contact Phone -->
                <div class="mb-3">
                    <label for="contact_phone" class="form-label">Contact Phone</label>
                    <input type="tel" class="form-control" id="contact_phone" name="contact_phone" value="<?= $contact_phone; ?>" required>
                </div>

                <!-- Contact Email -->
                <div class="mb-3">
                    <label for="contact_email" class="form-label">Contact Email</label>
                    <input type="email" class="form-control" id="contact_email" name="contact_email" value="<?= $contact_email; ?>" required>
                </div>

                <!-- NA Address -->
                <div class="mb-3">
                    <label for="na_address" class="form-label">NA Address</label>
                    <textarea class="form-control" id="na_address" name="na_address" rows="3" required><?= $na_address; ?></textarea>
                </div>

                <!-- EU Address -->
                <div class="mb-3">
                    <label for="eu_address" class="form-label">EU Address</label>
                    <textarea class="form-control" id="eu_address" name="eu_address" rows="3" required><?= $eu_address; ?></textarea>
                </div>

                <!-- WhatsApp Contact -->
                <div class="mb-3">
                    <label for="whatsapp_contact" class="form-label">WhatsApp Contact</label>
                    <input type="tel" class="form-control" id="whatsapp_contact" name="whatsapp_contact" value="<?= $whatsapp_contact; ?>" required>
                </div>

                <!-- WhatsApp Icon -->
                <div class="mb-3">
                    <label for="whatsapp_contact" class="form-label">WhatsApp Icon</label>
                    <input type="tel" class="form-control" id="whatsapp_icon" name="whatsapp_icon" value="<?= $whatsapp_icon; ?>" required>
                </div>

                <!-- Site Name -->
                <div class="mb-3">
                    <label for="site_name" class="form-label">Site Name</label>
                    <input type="text" class="form-control" id="site_name" name="site_name" value="<?= $site_name; ?>" required>
                </div>

                <!-- Site URL -->
                <div class="mb-3">
                    <label for="site_name" class="form-label">Site URL</label>
                    <input type="text" class="form-control" id="site_url" name="site_url" value="<?= $site_url; ?>" required>
                </div>

                <!-- Site Description -->
                <div class="mb-3">
                    <label for="site_description" class="form-label">Site Description</label>
                    <textarea class="form-control" id="site_description" name="site_description" rows="3" required><?= $site_description; ?></textarea>
                </div>

                <!-- Footer Description -->
                <div class="mb-3">
                    <label for="footer_description" class="form-label">Footer Description</label>
                    <textarea class="form-control" id="footer_description" name="footer_description" rows="3" required><?= $footer_description; ?></textarea>
                </div>

                <button type="submit" name="submit_settings" class="btn btn-primary">Update Settings</button>
            </form>
        </div>
    </div>

    <?php include_once('components/footer.php'); ?>
</body>
</html>
