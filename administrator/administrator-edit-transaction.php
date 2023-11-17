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
    
    //FOR SEARCH 
    if (isset($_GET['search'])) {
        $searchValue = $_GET['search-value'];
        $searchType = $_GET['search-type'];
            
    } 
    
    if (isset($_GET['searchValue']) && isset($_GET['searchType'])) {
        $searchValue = $_SESSION['searchValueTrans'] = $_GET['searchValue'];
        $searchType = $_SESSION['searchTypeTrans'] = $_GET['searchType'];
    
        $_SESSION['section'] = './administrator/administrator-edit-transaction.php';
        $_SESSION['activeNavId'] = 'a-editTransaction';
        header('Location: ../administrator-ui.php');
        exit();
    }
    
    //DEFAULT SQL COMMAND, IF ADMIN DOESN'T SEARCH AND FILTER ACTIVITY
    $sql = "SELECT * FROM (
                SELECT 'Deposits' as activity, d.deposit_id, m.mem_id, a.profile, CONCAT(m.fname, ' ', m.lname) AS name, d.deposited AS amount, d.deposit_timestamp AS date
                FROM members m 
                INNER JOIN accounts a ON a.mem_id = m.mem_id 
                INNER JOIN deposit d ON d.mem_id = a.mem_id
    
                UNION 
    
                SELECT 'Loan Payment' as activity, lp.payment_id, m.mem_id, a.profile, CONCAT(m.fname, ' ', m.lname) AS name, lp.payment_amount AS amount, lp.payment_timestamp AS date
                FROM members m 
                INNER JOIN accounts a ON a.mem_id = m.mem_id 
                INNER JOIN loan_payment lp ON lp.mem_id = m.mem_id
    
                UNION 
    
                SELECT 'Loan' as activity, ld.loan_detail_id, m.mem_id, a.profile, CONCAT(m.fname, ' ', m.lname) AS name, ld.loan_amount AS amount, ld.date_requested AS date
                FROM members m 
                INNER JOIN accounts a ON a.mem_id = m.mem_id 
                INNER JOIN loan_requests lr ON lr.mem_id = m.mem_id
                INNER JOIN loan_details ld ON ld.loan_detail_id = lr.loan_detail_id
                WHERE lr.request_status = 'Approved' AND lr.is_claim = 1
            ) AS combined_result
    
            ORDER BY date DESC;";
    
    //SQL COMMAND IF ADMIN FILTER ACTIVITY, ALL, DEPOSITS, LOAN OR LOAN PAYMENT
    if (isset($_SESSION['activity'])) {
        //if all is selected in filtering activity it will assigned null else it will assigned deposits, loan or loan payment
        $activity = $_SESSION['activity'];
        $activity = ($activity != 'all') ? $_SESSION['activity'] : null; 
    
        if ($activity != null) {
            //If admin want to filter record whether it is approved or declined, this will be the query:
            $sql = "SELECT * FROM (
                SELECT 'Deposits' as activity, d.deposit_id, m.mem_id, a.profile, CONCAT(m.fname, ' ', m.lname) AS name, d.deposited AS amount, d.deposit_timestamp AS date
                FROM members m 
                INNER JOIN accounts a ON a.mem_id = m.mem_id 
                INNER JOIN deposit d ON d.mem_id = a.mem_id
    
                UNION 
    
                SELECT 'Loan Payment' as activity, lp.payment_id, m.mem_id, a.profile, CONCAT(m.fname, ' ', m.lname) AS name, lp.payment_amount AS amount, lp.payment_timestamp AS date
                FROM members m 
                INNER JOIN accounts a ON a.mem_id = m.mem_id 
                INNER JOIN loan_payment lp ON lp.mem_id = m.mem_id
    
                UNION 
    
                SELECT 'Loan' as activity, ld.loan_detail_id, m.mem_id, a.profile, CONCAT(m.fname, ' ', m.lname) AS name, ld.loan_amount AS amount, ld.date_requested AS date
                FROM members m 
                INNER JOIN accounts a ON a.mem_id = m.mem_id 
                INNER JOIN loan_requests lr ON lr.mem_id = m.mem_id
                INNER JOIN loan_details ld ON ld.loan_detail_id = lr.loan_detail_id
                WHERE lr.request_status = 'Approved' AND lr.is_claim = 1
            ) AS combined_result
            WHERE activity = '$activity'
            ORDER BY date DESC;";
        }
    }
    
    //SQL COMMAND IF ADMIN SEARCH A MEMBER TRANSACTIONS 
    if (isset($_SESSION['searchValueTrans']) && isset($_SESSION['searchTypeTrans'])) {
        $searchValue = $_SESSION['searchValueTrans'];
        $searchType = $_SESSION['searchTypeTrans'];
    
        if ($searchValue != '') {
            //searchtype is name
            $sql = "SELECT * FROM (
                SELECT 'Deposits' as activity, d.deposit_id, m.mem_id, a.profile, CONCAT(m.fname, ' ', m.lname) AS name, d.deposited AS amount, d.deposit_timestamp AS date
                FROM members m 
                INNER JOIN accounts a ON a.mem_id = m.mem_id 
                INNER JOIN deposit d ON d.mem_id = a.mem_id
    
                UNION 
    
                SELECT 'Loan Payment' as activity, lp.payment_id, m.mem_id, a.profile, CONCAT(m.fname, ' ', m.lname) AS name, lp.payment_amount AS amount, lp.payment_timestamp AS date
                FROM members m 
                INNER JOIN accounts a ON a.mem_id = m.mem_id 
                INNER JOIN loan_payment lp ON lp.mem_id = m.mem_id
    
                UNION 
    
                SELECT 'Loan' as activity, ld.loan_detail_id, m.mem_id, a.profile, CONCAT(m.fname, ' ', m.lname) AS name, ld.loan_amount AS amount, ld.date_requested AS date
                FROM members m 
                INNER JOIN accounts a ON a.mem_id = m.mem_id 
                INNER JOIN loan_requests lr ON lr.mem_id = m.mem_id
                INNER JOIN loan_details ld ON ld.loan_detail_id = lr.loan_detail_id
                WHERE lr.request_status = 'Approved' AND lr.is_claim = 1
            ) AS combined_result
            WHERE $searchType LIKE '%$searchValue%'
            ORDER BY date DESC;";
        }
    
    } 
    
    //SQL COMMAND IF ADMIN SEARCH A MEMBER TRANSACTIONS AND ALSO FILTER ACTIVITY
    if (isset($activity) && isset($_SESSION['searchValueTrans']) && isset($_SESSION['searchTypeTrans'])) {
        $searchType = $_SESSION['searchTypeTrans'];
        $searchValue = $_SESSION['searchValueTrans'];
    
        if ($searchValue != '' && $activity != null) {
            $sql = "SELECT * FROM (
                SELECT 'Deposits' as activity, d.deposit_id, m.mem_id, a.profile, CONCAT(m.fname, ' ', m.lname) AS name, d.deposited AS amount, d.deposit_timestamp AS date
                FROM members m 
                INNER JOIN accounts a ON a.mem_id = m.mem_id 
                INNER JOIN deposit d ON d.mem_id = a.mem_id
    
                UNION 
    
                SELECT 'Loan Payment' as activity, lp.payment_id, m.mem_id, a.profile, CONCAT(m.fname, ' ', m.lname) AS name, lp.payment_amount AS amount, lp.payment_timestamp AS date
                FROM members m 
                INNER JOIN accounts a ON a.mem_id = m.mem_id 
                INNER JOIN loan_payment lp ON lp.mem_id = m.mem_id
    
                UNION 
    
                SELECT 'Loan' as activity, ld.loan_detail_id, m.mem_id, a.profile, CONCAT(m.fname, ' ', m.lname) AS name, ld.loan_amount AS amount, ld.date_requested AS date
                FROM members m 
                INNER JOIN accounts a ON a.mem_id = m.mem_id 
                INNER JOIN loan_requests lr ON lr.mem_id = m.mem_id
                INNER JOIN loan_details ld ON ld.loan_detail_id = lr.loan_detail_id
                WHERE lr.request_status = 'Approved' AND lr.is_claim = 1
            ) AS combined_result
            WHERE activity = '$activity' AND $searchType LIKE '%$searchValue%'
            ORDER BY date DESC;";
        }
    }
    
    // echo $sql;
    // exit();
    $transactions = $conn->query($sql);
