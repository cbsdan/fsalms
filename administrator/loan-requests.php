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

$request_sql = "SELECT *, CONCAT(m.fname , ' ', m.lname) AS name FROM members m INNER JOIN loan_requests lr ON lr.mem_id = m.mem_id INNER JOIN loan_details ld ON lr.loan_detail_id = ld.loan_detail_id WHERE lr.request_status = 'Pending'";
$loan_requests = query($request_sql);

if ($loan_requests != false && (count($loan_requests) > 0)) {
    $isThereRequests = true;
} else {
    $isThereRequests = false;
}

//initialize records_sql
$records_sql = "SELECT *, CONCAT(m.fname , ' ', m.lname) AS name FROM members m INNER JOIN loan_requests lr ON lr.mem_id = m.mem_id INNER JOIN loan_details ld ON lr.loan_detail_id = ld.loan_detail_id WHERE (lr.request_status = 'Approved' OR lr.request_status = 'Declined')";

if (isset($_SESSION['status'])) {
    $status = $_SESSION['status'];
    if ($status == 1) {
        $filterStatus = 'Claimed';
    } else {
        $filterStatus = 'Unclaimed';

    }
    $_SESSION['status'] = null;
}

//If admin want to filter record whether it is claimed or unclaimed, this will be the query:
if (isset($status)) {
    $records_sql = "SELECT *, CONCAT(m.fname , ' ', m.lname) AS name FROM members m INNER JOIN loan_requests lr ON lr.mem_id = m.mem_id INNER JOIN loan_details ld ON lr.loan_detail_id = ld.loan_detail_id WHERE (lr.request_status = 'Approved' OR lr.request_status = 'Declined') AND (is_claim = $status)";
}
$records = query($records_sql);

if ($records != false && (count($records) > 0)) {
    $isThereRecords = true;
} else {
    $isThereRecords = false;
}

