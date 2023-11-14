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

?>

<div class="background">
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
            <th>Type</th>
            <th>ID</th>
            <th>Duration</th>
            <th>Claim Date</th>
            <th>Date Requested</th>
            <th>Status</th>
            <th>Claim</th>
            </tr>
        </thead>
    <tbody>

<?php
    $sql = "SELECT lr.request_status, ld.loan_amount, ld.month_duration, ld.date_requested, ld.claim_date, lr.is_claim
            FROM loan_requests lr
            JOIN loan_details ld ON lr.loan_detail_id = ld.loan_detail_id
            WHERE lr.mem_id  = $memId";

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
            echo '<td>Loan</td>'; // Replace with the actual loan type code from the database
            echo '<td>P ' . number_format($row['loan_amount']) . '</td>';
            echo '<td>' . $row['month_duration'] . ' Months</td>';
            echo '<td>' . $row['claim_date'] . '</td>';
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
