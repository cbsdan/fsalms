<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (isset($_POST['submit'])) {
    
    session_start();
    $database_path = '../database/config.php';
    $database_path_index = './database/config.php';

    if (file_exists($database_path)) {
        include($database_path);
    } else if (file_exists($database_path_index)){
        include($database_path_index);
    }
    
    if ($_POST['submit'] == 'verified') {
        $mem_id =$_POST['memId'];   

        $updateSql = "UPDATE verification_images SET verification_status = 'Verified' WHERE mem_id = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param('s', $mem_id);
        $updateStmt->execute();

        // Check for errors
        if ($updateStmt->error) {
            $_SESSION['message'] = "Error during execution: " . $updateStmt->error;
            $_SESSION['messageBg'] = 'red';
        } else {
            // Check if the update was successful
            if ($updateStmt->affected_rows > 0) {
                $_SESSION['message'] = "Verification status updated to 'Verified' successfully!";
                $_SESSION['messageBg'] = 'green';
            } else {
                $_SESSION['message'] = "No records were updated. Perhaps the 'mem_id' does not exist.e";
                $_SESSION['messageBg'] = 'red';
            }
        }

    }

    if ($_POST['submit'] == 'unverified') {
        $mem_id =$_POST['memId'];

        
        // Rest of your code...
        
        // Your code to update the verification status to "Verified" goes here
        $deleteSql = "DELETE FROM verification_images WHERE mem_id = ?";
        $deleteStmt = $conn->prepare($deleteSql);
        $deleteStmt->bind_param('s', $mem_id);
        $deleteStmt->execute();

        // Check for errors
        if ($deleteStmt->error) {
            $_SESSION['message'] = "Error during execution: " . $deleteStmt->error;
            $_SESSION['messageBg'] = 'red';
        } else {
            // Check if the delete was successful
            if ($deleteStmt->affected_rows > 0) {
                $_SESSION['message'] = "Record with mem_id $mem_id deleted successfully.";
                $_SESSION['messageBg'] = 'green';
            } else {
                $_SESSION['message'] = "No records were deleted. Perhaps the 'mem_id' does not exist.";
                $_SESSION['messageBg'] = 'red';
            }
        }
    }

    $_SESSION['activeNavId'] = 'm-verification';
    $_SESSION['section'] = './administrator/member-verification.php';
    header('Location: ../administrator-ui.php');
    exit();
}  else {
    echo "<h1>Error! You cannot access this file!</h1>";
}
