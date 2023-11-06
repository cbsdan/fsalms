<?php
    include_once('./includes/header.php')
?>

<div id="left-side-navbar">
    <?php
        include_once('./administrator/left-side-navbar.php');
    ?>
</div>

<main id="main" class="admin"> <!--class should have admin or user-->
    <div class="section admin"> <!--class should have admin or user-->
        <?php
            include_once('./administrator/dashboard-overview.php');
        ?> 
    </div>
</main>
<div class="screen-toggle"><img src="./img/full-screen.svg" id="screen-logo"> <span>Make Full Screen</span></div>
<a href="#main" class="scroll-top"><img src="./img/up-icon-light.svg" id="scroll-top-logo"></a>
<?php
    include_once('./includes/footer.php')
?>
<script>
    let headerEl = document.querySelector('header')
    let footerEl = document.querySelector('footer')

    headerEl.classList.remove('user');
    footerEl.classList.remove('user');

    headerEl.classList.add('admin');
    footerEl.classList.add('admin');

    let logStatus = document.getElementById('log-status');
    logStatus.classList.remove('hidden');
</script>