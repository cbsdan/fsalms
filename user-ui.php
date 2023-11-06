<?php
    include_once('./includes/header.php')
?>

<main id="main" class="user"> 
    <div class="info-nav-container">
        <?php
            include_once('./user/user_info-nav.php');
        ?>
    </div>
    <div class="section user">
        <?php
            include_once('./user/info_section.php');
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

    headerEl.classList.remove('admin');
    footerEl.classList.remove('admin');

    footerEl.classList.add('user');
    footerEl.classList.add('user');

    let logStatus = document.getElementById('log-status');
    logStatus.classList.remove('hidden');
</script>
