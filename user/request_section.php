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
} else if (file_exists($database_path_index)){
    include_once($database_path_index);
}

$member_username = $_SESSION['valid'];

$sql = "SELECT mem_id FROM accounts WHERE username = '$member_username'";
$result = query($sql);
$memId = $result['mem_id'];

//GET VERIFICATION STATUS
$sql = "SELECT verification_status FROM verification_images WHERE mem_id = $memId ORDER BY verification_id DESC LIMIT 1";
$result = $conn->query($sql);

?>

<div class="background">
    <?php 
    //CHECK IF THE MEMBER IS VERIFIED OR NOT
    if ($result->num_rows > 0) {
        $verification_status = $result->fetch_assoc();
        if ($verification_status['verification_status'] == "Unverified"){
            echo "<h1 class='text-center not-verified-label' >Please wait for admin to verify your account</h1>";
            exit();
        } else if ($verification_status['verification_status'] == "Declined") {
            echo "<h1 class='text-center not-verified-label' >Your recent application has been declined! Apply again to verify your account</h1>";
            exit();
        }
    } else {
        echo "<h1 class='text-center not-verified-label' >Please Verify your account first</h1>";
        exit();
    }

    ?>
    <h1 class="request-title title">Request A Loan</h1>
    <hr>
    <div class="request-container content">
        <div class="details">
        <form action="./database/member_loan_request.php" method="POST">
            <input type='hidden' name ='date_requested' value = "<?php echo date("Y-m-d")?>">
                <div class="info">
                    <label for="loan-amount">Loan Amount: <span class="required">*</span></label>
                    <input type="number" class="no-spinner" id="loan-amount" name="amount" placeholder = "Enter Amount (₱)" required>
                </div>
                <div class="info">
                    <label for="month-duration">Month Duration: <span class="required">*</span></label>
                    <input type="number" id="month-duration" name="duration" placeholder = "Enter Month Duration" max="6" required>
                </div>
                <div class="info">
                    <label for="claim-date">Claim Date: <span class="required">*</span></label>
                    <input type="date" id="claim-date" name="claim-date" placeholder = "Enter claim date" required>
                </div>
                <button type="submit" name="request-btn" value="request-btn" >Apply</button>
            </form>
        </div>
    </div>
    <h1 class="record-title title">Record</h1>
    <hr>


    <div class="record-container content result">
    <?php

// Table display
$member_username = $_SESSION['valid'];

$sql = "SELECT mem_id FROM accounts WHERE username = '$member_username'";
$result = query($sql);
$memId = $result['mem_id'];



?>
    <table class="result-table">
        <thead>
            <tr>
            <th>ID</th>
            <th>Loan Amount</th>
            <th>Duration</th>
            <th>Interest Rate</th>
            <th>Total Loan</th>
            <th>Date Requested</th>
            <th>Status</th>
            <th>Claim</th>
            </tr>
        </thead>
    <tbody>

<?php
    $sql = "SELECT lr.request_status, ld.loan_detail_id, ld.loan_amount, ld.month_duration, ld.date_requested, ld.interest_rate, ld.claim_date, ROUND(ld.loan_amount + (ld.loan_amount * (ld.interest_rate / 100)), 2) AS total_loan, lr.is_claim
            FROM loan_requests lr
            JOIN loan_details ld ON lr.loan_detail_id = ld.loan_detail_id
            WHERE lr.mem_id  = $memId
            ORDER BY ld.loan_detail_id DESC";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['request_status'] == 'Approved' && $row['is_claim'] == TRUE) {
                $claim_status = 'Claimed';
                
            } else if ($row['request_status'] == 'Approved' && $row['is_claim'] == FALSE) {
                $claim_status = 'To claim';
                
            } else {
                $claim_status = 'Unavailable';

            }

            echo '<tr>';
            echo '<td>' . $row['loan_detail_id'] .'</td>'; 
            echo '<td>₱ ' . number_format($row['loan_amount']) . '</td>';
            echo "<td class='text-center'>" . $row['month_duration'] . " Month</td>";
            echo "<td class='text-center'>" . $row['interest_rate'] . "%</td>";
            echo "<td>₱ " . $row['total_loan'] . "</td>";
            echo '<td>' . $row['date_requested'] . '</td>';
            echo '<td class="c-' . ($row['request_status'] == 'Approved' ? 'green' : 'red') . ' text-center">' . $row['request_status'] . '</td>';
            echo "<td class='text-center'>$claim_status</td>";
            echo '</tr>';
        }
    } else {
        echo "<tr class='text-center'><td colspan='7'>No record to show</td></tr>";
    }

        ?>
        </tbody>
    </table>
    </div>
</div>
