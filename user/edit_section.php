<div class="background">
    <h1>Edit Account</h1>
    <hr>
    <div class="edit-container">
        <form action="" method="POST">
            <div class="info">
                <label for="input-username">Username: <span class="required">*</span></label>
                <input type="text" id="input-username" name="username" placeholder="Enter username" required>
            </div>
            <div class="info">
                <label for="input-fname">Name: <span class="required">*</span></label>
                <div class="input-name-container">
                    <input type="text" id="input-fname" name="fname" placeholder="First" required>
                    <input type="text" id="input-username" name="lname" placeholder="Last" required>
                </div>
            </div>
            <div class="info">
                <label for="radio-sex">Sex: <span class="required">*</span></label>
                <div class="sex-radio-container">
                    <label for="radio-male"><input id="radio-male" type="radio" name="sex" value="Male" required> Male</label>
                    <label for="radio-female"><input id="radio-female" type="radio" name="sex" value="Female" required> Female</label>
                </div>
            </div>
            <div class="info">
                <label for="input-birthdate">Birthdate: <span class="required">*</span></label>
                <input type="date" id="input-birthdate" required>
            </div>
            <div class="info">
                <label for="input-address">Address:</label>
                <input type="text" id="input-address" placeholder="Enter Address">
            </div>
            <div class="info">
                <label for="input-contact">Contact:</label>
                <input type="text" id="input-contact" placeholder="Enter Contact">
            </div>
            <div class="info">
                <label for="upload-img">Profile:</label>
                <input type="file" accept=".jpg, .jpeg, .png" name="user-profile">
            </div>
            <button id="edit-btn" type="submit" name="edit-btn" value="submit" >Apply</button>
        </form>
    </div>

    <h1 class="password-title">Change Password</h1>
    <hr>
    <div class="password-container">
        <form action="" method="POST">
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
            <button id="pw-change-btn" type="submit" name="pw-change-btn" value="Submit">Apply</button>
        </form>
    </div>
</div>