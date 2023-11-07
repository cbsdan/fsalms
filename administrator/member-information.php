<?php
$database_path = '../database/config.php';
$database_path_index = './database/config.php';

if (file_exists($database_path)) {
    include($database_path);
} else {
    include($database_path_index);
}

?>

<?php 
function calculateAge($birthday) { 
$dob = new DateTime($birthday); 
$currentDate = new DateTime('now'); 
$age = $currentDate->diff($dob)->y; 
return $age; 
}

// SQL Query:
$sql = "SELECT mem_id, birthdate FROM members";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $member_id = $row["mem_id"];
        $birthdayFromDatabase = $row["birthdate"];
        $age = calculateAge($birthdayFromDatabase);
}
} else {
    echo "No results found";
}

// Name SQL Query:

function mergeName($first_name, $last_name) {
    return $first_name . ' ' . $last_name;
}

$sql = "SELECT fname, lname FROM members";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $merged_name = mergeName($row["fname"], $row["lname"]);
    }
} else {
    echo "No results found";
}

?>


<h1>Member Information</h1>
<hr>
<div class="member-information">
    <div class="left-section section">
        <div class="search-section">
            <input class="search-input" type="text" class="search-input" placeholder="Search here">
            <select class="options select-input">
                <option value="id" name="id" class="option" select>ID</option>
                <option value="name" name="name" class="option" select>Name</option>
            </select> 
        </div>
        <div class="result" id="member-information-table">
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
                $sql = "SELECT members.mem_id, members.sex, accounts.profile 
                FROM members
                LEFT JOIN accounts ON members.mem_id = accounts.mem_id"; // Adjust the JOIN condition as per your database schema

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
                        echo "<td>" . $merged_name. "</td>";
                        echo "<td>" . $row["sex"] . "</td>";
                        echo "<td>" . $age. "</td>";
                        echo "</tr>";

                    }
            } else {
                echo "<br>";
                echo "No results found";
            }

            ?>
            </tbody>
            </table>
        </div>
    </div>
</div>


    <div class="right-section section member-information-section">
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