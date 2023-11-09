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
    include($database_path);
} else {
    include($database_path_index);
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
    $_SESSION['section'] = './administrator/administrator-edit-member.php';
    $_SESSION['activeNavId'] = 'a-editMember';
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

//For search and loading of image functions
if (file_exists('../functions/functions.php')) {
    include_once('../functions/functions.php');
}else {
    include_once('./functions/functions.php');
}

//use to identify later if there is atleast a member fetch from database 
$isThereMember = false;
?>

<h1>Edit Member</h1>
<hr>
<div class="select-member">
    <form action="./administrator/administrator-edit-member.php" method="GET">
        <div class="search-section">
            <input class="search-input" type="text" class="search-input" placeholder="Search here" name="search-value">
            <select class="options select-input" name="search-type">
                <option value="mem_id" class="option" <?php if ($searchType == 'mem_id') echo "selected"?>>ID</option>
                <option value="name" class="option" <?php if ($searchType == 'name') echo "selected"?>>Name</option>
            </select> 
            <input type="submit" class="hidden" name="search" value="search">
        </div>
    </form>
    <div class="result" id="select-member">
        <table class="result-table">
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Sex</th>
                    <th>Age</th> 
                    <th>Edit</th> 
                    <th>Delete</th> 
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
                                    <form action='' method='POST'>
                                        <input type='hidden' name='mem_id' value='$memId'>
                                        <input type='hidden' name='page' value='./administrator/edit-member.php'>
                                        <input type='hidden' name='activeNavId' value='a-editMember'>
                                        <button type='submit' class='bg-green' name='edit' value='edit'>Edit</button>
                                    </form>
                                  </td>";
                            echo "<td>
                                    <form action='' method='POST'>
                                        <input type='hidden' name='mem_id' value='$memId'>
                                        <input type='hidden' name='page' value='./administrator/edit-member.php'>
                                        <input type='hidden' name='activeNavId' value='a-editMember'>
                                        <button type='submit' class='bg-red' name='delete' value='delete'>Delete</button>
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
<div class="edit-member p-1rem <?php echo $memberInfoClass?>">
    <h3 class="title">Edit Here</h3>
    <hr>
    <form action="" method="POST">
        <div class="info">
            <label for="input-fname">Name: <span class="required">*</span></label>
            <div class="input-name-container">
                <input type="text" id="input-fname" name="fname" placeholder="First" required>
                <input type="text" id="input-lname" name="lname" placeholder="Last" required>
            </div>
        </div>
        <div class="info">
            <label for="radio-sex">Sex: <span class="required">*</span></label>
            <div class="sex-radio-container">
                <label for="radio-male" class="sex-label"><input id="radio-male" type="radio" name="sex" value="Male" required> Male</label>
                <label for="radio-female" class="sex-label"><input id="radio-female" type="radio" name="sex" value="Female" required> Female</label>
            </div>
        </div>
        <div class="info">
            <label for="input-birthdate">Birthdate: <span class="required">*</span></label>
            <input type="date" id="input-birthdate" required>
        </div>
        <div class="info">
            <label for="input-address">Address:</label>
            <input type="text" id="input-address" placeholder="Enter Address">
        </div>
        <div class="info">
            <label for="input-contact">Contact:</label>
            <input type="text" id="input-contact" placeholder="Enter Contact">
        </div>
        <div class="info">
            <label for="input-username">Username: <span class="required">*</span></label>
            <input type="text" id="input-username" name="username" placeholder="Enter username" required>
        </div>
        <div class="info">
            <label for="input-password">Password: <span class="required">*</span></label>
            <input type="text" id="input-password" name="password" placeholder="Enter password" required>
        </div>
        <div class="info">
            <label for="upload-img">Profile:</label>
            <input type="file" accept=".jpg, .jpeg, .png" name="user-profile">
        </div>
        <button id="edit-btn" type="submit" name="edit-btn" value="submit" >Apply</button>
    </form>
</div>
