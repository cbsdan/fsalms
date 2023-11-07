<?php
    $database_path = './config.php';
    $database_path_index = './database/config.php';
    
    if (file_exists($database_path)) {
        include($database_path);
    } else {
        include($database_path_index);
    }
    
    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $isAdmin = TRUE;
        $weekly_payment = $_POST['weekly-payment'];
        $member_fee = $_POST['membership-fee'];
        $start_date = $_POST['start-date'];
        $end_date = $_POST['end-date'];

        $sql = "INSERT INTO accounts(username, password, isAdmin) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $username, $password, $isAdmin);
        $stmt->execute();

        // if ($stmt->affected_rows > 0) {
        //     $_SESSION['message'] = "Successfully added a new admin account!";
        // }

        $weekly_payment = $_POST['weekly-payment'];
        $member_fee = $_POST['membership-fee'];
        $start_date = $_POST['start-date'];
        $end_date = $_POST['end-date'];
        $sql = "INSERT INTO system_info(weekly_payment, membership_fee, start_date, end_date) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ddss", $weekly_payment, $member_fee, $start_date, $end_date);
        $stmt->execute();

        header('Location: ../index.php');

    }
?>