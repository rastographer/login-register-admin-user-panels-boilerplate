<!-- Footer Section -->
<footer class="mt-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="footer-logo text-center">
                    <img src="<?= $functions->getSetting('footer_logo'); ?>" alt="Logo">
                    <p><?= $functions->getSetting('footer_description'); ?></p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- Floating WhatsApp Button -->
<div class="whatsapp-button">
    <a href="<?= $functions->getSetting('whatsapp_contact'); ?>" class="wapp" target="_blank" title="Chat with us on WhatsApp">
        <img src="<?= $functions->getSetting('whatsapp_icon'); ?>" class="my_float" alt="WhatsApp Icon" height="40">
    </a>
</div>

<?php
if(isset($_SESSION['user_mail'])){
    $user = new User($conn);
    $user_details = $user->getUser($_SESSION['user_mail']);
    $user_id = $user_details->id;
}
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script 
    type="text/javascript" 
    id="dashboard-js" 
    src="<?= $functions->getSetting('site_url'); ?>assets/js/dashboard.js" 
    data-user-id="<?= (isset($_SESSION['user_mail']))?$user_id:''; ?>"
    data-base-url="<?= $functions->getSetting('site_url'); ?>"
></script>
