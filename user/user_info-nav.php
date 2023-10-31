<div class="user-info">
    <div class="profile-container">
        <img src="./img/default-profile.png" id="user-profile">
    </div>
    <div class="info-container">
        <div>
            <h3 id="user-name">Juan Dela Cruz</h3>
        </div>
        <div class="details">
            <p><span class="semibold-text">ID: </span><span>0001</span></p>
            <span>|</span>
            <p><span class="semibold-text">Age: </span><span>40</span></p>
            <span>|</span>
            <p><span class="semibold-text">Sex: </span><span>Male</span></p>
        </div>
        <div class="details">
            <p><span class="semibold-text">Created on: </span><span id="creation-date">October 31, 2023</span></p>
            
        </div>
    </div>
</div>
<div class="navigation-container">
    <div class="background">
        <a class="nav active" id="info-nav" onclick="loadContent('./user/info_section.php', this)">INFO</a>
        <a class="nav" id="request-nav" onclick="loadContent('./user/request_section.php', this)">REQUEST A LOAN</a>
        <a class="nav" id="transaction-nav" onclick="loadContent('./user/transactions_section.php', this)">TRANSACTIONS</a>
        <a class="nav" id="edit-nav" onclick="loadContent('./user/edit_section.php', this)">EDIT ACCOUNT</a>
    </div>
</div>