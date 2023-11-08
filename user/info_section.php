<?php
    if (!(session_status() === PHP_SESSION_ACTIVE)) {
        session_start();
        if (!isset($_SESSION['valid']) || !isset($_SESSION['user-type'])) {
            $_SESSION['message'] = "Please Login first!";
            header('Location: ../index.php');
        } 
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