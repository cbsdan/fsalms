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


$function_path= '../functions/read_db.php';
$function_path_index= './functions/read_db.php';
if (file_exists($function_path)) {
    include_once($function_path);
} elseif (file_exists($function_path_index)) {
    include_once($function_path_index);
}

?>

<?php
$member_username = $_SESSION['valid'];

$sql = "SELECT mem_id FROM accounts WHERE username = '$member_username'";
$result = query($sql);
$memId = $result['mem_id'];

$total_deposits = getTotalDeposits($conn, $memId);
$week_number = getWeekNumber($conn);
$weekly_payment = getWeeklyPayment($conn) ;
$pending_amount= computePendingAmount($conn, $weekly_payment, $week_number, $total_deposits);

$total_loan_balance= getTotalLoanBalance($conn, $memId);
$interest_share= $memberInterestShare;

?>


<div class="background">
    <h1 class="savings-title title">Savings</h1>
    <hr>
    <div class="savings-container content">
        <div class="details"> 

            <p>Total: <span class="value"><?php echo $total_deposits ; ?></p>
            <p>Pending: <span class="value"><?php echo $pending_amount; ?></p>
            <p>Week No.: <span class="value"><?php echo $week_number ; ?></p>
            <p>Weekly Payment: <span class="value"><?php echo  $weekly_payment; ?></p>
        </div>
    </div>

    <h1 class="loan-title title">Loan Balance</h1>
    <hr>
    <div class="loan-container content">
        <div class="details">
            <p>Total: <span class="value"><?php echo  $total_loan_balance; ?></p>
        </div>
    </div>

    <h1 class="interest-title title">Interest Share</h1>
    <hr>
    <div class="interest-container content">
        <div class="details">
            <p>Total: <span class="value"><?php echo  $interest_share; ?></p>
        </div>
    </div>
</div>