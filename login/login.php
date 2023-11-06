<div class="background">
    <div class="login-form">
        <h1 class="title">Login</h1>
        <hr>
        <form action="" method="POST">
            <div class="info">
                <label for="username">Username:</label>
                <input type="text" id="username" placeholder="Enter Username" name="username" >
            </div>
            <div class="info">
                <label for="password">Password:</label>
                <input type="password" id="password" placeholder="Enter Password" name="password" >
            </div>
            <button class="submit" type="submit" name="login" value="login">Login</button>
        </form>
    </div>

</div>
<script>
    let logStatus = document.getElementById('log-status');
    logStatus.classList.add('hidden');
    let bodyEl = document.querySelector('body');
    
    bodyEl.style.backgroundImage = "url('./img/background-img.png')";
    bodyEl.style.backgroundSize = "contain";
    
</script>