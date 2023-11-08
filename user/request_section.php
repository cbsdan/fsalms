<?php
$authentication_path = '../functions/user-authenticate.php';
$authentication_path_index = './functions/user-authenticate.php';
if (file_exists($authentication_path)) {
    include_once("$authentication_path");
} elseif (file_exists($authentication_path_index)) {
    include_once("$authentication_path_index");
}
?>
<div class="background">
    <h1 class="request-title title">Request A Loan</h1>
    <hr>
    <div class="request-container content">
        <div class="details">
            <form action="" method="POST">
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
                <button type="submit">Apply</button>
            </form>
        </div>
    </div>
    <h1 class="record-title title">Record</h1>
    <hr>
    <div class="record-container content result">
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
            <tr>
                <td>001</td>
                <td>P 2,000</td>
                <td>2 Months</td>
                <td>12/11/2023</td>
                <td>05/11/2023</td>
                <td class="c-red text-center">Declined</td>
                <td class="text-center">Unavailable</td>
            </tr>
            <tr>
                <td>001</td>
                <td>P 2,000</td>
                <td>2 Months</td>
                <td>12/11/2023</td>
                <td>05/11/2023</td>
                <td class="c-green text-center">Approved</td>
                <td class="text-center">To claim</td>
            </tr>
        </tbody>
    </table>
    </div>
</div>