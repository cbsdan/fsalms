<?php
    //This will check if a user is logged in
    if (!isset($_SESSION['valid'])) {
        header('Location: ../index.php');
    }
?>

<h1>Member Transactions</h1>
<hr>
<div class="member-transactions">
    <div class="search-section">
        <input class="search-input" type="text" class="search-input" placeholder="Search here">
        <select class="options select-input">
            <option value="id" name="id" class="option" selectedt>ID</option>
            <option value="name" name="name" class="option">Name</option>
        </select> 
    </div>
    <div class="transaction-table">
        <select class="options select-input">
            <option value="savings" name="savings" class="option" selected>Savings</option>
            <option value="loan" name="loan" class="option">Loan</option>
            <option value="loan-payment" name="loan-payment" class="option">Loan Payment</option>
        </select> 
        <div class="result" id="member-transactions-table">
            <table class="result-table">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Amount</th>
                        <th>Date</th> 
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
                    <tr>
                        <td>Savings</td>
                        <td>001</td>
                        <td>Juan Dela Cruz</td>
                        <td>P 500</td>
                        <td>05/11/2023</td>
                    </tr>
            </table>
        </div>
    </div>
</div>