?>
<h1>Loan Requests</h1>
<hr>
<div class="loan-requests">
<h4>Total: <span class="value"><?php if (isset($loan_requests['request_id'])) {echo 1;} elseif (is_bool($loan_requests)) {echo 0;} else {echo count($loan_requests);}?></span></h4>
<div class="result">
    <table class="result-table">
        <thead>
            <tr>
                <th>Request ID</th>
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
            <?php
                if ($isThereRequests == true) {
                    if (isset($loan_requests['request_id'])) {
                        echo " <tr>
                            <td>" . $loan_requests['request_id'] . "</td>
                            <td>" . $loan_requests['name'] . "</td>
                            <td>" . $loan_requests['loan_amount'] . "</td>
                            <td>" . $loan_requests['month_duration'] . "</td>
                            <td>" . $loan_requests['claim_date'] . "</td>
                            <td>" . $loan_requests['date_requested'] . "</td>
                            <td class='text-center'>" . $loan_requests['request_status'] . "</td>
                            <td>
                                <form action='./database/update-loan-request.php' method='POST'>
                                    <input type='hidden' name='request_id' value='" . $loan_requests['request_id'] . "'>
                                    <button type='submit' name='approve' value='approve' class='bg-green m-auto'>Approve</button>
                                </form>
                            </td>
                            <td>
                                <form action='./database/update-loan-request.php' method='POST'>
                                    <input type='hidden' name='request_id' value='" . $loan_requests['request_id'] . "'>
                                    <button type='submit' name='decline' value='decline' class='bg-red m-auto'>Decline</button>
                                </form>
                            </tr>";

                    } else {
                        foreach($loan_requests as $loan_request) {
                            echo " <tr>
                                <td>" . $loan_request['request_id'] . "</td>
                                <td>" . $loan_request['name'] . "</td>
                                <td>" . $loan_request['loan_amount'] . "</td>
                                <td>" . $loan_request['month_duration'] . "</td>
                                <td>" . $loan_request['claim_date'] . "</td>
                                <td>" . $loan_request['date_requested'] . "</td>
                                <td class='text-center'>" . $loan_request['request_status'] . "</td>
                                <td><button class='bg-green m-auto'>Approve</button></td>
                                <td><button class='bg-red m-auto'>Decline</button></td>
                                </tr>";
                        }
                    }

                } else {
                    echo "<tr><td colspan='9' class='text-center'>No Requests</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>
</div>
<h1>Records</h1>
<hr>
<div class="container" id="loan-requests-total-select">
    <h4>Total: <span class="value"><?php if (isset($records['request_id'])) {echo 1;} elseif (is_bool($records)) {echo 0;} else {echo count($records);}?></span></h4>
    
    <form action="./database/filter-loan-requests.php" method="POST" id='statusForm'>
        <select name="filter-record" id="selectFilter">
            <option value="All" selected>All</option>
            <option value="Claimed" <?php if (isset ($filterStatus) && $filterStatus == 'Claimed') {echo "selected";}?>>Claimed</option>
            <option value="Unclaimed" <?php if (isset ($filterStatus) && $filterStatus == 'Unclaimed') {echo "selected";}?>>Unclaimed</option>
        </select>
    </form>
</div>
<div class="record result">
<table class="result-table">
        <thead>
            <tr>
                <th>Request ID</th>
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
            <?php
                if ($isThereRecords == true) {
                    
                    if (isset($records['request_id'])) { //if only one row
                        if ($records['is_claim'] == false && strtolower($records['request_status']) == 'approved') {
                            $claim_status = "
                                <form action='./database/update-loan-request.php' method='POST'>
                                    <input type='hidden' name='request_id' value='" . $records['request_id'] . "'>
                                    <button type='submit' name='claim' value='claim' class='m-auto'>Claim</button>
                                </form>";
                        } else if($records['is_claim'] == true && strtolower($records['request_status']) == 'approved') {
                            $claim_status = 'Claimed';
                        } else {
                            $claim_status = 'Unavailable';
                        }

                        if (strtolower($records['request_status']) == 'approved') {
                            $statusClass = 'c-green';
                        } else {
                            $statusClass = 'c-red';
                        }

                        echo "<tr>
                            <td>" .$records['request_id'] . "</td>
                            <td>" .$records['name'] . "</td>
                            <td>" .$records['loan_amount'] . "</td>
                            <td>" .$records['month_duration'] . "</td>
                            <td>" .$records['claim_date'] . "</td>
                            <td>" .$records['date_requested'] . "</td>
                            <td class='text-center $statusClass'>" .$records['request_status'] . "</td>
                            <td class='text-center'>$claim_status</td>
                            <td>
                                <form action='./database/update-loan-request.php' method='POST'>
                                    <input type='hidden' name='request_id' value='" . $records['request_id'] . "'>
                                    <button type='submit' name='delete' value='delete' class='bg-red m-auto'>Delete</button>
                                </form>
                            </td>
                            </tr>";
                    } else {
                        foreach($records as $record) { //if there are two or more rows)
                            if ($record['is_claim'] == false && strtolower($record['request_status']) == 'approved') {
                                $claim_status = "
                                    <form action='./database/update-loan-request.php' method='POST'>
                                        <input type='hidden' name='request_id' value='" . $record['request_id'] . "'>
                                        <button type='submit' name='claim' value='claim' class='m-auto'>Claim</button>
                                    </form>";
                            } else if($record['is_claim'] == true && strtolower($record['request_status']) == 'approved') {
                                $claim_status = 'Claimed';
                            } else {
                                $claim_status = 'Unavailable';
                            }

                            if (strtolower($record['request_status']) == 'approved') {
                                $statusClass = 'c-green';
                            } else {
                                $statusClass = 'c-red';
                            }

                            echo "<tr>
                                <td>" .$record['request_id'] . "</td>
                                <td>" .$record['name'] . "</td>
                                <td>" .$record['loan_amount'] . "</td>
                                <td>" .$record['month_duration'] . "</td>
                                <td>" .$record['claim_date'] . "</td>
                                <td>" .$record['date_requested'] . "</td>
                                <td class='text-center $statusClass'>" .$record['request_status'] . "</td>
                                <td class='text-center'>$claim_status</td>
                                <td>
                                    <form action='./database/update-loan-request.php' method='POST'>
                                        <input type='hidden' name='request_id' value='" . $record['request_id'] . "'>
                                        <button type='submit' name='delete' value='delete' class='bg-red m-auto'>Delete</button>
                                    </form>
                                </td>
                                </tr>";
                        }

                    }
                } else {
                    echo "<tr><td colspan='9' class='text-center'>No Records</td></tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<script>
    document.getElementById('selectFilter').addEventListener('change', ()=>{
        document.getElementById('statusForm').submit();

    });
</script>