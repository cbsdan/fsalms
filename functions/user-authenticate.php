<?php
    if (!(session_status() === PHP_SESSION_ACTIVE)) {
        session_start();
        $index_path1 = './fsalms/index.php';
        $index_path2 = './index.php';
        $index_path3 = '../index.php';
        $real_path;
        if (file_exists($index_path1)) {
            $real_path = $index_path1;
        } else if (file_exists($index_path2)){
            $real_path = $index_path2;
        } else if (file_exists($index_path3)) {
            $real_path = $index_path3;
        }

        if (!isset($_SESSION['valid']) || !isset($_SESSION['user-type'])) {
            echo "ERROR : <a href='$real_path'><button>LOGIN</button></a> FIRST";
            exit();
        } 
    } else {
        if (!isset($_SESSION['valid']) || !isset($_SESSION['user-type'])) {
            echo "ERROR : <a href='$real_path'><button>LOGIN</button></a> FIRST";
            exit();
        } 
    }
?>