<?php
$authentication_path = '../functions/user-authenticate.php';
$authentication_path_index = './functions/user-authenticate.php';
if (file_exists($authentication_path)) {
    include_once("$authentication_path");
} elseif (file_exists($authentication_path_index)) {
    include_once("$authentication_path_index");
}
?>
<h1>Loan Requests</h1>
<hr>
<div class="loan-requests">
<h4>Total: <span class="value">5</span></h4>
<div class="result">
    <table class="result-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Duration</th>
                <th>Claim Date</th>
                <th>Date Requested</th> 
                <th>Status</th> 
                <th>Approve</th>
                <th>Decline</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>001</td>
                <td>Juan Dela Cruz</td>
                <td>P 2,000</td>
                <td>2 Months</td>
                <td>12/11/2023</td>
                <td>05/11/2023</td>
                <td class="text-center">Pending</td>
                <td><button class="bg-green m-auto">Approve</button></td>
                <td><button class="bg-red m-auto">Decline</button></td>
            </tr>
            <tr>
                <td>001</td>
                <td>Juan Dela Cruz</td>
                <td>P 2,000</td>
                <td>2 Months</td>
                <td>12/11/2023</td>
                <td>05/11/2023</td>
                <td class="text-center">Pending</td>
                <td><button class="bg-green m-auto">Approve</button></td>
                <td><button class="bg-red m-auto">Decline</button></td>
            </tr>
            <tr>
                <td>001</td>
                <td>Juan Dela Cruz</td>
                <td>P 2,000</td>
                <td>2 Months</td>
                <td>12/11/2023</td>
                <td>05/11/2023</td>
                <td class="text-center">Pending</td>
                <td><button class="bg-green m-auto">Approve</button></td>
                <td><button class="bg-red m-auto">Decline</button></td>
            </tr>
            <tr>
                <td>001</td>
                <td>Juan Dela Cruz</td>
                <td>P 2,000</td>
                <td>2 Months</td>
                <td>12/11/2023</td>
                <td>05/11/2023</td>
                <td class="text-center">Pending</td>
                <td><button class="bg-green m-auto">Approve</button></td>
                <td><button class="bg-red m-auto">Decline</button></td>
            </tr>
            <tr>
                <td>001</td>
                <td>Juan Dela Cruz</td>
                <td>P 2,000</td>
                <td>2 Months</td>
                <td>12/11/2023</td>
                <td>05/11/2023</td>
                <td class="text-center">Pending</td>
                <td><button class="bg-green m-auto">Approve</button></td>
                <td><button class="bg-red m-auto">Decline</button></td>
            </tr>
        </tbody>
    </table>
</div>
</div>
<h1>Records</h1>
<hr>
<div class="container" id="loan-requests-total-select">
    <h4>Total: <span class="value">5</span></h4>
    <select name="claim-status">
        <option value="unclaim" selected>Unclaim</option>
        <option value="claimed" selected>Claimed</option>
    </select>
</div>
<div class="record result">
<table class="result-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Amount</th>
                <th>Duration</th>
                <th>Claim Date</th>
                <th>Date Requested</th> 
                <th>Status</th> 
                <th>Claim</th> 
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>001</td>
                <td>Juan Dela Cruz</td>
                <td>P 2,000</td>
                <td>2 Months</td>
                <td>12/11/2023</td>
                <td>05/11/2023</td>
                <td class="text-center">Declined</td>
                <td class="text-center">Unavailable</td>
                <td><button class="bg-red m-auto">Delete</button></td>
            </tr>
            <tr>
                <td>001</td>
                <td>Juan Dela Cruz</td>
                <td>P 2,000</td>
                <td>2 Months</td>
                <td>12/11/2023</td>
                <td>05/11/2023</td>
                <td class="c-green text-center">Approved</td>
                <td><button class="m-auto">Claim</button></td>
                <td><button class="bg-red m-auto">Delete</button></td>
            </tr>
            <tr>
                <td>001</td>
                <td>Juan Dela Cruz</td>
                <td>P 2,000</td>
                <td>2 Months</td>
                <td>12/11/2023</td>
                <td>05/11/2023</td>
                <td class="c-green text-center">Approved</td>
                <td class="text-center">Claimed</td>
                <td><button class="bg-red m-auto">Delete</button></td>
            </tr>
            <tr>
                <td>001</td>
                <td>Juan Dela Cruz</td>
                <td>P 2,000</td>
                <td>2 Months</td>
                <td>12/11/2023</td>
                <td>05/11/2023</td>
                <td class="c-red text-center">Declined</td>
                <td class="text-center">Unavailable</td>
                <td><button class="bg-red m-auto">Delete</button></td>
            </tr>
            <tr>
                <td>001</td>
                <td>Juan Dela Cruz</td>
                <td>P 2,000</td>
                <td>2 Months</td>
                <td>12/11/2023</td>
                <td>05/11/2023</td>
                <td class="c-green text-center">Approved</td>
                <td><button class="m-auto">Claim</button></td>
                <td><button class="bg-red m-auto">Delete</button></td>
            </tr>
        </tbody>
    </table>
</div>
