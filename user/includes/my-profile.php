<h2>Edit Profile</h2>

    <div class="mb-5">
        <?php if(isset($_GET['err'])){ ?>
            <p class="text-danger"><?= $_GET['err']; ?></p>
        <?php } elseif (isset($_GET['msg'])) {?>
            <p class="text-success"><?= $_GET['msg']; ?></p>
        <?php } else {
            $err = NULL;
        }?>

    <form id="editProfileForm" method="POST" action="edit_profile.php">
        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" value="<?= $userName;?>">
        </div>

        <!-- Username -->
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="<?= $userAlias;?>">
        </div>
        
        <!-- Email -->
        <div class="mb-3">
            <label for="username" class="form-label">Email Address</label>
            <input type="email" class="form-control" id="email" name="email" value="<?= $userEmail;?>" disabled>
        </div>

        <!-- Phone Number -->
        <div class="mb-3">
            <label for="phoneNumber" class="form-label">WhatsApp Number</label>
            <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" value="<?= $userPhone;?>" >
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <!-- Confirm Password -->
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
        </div>

        <button type="submit" name="submit_profile_details" class="btn btn-primary w-100">Save Changes</button>
    </form>
    </div>
    