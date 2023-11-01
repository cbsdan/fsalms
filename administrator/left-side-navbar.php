<div class="left-side-navbar">
    <div class="navbar-container">
        <div class="admin-card" onclick="loadContent('./administrator/settings.php', this)">
            <div class="profile"><img src="./img/profile-1.png" alt="admin" id="admin-profile"></div>
            <h2>ADMINISTRATOR</h2>
        </div>
        <div class="dashboard nav-container">
            <p class="text">DASHBOARD</p>
            <div class="nav" onclick="loadContent('./administrator/dashboard-overview.php', this)">
                <div class="nav-logo"><img src="./img/default-profile.png" class="logo"></div>
                <p class="nav-name">Overview</p>
            </div>
        </div>
        <div class="members nav-container">
            <p class="text">MEMBERS</p>
            <div class="nav" onclick="loadContent('./administrator/member-information.php', this)">
                <div class="nav-logo"><img src="./img/default-profile.png" class="logo"></div>
                <p class="nav-name">Member Information</p>
            </div>
        </div>
        <div class="savings nav-container">
            <p class="text">SAVINGS</p>
            <div class="nav" onclick="loadContent('./administrator/savings-deposits.php', this)">
                <div class="nav-logo"><img src="./img/default-profile.png" class="logo"></div>
                <p class="nav-name">Deposits</p>
            </div>
            <div class="nav" onclick="loadContent('./administrator/savings-transactions.php', this)">
                <div class="nav-logo"><img src="./img/default-profile.png" class="logo"></div>
                <p class="nav-name">Transactions</p>
            </div>
        </div>
        <div class="loan nav-container">
            <p class="text">LOAN</p>
            <div class="nav" onclick="loadContent('./administrator/loan-requests.php', this)">
                <div class="nav-logo"><img src="./img/default-profile.png" class="logo"></div>
                <p class="nav-name">Loan Requests</p>
            </div>
            <div class="nav" onclick="loadContent('./administrator/loan-pay.php', this)">
                <div class="nav-logo"><img src="./img/default-profile.png" class="logo"></div>
                <p class="nav-name">Pay Loan</p>
            </div>
            <div class="nav" onclick="loadContent('./administrator/loan-make.php', this)">
                <div class="nav-logo"><img src="./img/default-profile.png" class="logo"></div>
                <p class="nav-name">Make A Loan</p>
            </div>
            <div class="nav" onclick="loadContent('./administrator/loan-transactions.php', this)">
                <div class="nav-logo"><img src="./img/default-profile.png" class="logo"></div>
                <p class="nav-name">Transactions</p>
            </div>
        </div>
        <div class="administrator nav-container">
            <p class="text">ADMINISTRATOR</p>
            <div class="nav" onclick="loadContent('./administrator/administrator-add.php', this)">
                <div class="nav-logo"><img src="./img/default-profile.png" class="logo"></div>
                <p class="nav-name">Add Member</p>
            </div>
            <div class="nav" onclick="loadContent('./administrator/administrator-update.php', this)">
                <div class="nav-logo"><img src="./img/default-profile.png" class="logo"></div>
                <p class="nav-name">Update Member</p>
            </div>
            <div class="nav" onclick="loadContent('./administrator/administrator-delete.php', this)">
                <div class="nav-logo"><img src="./img/default-profile.png" class="logo"></div>
                <p class="nav-name">Delete Member</p>
            </div>
        </div>
        <div class="settings nav" onclick="loadContent('./administrator/settings.php', this)">
            <div class="nav-logo"><img src="./img/setting-icon-light.svg" class="logo setting-logo"></div>
            <p class="nav-name">Settings</p>
        </div>
        <div class="logout nav" onclick="loadContent('./administrator/settings.php', this)">
            <div class="nav-logo"><img src="./img/logout.svg" class="logo setting-logo"></div>
            <p class="nav-name">Logout</p>
        </div>
    </div>
</div>