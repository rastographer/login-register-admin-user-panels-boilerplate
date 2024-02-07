<!-- Login Modal -->
<div class="modal" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-dark" id="loginModalLabel">Admin Login</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add your login form here -->
                <form method="post" action="<?= $functions->getSetting('site_url'); ?>admin/login.php">
                    <?php if(!empty($_GET['err'])){ ?>
                    <div class="mb-3 text-danger">
                        <?php echo $_GET['err']; ?>
                    </div>
                    <?php } ?>
                    <div class="mb-3">
                        <label for="username" class="form-label text-dark">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label text-dark">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password">
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies (place at the end of the body for faster page loading) -->
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script
  src="https://code.jquery.com/jquery-3.7.1.min.js"
  integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
  crossorigin="anonymous"></script>
<script>

        var base_url = '<?= $functions->getSetting('site_url'); ?>';
        window.onload = function () {
            // Check session status and display login modal if needed
            checkSessionStatus();
        };

        function checkSessionStatus() {
            // Make an AJAX request to check the session status on the server
            var xhr = new XMLHttpRequest();
            xhr.open('GET', base_url + 'admin/check_session.php', true);

            xhr.onload = function () {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);

                    if (!response.loggedin) {
                        // Display the login modal and blur background
                        document.getElementById("loginModal").style.display = "block";
                        document.getElementById("blurWrapper").style.display = "block";
                        document.body.style.overflow = "hidden"; // Disable scrolling
                    } else {
                        // If login is successful, close the modal and remove the blur effect
                        document.getElementById("loginModal").style.display = "none";
                        document.getElementById("blurWrapper").style.display = "none";
                        document.body.style.overflow = "auto"; // Enable scrolling again
                    }
                }
            };

            xhr.send();
        }

        var sessionTimeout = 300 * 60 * 1000; // 30 minutes in milliseconds

        function startLogoutTimer() {
            setInterval(checkSessionStatus, sessionTimeout);
        }

        // Start the logout timer
        startLogoutTimer();

        // Event listener for user activity
        document.addEventListener('mousemove', function () {
            // Reset the timer on user activity
            startLogoutTimer();
        });
        document.addEventListener('keypress', function () {
            // Reset the timer on user activity
            startLogoutTimer();
        });

        $(document).ready(function() {
            
            $('#userModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var clientEmail = button.data('user-email');
                var clientFullName = button.data('user-name');

                document.getElementById('clientEmail').value = clientEmail;
                document.getElementById('clientFullName').value = clientFullName;
            });
            
            $('#sendUserEmail').click(function() {
                sendUserEmail();
            });
            
            function sendUserEmail() {
                var clientEmail = document.getElementById('clientEmail').value;
                var clientDetails = document.getElementById('clientDetails').value;
                var clientFullName = document.getElementById('clientFullName').value;

                console.log(clientFullName);

                // Basic validation
                if (!clientEmail) {
                alert('Please enter the user\'s email address.');
                return;
                }

                $.ajax({
                type: 'POST',
                url: 'send_purchase_email.php',
                data: { 
                    clientEmail: clientEmail, 
                    clientDetails: clientDetails,
                    clientFullName: clientFullName
                },
                success: function(response) {
                    alert('Email sent successfully!');
                    console.log(response);
                    $('#clientEmailForm')[0].reset(); // Clear form fields
                    $('#userModal').modal('hide');
                },
                error: function(error) {
                    console.error('Error sending email:', error);
                    alert('An error occurred while sending the email. Please try again later.');
                }
                });
            }
        });

    </script>