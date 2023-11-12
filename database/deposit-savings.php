<?php
    if (isset($_POST['submit'])) {
        session_start(); //must include 
        $database_path = '../database/config.php';
        $database_path_index = './database/config.php';

        if (file_exists($database_path)) {
            include_once($database_path);
        } else if (file_exists($database_path_index)){
            include_once($database_path_index);
        }
        
        try {
            $mem_id = $_POST['mem_id']; 
            $deposit = $_POST['deposits-amount'];
            
            $sql = "INSERT INTO deposit(deposited, mem_id) VALUES($deposit, $mem_id)";
            query($sql);

            $_SESSION['message'] = "Successfully deposit savings!";
            $_SESSION['messageBg'] = 'green';

        } catch (Exception $e) {
            $_SESSION['message'] = "Failed to deposit savings. Error : $e";
            $_SESSION['messageBg'] = 'red';
        }
        $_SESSION['section'] = './administrator/savings-deposits.php';
        $_SESSION['activeNavId'] = 's-deposits';
        header('Location: ../administrator-ui.php');
        exit();
    }
?>