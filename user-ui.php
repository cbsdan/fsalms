<?php
    include_once('./includes/header.php');
    $authentication_path = '../functions/user-authenticate.php';
    $authentication_path_index = './functions/user-authenticate.php';
    if (file_exists($authentication_path)) {
        include_once("$authentication_path");
    } elseif (file_exists($authentication_path_index)) {
        include_once("$authentication_path_index");
    }
    
    $user_type = $_SESSION['user-type'];
    //redirect if an admin try to access user-ui.php
    if (!($user_type == 'member')) {
        $_SESSION['message'] = "You cannot access this file!";
        $_SESSION['messageBg'] = 'red';
        header('Location: ./administrator-ui.php');
        exit();
    }

    //check for messages
    include_once('./functions/check_msg.php');
?>

<main id="main" class="user"> 
    <div class="info-nav-container">
        <p class="query-message <?php echo $messageClass;?>">
            <span class='message'><?php echo $message; ?></span>
        </p>
        <?php
            include_once('./user/user_info-nav.php');
        ?>
    </div>
    <div class="section user">
        <?php
            if (isset($_SESSION['section'])) {
                $section = $_SESSION['section'];
                $activeNavId = $_SESSION['activeNavId'];
                $_SESSION['section'] = null;
                $_SESSION['activeNavId'] = null;
                include_once("$section");
                //will be use in javascript to change the default nav to active nav
                echo "<span id='activeNavId' class='hidden'>$activeNavId</span>";
            } else {
                include_once('./user/info_section.php');
            }
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

    let activeNavId = document.getElementById('activeNavId');
    if (activeNavId) {
        activeNavId = activeNavId.textContent;
        changeActiveNav(activeNavId);
    }
</script>
