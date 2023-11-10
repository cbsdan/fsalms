<?php
$authentication_path = '../functions/user-authenticate.php';
$authentication_path_index = './functions/user-authenticate.php';
if (file_exists($authentication_path)) {
    include_once("$authentication_path");
} elseif (file_exists($authentication_path_index)) {
    include_once("$authentication_path_index");
}
?>

<h1>Settings</h1>
<hr>
<div class="settings">
    <form action="./database/modify-admin.php" method="POST" enctype="multipart/form-data">
        <div class="info">
            <label for="admin-username">Admin Username:</label>
            <input type="text" id="admin-username" name="admin-username" placeholder="Enter username" required>
        </div>
        <div class="info">
            <label for="weekly-payment">Weekly Payment: (₱)<span class="required"></span></label>
            <input type="number" id="weekly-payment" class="no-spinner" name="weekly-payment" placeholder="Enter weekly payment" required>
        </div>
        <div class="info">
            <label for="membership-fee">Membership Fee: (₱)<span class="required"></span></label>
            <input type="number" id="membership-fee" class="no-spinner" name="membership-fee" placeholder="Enter weekly payment" required>
        </div>
        <div class="info">
            <label for="starting-date">Starting Date:</label>
            <input type="date" id="starting-date" name="starting-date" required>
        </div>
        <div class="info">
            <label for="ending-date">Ending Date:</label>
            <input type="date" id="ending-date" name="ending-date" required>
        </div>
        <div class="info">
            <label for="upload-img">Profile:</label>
            <input type="file" accept=".jpg, .jpeg, .png" name="admin-profile">
        </div>
        <button id="edit-btn" type="submit" name="changeSettings" value="editAdmin" >Apply</button>
    </form>
</div>

<h1 class="reset-title">Reset</h1>
<hr>
<div class="reset-container">
    <p class="description">This will reset the database, you will have to create a new admin first if you want to use the system again.</p>
    <form action="./database/modify-admin.php" method="POST">
        <button id="reset-system" class="bg-red" type="submit" name="changeSettings" value="resetDb">Reset</button>
    </form>
</div>
<h1 class="password-title">Change Password</h1>
<hr>
<div class="password-container">
    <form action="./database/modify-admin.php" method="POST">
        <div class="info">
            <label for="old_password">Old Password: <span class="required">*</span></label>
            <input id="old_password" type="text" name="old_password" placeholder="Enter Old Password">
        </div>
        <div class="info">
            <label for="new_password">New Password: <span class="required">*</span></label>
            <input id="new_password" type="text" name="new_password" placeholder="Enter New Password">
        </div>
        <div class="info">
            <label for="confirm_password">Confirm Password: <span class="required">*</span></label>
            <input id="confirm_password" type="text" name="confirm_password" placeholder="Confirm Password">
        </div>
        <button id="pw-change-btn" type="submit" name="changeSettings" value="changePw">Change Password</button>
    </form>
</div>