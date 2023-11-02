<?php
    include_once('./includes/header.php')
?>

<div id="left-side-navbar">
    <?php
        include_once('./administrator/left-side-navbar.php');
    ?>
</div>
<main id="main" class="admin"> <!--class should have admin or user-->
    <!-- <div class="info-nav-container">
        <?php
            include_once('./user/user_info-nav.php');
        ?>
    </div> -->
    <div class="section admin"> <!--class should have admin or user-->
        <!-- <?php
            include_once('./user/info_section.php');
        ?> -->
    </div>
</main>
<div class="screen-toggle"><img src="./img/full-screen.svg" id="screen-logo"> <span>Make Full Screen</span></div>
<a href="#main" class="scroll-top"><img src="./img/up-icon-light.svg" id="scroll-top-logo"></a>
<?php
    include_once('./includes/footer.php')
?>