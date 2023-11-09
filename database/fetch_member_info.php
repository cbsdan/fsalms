<?php
        if (isset($_POST['select'])) {
            require_once('./config.php');
            session_start();
            $mem_id = $_POST['mem_id'];
            $_SESSION['section'] = $_POST['page'];
            $_SESSION['activeNavId'] = $_POST['activeNavId'];
            $_SESSION['mem_id'] = $mem_id;

            $fetchQuery = "SELECT m.mem_id, CONCAT(m.fname, ' ', m.lname) AS name, m.sex, m.address, m.contact, TIMESTAMPDIFF(YEAR, m.birthdate, CURDATE()) AS age, m.date_added, a.username, a.profile FROM members m 
                    INNER JOIN accounts a ON m.mem_id = a.mem_id
                    WHERE m.mem_id = $mem_id";
            $result = $conn->query($fetchQuery);

            if ($result && $result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $_SESSION['mem_info'] = $row;
            }
            header('Location: ../administrator-ui.php');
            exit();
        }
?>