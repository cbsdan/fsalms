<?php
$authentication_path = '../functions/user-authenticate.php';
$authentication_path_index = './functions/user-authenticate.php';
if (file_exists($authentication_path)) {
    include_once("$authentication_path");
} elseif (file_exists($authentication_path_index)) {
    include_once("$authentication_path_index");
}

$database_path = '../database/config.php';
$database_path_index = './database/config.php';

if (file_exists($database_path)) {
    include_once($database_path);
} else {
    include_once($database_path_index);
}

if (isset($_GET['search'])) {
    $searchValue = $_GET['search-value'];
    $searchType = $_GET['search-type'];
    if ($searchType == 'name') {
        //searchtype is name
        $sql = "SELECT members.mem_id, CONCAT(members.fname, ' ', members.lname) AS name, members.sex, TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age, accounts.profile 
                FROM members
                LEFT JOIN accounts ON members.mem_id = accounts.mem_id WHERE CONCAT(members.fname, ' ', members.lname) LIKE '%$searchValue%'";
    } else {
        //searchtype is mem_id
        $sql = "SELECT members.mem_id, CONCAT(members.fname, ' ', members.lname) AS name, members.sex, TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age, accounts.profile 
                FROM members
                LEFT JOIN accounts ON members.mem_id = accounts.mem_id WHERE members.$searchType LIKE '%$searchValue%'";
    }
    $_SESSION['section'] = './administrator/loan-pay.php';
    $_SESSION['activeNavId'] = 'l-payment';
    $_SESSION['sql_command'] = $sql;
    $_SESSION['selectedSearchType'] = $searchType;
    header('Location: ../administrator-ui.php');
    exit();
} 

//Default SQL Command
$sql = "SELECT members.mem_id, CONCAT(members.fname, ' ', members.lname) AS name, members.sex, TIMESTAMPDIFF(YEAR, birthdate, CURDATE()) AS age, accounts.profile 
        FROM members
        LEFT JOIN accounts ON members.mem_id = accounts.mem_id";
$searchType = 'name';

//Search SQL Command
if (isset($_SESSION['sql_command']) && $_SESSION['selectedSearchType']) {
    $sql = $_SESSION['sql_command'];
    $searchType = $_SESSION['selectedSearchType'];
    $_SESSION['sql_command'] = null;
    $_SESSION['selectedSearchType'] = null;
}

if (isset($_SESSION['mem_info'])) {
    $memInfo = $_SESSION['mem_info'];
    $_SESSION['mem_info'] = null;
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
                <form action="./administrator/loan-pay.php" method="GET">
                    <div class="search-section">
                        <input class="search-input" type="text" class="search-input" placeholder="Search here" name="search-value">
                        <select class="options select-input" name="search-type">
                            <option value="mem_id" class="option" <?php if ($searchType == 'mem_id') echo "selected"?>>ID</option>
                            <option value="name" class="option" <?php if ($searchType == 'name') echo "selected"?>>Name</option>
                        </select> 
                        <input type="submit" class="hidden" name="search" value="search">
                    </div>
                </form>
                <div class="result">
                    <table class="result-table">
                        <thead>
                            <tr>
                                <th>Profile</th>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Sex</th>
                                <th>Age</th> 
                                <th>Select</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $result = $conn->query($sql);
                            
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        $memId = $row['mem_id'];
                                        echo "<tr>";
                                        if (empty($row["profile"])) {
                                            echo "<td class='profile-img'><img src='./img/default-profile.png' alt='img'></td>";
                                        } else {
                                            $imgSrc = getImageSrc($row['profile']);
                                            echo "<td class='profile-img'><img src='$imgSrc' alt='img'></td>";
                                        }
                                        echo "<td>$memId</td>";
                                        echo "<td>" . $row['name']. "</td>";
                                        echo "<td>" . $row["sex"] . "</td>";
                                        echo "<td>" . $row['age']. "</td>";
                                        echo "<td>
                                                <form action='database/fetch_member_info.php' method='POST'>
                                                    <input type='hidden' name='mem_id' value='$memId'>
                                                    <input type='hidden' name='page' value='./administrator/loan-pay.php'>
                                                    <input type='hidden' name='activeNavId' value='l-payment'>
                                                    <button type='submit' name='select' value='select'>Select</button>
                                                </form>
                                            </td>";
                                        echo "</tr>";
                                    }

                                    $isThereMember = true;
                                } else {
                                    echo "<tr><td class='no-result-label text-center' colspan='5'>No members found</td></tr>";
                                    $isThereMember = false;
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
    
            </div>
            <?php
                $memberInfoClass = "hidden";
                if (isset($memInfo)) {
                    $memberInfoClass = "";
                }
            ?>
            <div class="right right-section member-information-section <?php echo $memberInfoClass?>">
                <div class="member-header">
                    <div class="title">Member Information</div>
                    <div class="content">
                        <?php
                            if (empty($memInfo["profile"])) {
                                $imgSrc = './img/default-profile.png';
                            } else {
                                $imgSrc = getImageSrc($memInfo["profile"]);
                            }
                            echo "<img class='profile' src='$imgSrc'>";
                        ?>
                        <div class="right">
                            <p class="name data"><?php echo $memInfo['name']?></p>
                            <div class="other-info">
                                <p class="data">ID: <span class="value"><?php echo $memInfo['mem_id']?></p>
                                <p>|</p>
                                <p class="data">Age: <span class="value"><?php echo $memInfo['age']?></p>
                                <p>|</p>
                                <p class="data">Sex: <span class="value"><?php echo $memInfo['sex']?></p>
                            </div>
                            <div class="other-info">
                                <p class="data"><?php if ($memInfo['contact']!=""){echo $memInfo['contact'];}else{echo 'null';} ?></p>
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
                        <p class="info"><span class="label">Username: </span><span class="value"><?php echo $memInfo['username']; ?></span></p>
                        <p class="info"><span class="label">Address: </span><span class="value"><?php if ($memInfo['address']!=""){echo $memInfo['address'];}else{echo 'null';} ?></span></p>
                        <p class="info"><span class="label">Added On: </span><span class="value"><?php echo $memInfo['date_added']; ?></span></p>
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
                    <input type="number" id="savings-amount" class="no-spinner" placeholder="<?php if(!$isThereMember || empty($memInfo['mem_id'])) {echo "Disabled";} else {echo "Enter here";}?>" name="payment-amount" <?php if(!$isThereMember || empty($memInfo['mem_id'])) echo "disabled"?>>
                    <input type="hidden" name="mem_id" value="<?php if (isset($memInfo['mem_id'])) {echo $memInfo['mem_id']; }?>">

                </div>
                <button class="submit" type="submit" name="submit" value="submit">Save</button>
            </form>
        </div>
    </div>
</div>
