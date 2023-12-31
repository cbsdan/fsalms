<?php
    $database_path = '../database/config.php';
    $database_path_index = './database/config.php';

    if (file_exists($database_path)) {
        include_once($database_path);
    } else {
        include_once($database_path_index);
    }

    include_once('./functions/check_msg.php');
?>

<div class="background">
    <div class="register-form">
        <h1 class="title">Register</h1>
        <hr>
        <p class="query-message <?php echo $messageClass;?>">
            <?php echo $message; ?>
        </p>
        <form action="./database/register-admin.php" method="POST">
            <div class="info">
                <label for="username">Username:</label>
                <input type="text" id="username" placeholder="Enter Username" name="username" required>
            </div>
            <div class="info">
                <label for="password">Password:</label>
                <input type="password" id="password" placeholder="Enter Password" name="password" required>
            </div>
            <div class="info">
                <label for="weekly-payment">Weekly Payment: (₱)</label>
                <input type="number" id="weekly-payment" class="no-spinner" placeholder="Enter Weekly Payment" name="weekly-payment" required>
            </div>
            <div class="info">
                <label for="membership-fee">Membership Fee: (₱)</label>
                <input type="number" id="membership-fee" class="no-spinner" placeholder="Enter Membership Fee" name="membership-fee" required>
            </div>
            <div class="info">
                <label for="start-date">Start Date:</label>
                <input type="date" id="start-date" name="start-date" required>
            </div>
            <div class="info">
                <label for="end-date">End Date:</label>
                <input type="date" id="end-date" name="end-date" required>
            </div>
            <button class="submit" type="submit" name="register" value="register">Register</button>
        </form>
    </div>

</div>
<script>
    let logStatus = document.getElementById('log-status');
    logStatus.classList.add('hidden');
    let bodyEl = document.querySelector('body');
    
    bodyEl.style.backgroundImage = "url('./img/background-img.png')";
    bodyEl.style.backgroundSize = "contain";
    
</script>