?>

<h1>Edit Transaction</h1>
<hr>
<div class="select-transaction">
    <form action="./administrator/administrator-edit-transaction.php" method="GET">
        <div class="search-section">
            <input class="search-input" type="text" name='searchValue' placeholder="Search here" value='<?php echo (isset($searchValue)) ? $searchValue : ''?>'>
            <select class="options select-input" name='searchType'>
                <option value="mem_id" name="id" class="option" <?php echo (isset($searchType)) ? (($searchType == 'mem_id') ? 'selected' : '') : ''?>>ID</option>
                <option value="name" name="name" class="option" <?php echo (isset($searchType)) ? (($searchType == 'name') ? 'selected' : '') : 'selected'?>>Name</option>
            </select> 
        </div>
    </form>
    <form action="./database/filter-transactions.php" method="POST" id='filterTransaction'>
        <input type='hidden' name='activeSection' value='./administrator/administrator-edit-transaction.php'>
        <select class="options select-input" name="transaction-options" id="transaction-type">
            <option value="all" class="option" selected>All</option>
            <option value="Deposits" class="option" <?php echo (isset($activity) && $activity == 'Deposits') ? 'selected' : '' ?>>Deposits</option>
            <option value="Loan" class="option" <?php echo (isset($activity) && $activity == 'Loan') ? 'selected' : '' ?>>Loan</option>
            <option value="Loan Payment" class="option" <?php echo (isset($activity) && $activity == 'Loan Payment') ? 'selected' : '' ?>>Loan Payment</option>
        </select> 
    </form>
    <div class="result" id="transaction-container">
        <table class="result-table">
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>Type</th>
                    <th>Member ID</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Date</th> 
                    <th>Edit</th> 
                    <th>Delete</th> 
                </tr>
            </thead>
            <tbody>
                 <?php 
                    if (mysqli_num_rows($transactions) > 0) {
                        while($transaction = $transactions->fetch_assoc()) {
                            if ($transaction['profile'] != "") {
                                $profileSrc = getImageSrc($transaction['profile']);
                            } else {
                                $profileSrc = "./img/default-profile.png";
                            }

                            echo "<tr>
                                    <td><img class='m-auto' src='" . $profileSrc . "'></td>
                                    <td>" . $transaction['activity'] . "</td>
                                    <td>" . $transaction['mem_id'] . "</td>
                                    <td>" . $transaction['name'] . "</td>
                                    <td>₱" . $transaction['amount'] . "</td>
                                    <td>" . $transaction['date'] . "</td>
                                    <td><button class='bg-green m-auto'>Edit</button></td> 
                                    <td><button class='bg-red m-auto'>Delete</button></td> 
                                </tr>";
                        }
                    } else {
                        echo "<td colspan='8' class='no-result-label text-center'>No Transaction Found!</td>";
                    }
                ?>
            </tbody>
        </table>
    </div>
</div>
<div class="edit-transaction p-1rem">
    <h3 class="title">Edit Here</h3>
    <hr>
    <form action="" method="POST">
        <div class="info">
            <label for="transaction-type">Type:</label>
            <input type="text" id="transaction-type" placeholder="Enter Type" disabled>
        </div>
        <div class="info">
            <label for="transaction-id">ID:</label>
            <input type="number" id="transaction-id" placeholder="Enter ID" disabled>
        </div>
        <div class="info">
            <label for="transaction-amount">Amount: <span class="required">*</span></label>
            <input type="number" id="transaction-amount" class="no-spinner" placeholder="Enter Amount" required>
        </div>
        <div class="info">
            <label for="transaction-timestamp">Timestamp:</label>
            <input type="date" id="transaction-timestamp" required>
        </div>
        <button id="edit-btn" type="submit" name="edit-btn" value="submit" >Apply</button>
    </form>
</div>

<script>
    //select-option tag
    document.getElementById('transaction-type').addEventListener('change', ()=>{
        document.getElementById('filterTransaction').submit();

    });
</script>