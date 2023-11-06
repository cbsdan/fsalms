<h1>Make A Loan</h1>
<hr>
<div class="make-loan">
<div class="section first">
    <h3 class="title">1. Select a Member</h3>
    <div class="inner-section">
        <div class="left left-section">
            <div class="search-section">
                <input class="search-input" type="text" class="search-input" placeholder="Search here">
                <select class="options select-input">
                    <option value="id" name="id" class="option" select>ID</option>
                    <option value="name" name="name" class="option" select>Name</option>
                </select> 
            </div>
            <div class="result">
                <table class="result-table">
                    <thead>
                        <tr>
                            <th>Profile</th>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Sex</th>
                            <th>Age</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="selected">
                            <td class="profile-img"><img src="./img/profile-1.png" alt="img"></td>
                            <td>001</td>
                            <td>Juan Dela Cruz</td>
                            <td>Male</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td class="profile-img"><img src="./img/default-profile.png" alt="img"></td>
                            <td>001</td>
                            <td>Juan Dela Cruz</td>
                            <td>Male</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td class="profile-img"><img src="./img/default-profile.png" alt="img"></td>
                            <td>001</td>
                            <td>Juan Dela Cruz</td>
                            <td>Male</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td class="profile-img"><img src="./img/default-profile.png" alt="img"></td>
                            <td>001</td>
                            <td>Juan Dela Cruz</td>
                            <td>Male</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td class="profile-img"><img src="./img/default-profile.png" alt="img"></td>
                            <td>001</td>
                            <td>Juan Dela Cruz</td>
                            <td>Male</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td class="profile-img"><img src="./img/default-profile.png" alt="img"></td>
                            <td>001</td>
                            <td>Juan Dela Cruz</td>
                            <td>Male</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td class="profile-img"><img src="./img/default-profile.png" alt="img"></td>
                            <td>001</td>
                            <td>Juan Dela Cruz</td>
                            <td>Male</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td class="profile-img"><img src="./img/default-profile.png" alt="img"></td>
                            <td>001</td>
                            <td>Juan Dela Cruz</td>
                            <td>Male</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td class="profile-img"><img src="./img/default-profile.png" alt="img"></td>
                            <td>001</td>
                            <td>Juan Dela Cruz</td>
                            <td>Male</td>
                            <td>40</td>
                        </tr>
                        <tr>
                            <td class="profile-img"><img src="./img/default-profile.png" alt="img"></td>
                            <td>001</td>
                            <td>Juan Dela Cruz</td>
                            <td>Male</td>
                            <td>40</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>
        <div class="right right-section member-information-section">
            <div class="member-header">
                <div class="title">Member Information</div>
                <div class="content">
                    <div class="left">
                        <img class="profile" src="./img/profile-1.png">
                    </div>
                    <div class="right">
                        <p class="name data">Juan Dela Cruz</p>
                        <div class="other-info">
                            <p class="data">ID:<span class="value">001</p>
                            <p>|</p>
                            <p class="data">Age:<span class="value">40</p>
                            <p>|</p>
                            <p class="data">Sex:<span class="value">Male</p>
                        </div>
                        <div class="other-info">
                            <p class="data">09987123654</p>
                        </div>
                        
                    </div>
                </div>
            </div>
            <div class="member-body">
                <hr>
                <div class="info">
                    <p class="label">Total Savings: </p>
                    <p class="data">
                        <span class="detail">P 0</span>
                    </p>
                </div>
                <div class="info">
                    <p class="label">Loan Balance: </p>
                    <p class="data">
                        <span class="detail">P 0</span>
                    </p>
                </div>
                <div class="info">
                    <p class="label">Interest Share: </p>
                    <p class="data">
                        <span class="detail">P 0</span>
                    </p>
                </div>
            </div>
            <div class="member-footer">
                <div class="title">Other Info</div>
                <hr>
                <div class="content">
                    <p class="info"><span class="label">Username: </span><span class="value">juandelacruz</span></p>
                    <p class="info"><span class="label">Address: </span><span class="value">Taguig City</span></p>
                    <p class="info"><span class="label">Added On: </span><span class="value">Jan. 01, 2023</span></p>
                </div>
            </div>
        </div>

    </div>
</div>
<div class="section second">
        <h3 class="title">2. Enter Loan Details</h3>
        <div class="content bg-light-main loan-details">
            <form action="" method="POST">
                <div class="info">
                    <label for="loan-amount">Loan Amount: (₱) <span class="required">*</span></label>
                    <input type="number" id="loan-amount" class="no-spinner" placeholder="Enter Amount" name="loan-amount">
                </div>
                <div class="info">
                    <label for="month-duration">Month Duration: <span class="required">*</span></label>
                    <input type="number" id="month-duration" placeholder="Enter duration" name="month-duration" max = 6>
                </div>
                <div class="info">
                    <label for="date-requested">Date Requested: <span class="required">*</span></label>
                    <input type="date" id="date-requested" name="date-requested">
                </div>
                <div class="info">
                    <label for="interest-rate">Interest Rate: (%)</label>
                    <input type="number" id="interest-rate" placeholder="Enter interest rate" name="interest-rate">
                </div>
                <div class="info">
                    <label for="loan-interests">Interest: (₱)</label>
                    <input type="text" id="loan-interests" placeholder="(Calculated)" name="loan-interests" disabled>
                </div>
                <div class="info">
                    <label for="total-loan">Total Loan: (₱)</label>
                    <input type="text" id="total-loan" placeholder="(Calculated)" name="total-loan" disabled>
                </div>
                <div class="info">
                    <label for="weekly-payment">Weekly Payment: (₱)</label>
                    <input type="text" id="weekly-payment" placeholder="(Calculated)" name="weekly-payment" disabled>
                </div>
                <button class="submit" type="submit" name="submit" value="submit">Save</button>
            </form>
        </div>
</div>