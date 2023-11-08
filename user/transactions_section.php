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
    <h1 class="transactions-title title">Transactions</h1>
    <hr>
    <div class="transactions-container content">
        <select name="transac-type" id="transac-type">
            <option value="all">All</option>
            <option value="savings">Savings</option>
            <option value="loan">Loan</option>
            <option value="loan">Loan Payment</option>
        </select>
        <div class="transactions-table content result">
            <table class="result-table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Transaction ID</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Loan Payment</td>
                        <td>001</td>
                        <td>P 100</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Loan</td>
                        <td>001</td>
                        <td>P 1,000</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>P 100</td>
                        <td>05/11/2023</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>