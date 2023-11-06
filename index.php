<?php
    include_once('./includes/header.php')
?>
<?php
    require_once('./database/config.php');
?>
<main class="default">
    <?php
        try {
            $sql = "SELECT * FROM accounts WHERE isAdmin = 1";
            $result = $conn->query($sql);
            if ($result -> num_rows > 0) {
                include_once('./login/login.php');
            } else {
                include_once('./login/register.php');
            }
        } catch(Exception $e) {
            echo "<script>console.log($e)</script>";
        }
    ?>
</main>

<?php
    include_once('./includes/footer.php')
?>
