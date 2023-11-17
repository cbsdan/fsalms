<?php 
    //use to filter record, if all, claim or unclaim
    
    //This is on member transaction page
    if (isset($_POST['transaction-options']) && $_POST['activeSection'] != './administrator/administrator-edit-transaction.php') {
        try {
            session_start();
            $database_path = '../database/config.php';
            $database_path_index = './database/config.php';
    
            if (file_exists($database_path)) {
                include($database_path);
            } else if (file_exists($database_path_index)){
                include($database_path_index);
            }
            
            $filterRecord = $_POST['transaction-options'];  
            $_SESSION['activity'] = $filterRecord;

        } catch (Exception $e) {
            $_SESSION['message'] = "Failed to change status filter. Error: $e";
            $_SESSION['messageBg'] = 'red';
        }
        $_SESSION['section'] = './administrator/member-transactions.php';
        $_SESSION['activeNavId'] = 'm-transactions';
    } 
    
    //This is on edit transactions page
    if (isset($_POST['transaction-options']) && $_POST['activeSection'] == './administrator/administrator-edit-transaction.php') {
        try {
            session_start();
            $database_path = '../database/config.php';
            $database_path_index = './database/config.php';
    
            if (file_exists($database_path)) {
                include($database_path);
            } else if (file_exists($database_path_index)){
                include($database_path_index);
            }
            
            $filterRecord = $_POST['transaction-options'];  
            $_SESSION['activity'] = $filterRecord;

        } catch (Exception $e) {
            $_SESSION['message'] = "Failed to change status filter. Error: $e";
            $_SESSION['messageBg'] = 'red';
        }

        $_SESSION['section'] = './administrator/administrator-edit-transaction.php';
        $_SESSION['activeNavId'] = 'a-editTransaction';
    } 

    header('Location: ../administrator-ui.php');
    exit();
?>