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
    //redirect if an user try to access administrator-ui.php
    if (!($user_type == 'admin')) {
        $_SESSION['message'] = "Admin Access Denied!";
        $_SESSION['messageBg'] = 'red';
        header('Location: ./user-ui.php');
        exit();
    }
    
     //check for messages
    include_once('./functions/check_msg.php');
    include_once('./functions/functions.php');
?>

<div id="left-side-navbar">
    <?php
        include_once('./administrator/left-side-navbar.php');
    ?>
</div>

<main id="main" class="admin"> <!--class should have admin or user-->
    <div class="section admin"> <!--class should have admin or user-->
        <p class="query-message <?php echo $messageClass;?>">
            <?php echo $message; ?>
        </p>
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
                include_once('./administrator/dashboard-overview.php');
            }
        ?> 
    </div>
</main>
<div class="screen-toggle"><img src="./img/full-screen.svg" id="screen-logo"> <span>Make Full Screen</span></div>
<a href="#main" class="scroll-top"><img src="./img/up-icon-light.svg" id="scroll-top-logo"></a>
<?php
    include_once('./includes/footer.php')
?>
<script type="module">
    import {changeActiveNav} from './scripts/functions.js';
    
    let headerEl = document.querySelector('header')
    let footerEl = document.querySelector('footer')

    headerEl.classList.remove('user');
    footerEl.classList.remove('user');

    headerEl.classList.add('admin');
    footerEl.classList.add('admin');

    let logStatus = document.getElementById('log-status');
    logStatus.classList.remove('hidden');
    
    let activeNavId = document.getElementById('activeNavId');
    if (activeNavId) {
        activeNavId = activeNavId.textContent;
        changeActiveNav(activeNavId);
    }
    
</script>