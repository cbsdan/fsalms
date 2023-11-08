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
    <h1 class="savings-title title">Savings</h1>
    <hr>
    <div class="savings-container content">
        <div class="details">
            <p>Total:</p>
            <p>Pending:</p>
            <p>Week No.:</p>
            <p>Weekly Payment:</p>
        </div>
    </div>

    <h1 class="loan-title title">Loan Balance</h1>
    <hr>
    <div class="loan-container content">
        <div class="details">
            <p>Total: </p>
        </div>
    </div>

    <h1 class="interest-title title">Interest Share</h1>
    <hr>
    <div class="interest-container content">
        <div class="details">
            <p>Total: </p>
        </div>
    </div>
</div>