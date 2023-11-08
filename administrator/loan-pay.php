<?php

    if (!(session_status() === PHP_SESSION_ACTIVE)) {
        session_start();
        if (!isset($_SESSION['valid']) || !isset($_SESSION['user-type'])) {
            $_SESSION['message'] = "Please Login first!";
            header('Location: ../index.php');
        } 
    }

    $database_path = '../database/config.php';
    $database_path_index = './database/config.php';

    if (file_exists($database_path)) {
        include($database_path);
    } else {
        include($database_path_index);
    }

    //use to identify later if there is atleast a member fetch from database 
    $isThereMember = false;
?>
<h1>Pay Loan</h1>
<hr>    
<div class="pay-loan">
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
                            <?php
                                $sql = "SELECT members.mem_id, CONCAT(members.fname, ' ', members.lname) AS name, members.sex, TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age, accounts.profile 
                                        FROM members
                                        LEFT JOIN accounts ON members.mem_id = accounts.mem_id";

                                $result = $conn->query($sql);
                            
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        if (empty($row["profile"])) {
                                            echo "<td class='profile-img'><img src='./img/default-profile.png' alt='img'></td>";
                                        } else {
                                            echo "<td><img src='" . $row["profile"] . "' alt='img'></td>";
                                        }
                                        echo "<td>" . $row["mem_id"] . "</td>";
                                        echo "<td>" . $row['name']. "</td>";
                                        echo "<td>" . $row["sex"] . "</td>";
                                        echo "<td>" . $row['age']. "</td>";
                                    }
                                    $isThereMember = true;
                                } else {
                                    echo "<tr><td class='no-result-label text-center' colspan='7'>No members found</td></tr>";
                                    $isThereMember = false;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
    
            </div>
            <div class="right right-section member-information-section <?php if(!$isThereMember) echo "hidden"?>">
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
        <h3 class="title">2. Enter Amount</h3>
        <div class="content">
            <form action="" method="POST">
                <div class="info">
                    <label for="savings-amount">Amount: (₱)</label>
                    <input type="number" id="savings-amount" class="no-spinner" placeholder="<?php if(!$isThereMember) {echo "Disabled";} else {echo "Enter here";}?>" name="savings-amount" <?php if(!$isThereMember) echo "disabled"?>>
                </div>
                <button class="submit" type="submit" name="submit" value="submit">Save</button>
            </form>
        </div>
    </div>
</div>