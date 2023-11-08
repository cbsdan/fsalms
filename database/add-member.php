<?php
    if (isset($_POST['add-btn'])) {
        $database_path = '../database/config.php';
        $database_path_index = './database/config.php';

        if (file_exists($database_path)) {
            include($database_path);
        } else if (file_exists($database_path_index)){
            include($database_path_index);
        }

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $sex = $_POST['sex'];
        $birthdate = $_POST['birthdate'];
        $address = $_POST['address'];
        $contact = $_POST['contact'];
        $date_added = $_POST['date_added'];

        $username = $_POST['username'];
        $password = $_POST['password'];
        $profile = $_POST['user-profile'];

        $verify_query = $conn->query("SELECT username FROM accounts WHERE username='$username'");
        if(mysqli_num_rows($verify_query) != 0){
            $cookie_name = "message";
            $cookie_value = "There is an existing username with $username";
            $expiration = time() + (3600 * 1); // 1 hour
            $cookie_path = "/"; // accessible on the entire domain

            setcookie($cookie_name, $cookie_value, $expiration, $cookie_path);
            header('Location: ../administrator-ui.php');
            exit();
        }

        try {
            $sql = "INSERT INTO members (fname, lname, sex, birthdate, address, contact, date_added) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('sssssss', $fname, $lname, $sex, $birthdate, $address, $contact, $date_added);
            $stmt->execute();
            
            $mem_id = $stmt->insert_id;
            
            $sql = "INSERT INTO accounts (username, password, profile, mem_id) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param('ssss', $username, $password, $profile, $mem_id);
            $stmt->execute();
            
            $cookie_name = "message";
            $cookie_value = "Successfully added a new member";
            $expiration = time() + (3600 * 1); // 1 hour
            $cookie_path = "/"; // accessible on the entire domain

            setcookie($cookie_name, $cookie_value, $expiration, $cookie_path);
            header('Location: ../administrator-ui.php');
            exit();

        } catch (Exception $e) {
            $cookie_name = "message";
            $cookie_value = "Failed to add member. Error: $e";
            $expiration = time() + (3600 * 1); // 1 hour
            $cookie_path = "/"; // accessible on the entire domain

            setcookie($cookie_name, $cookie_value, $expiration, $cookie_path);
            header('Location: ../administrator-ui.php');
            exit();
        }
    }
?>