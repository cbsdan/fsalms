<?php
    $authentication_path = '../functions/user-authenticate.php';
    $authentication_path_index = './functions/user-authenticate.php';
    if (file_exists($authentication_path)) {
        include_once("$authentication_path");
    } elseif (file_exists($authentication_path_index)) {
        include_once("$authentication_path_index");
    }
?>

<h1>Edit Transaction</h1>
<hr>
<div class="select-transaction">
    <div class="search-section">
        <input class="search-input" type="text" class="search-input" placeholder="Search here">
        <select class="options select-input">
            <option value="id" name="id" class="option" selectedt>ID</option>
            <option value="name" name="name" class="option">Name</option>
        </select> 
    </div>
    <div class="result" id="transaction-container">
        <select class="options select-type">
            <option value="all" name="all" class="option" selected>All</option>
            <option value="savings" name="savings" class="option" selected>Savings</option>
            <option value="loan" name="loan" class="option">Loan</option>
            <option value="loan-payment" name="loan-payment" class="option">Loan Payment</option>
        </select> 
        <table class="result-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Activity</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Date</th> 
                    <th>Edit</th> 
                    <th>Delete</th> 
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>001</td>
                    <td>Savings</td>
                    <td>Juan Dela Cruz</td>
                    <td>P 100</td>
                    <td>05/11/2023</td>
                    <td><button class="bg-green m-auto">Edit</button></td> 
                    <td><button class="bg-red m-auto">Delete</button></td> 
                </tr>
                <tr>
                    <td>001</td>
                    <td>Savings</td>
                    <td>Juan Dela Cruz</td>
                    <td>P 100</td>
                    <td>05/11/2023</td>
                    <td><button class="bg-green m-auto">Edit</button></td> 
                    <td><button class="bg-red m-auto">Delete</button></td> 
                </tr>
                <tr>
                    <td>001</td>
                    <td>Savings</td>
                    <td>Juan Dela Cruz</td>
                    <td>P 100</td>
                    <td>05/11/2023</td>
                    <td><button class="bg-green m-auto">Edit</button></td> 
                    <td><button class="bg-red m-auto">Delete</button></td> 
                </tr>
                <tr>
                    <td>001</td>
                    <td>Savings</td>
                    <td>Juan Dela Cruz</td>
                    <td>P 100</td>
                    <td>05/11/2023</td>
                    <td><button class="bg-green m-auto">Edit</button></td> 
                    <td><button class="bg-red m-auto">Delete</button></td> 
                </tr>
                <tr>
                    <td>001</td>
                    <td>Savings</td>
                    <td>Juan Dela Cruz</td>
                    <td>P 100</td>
                    <td>05/11/2023</td>
                    <td><button class="bg-green m-auto">Edit</button></td> 
                    <td><button class="bg-red m-auto">Delete</button></td> 
                </tr>
                <tr>
                    <td>001</td>
                    <td>Savings</td>
                    <td>Juan Dela Cruz</td>
                    <td>P 100</td>
                    <td>05/11/2023</td>
                    <td><button class="bg-green m-auto">Edit</button></td> 
                    <td><button class="bg-red m-auto">Delete</button></td> 
                </tr>
                <tr>
                    <td>001</td>
                    <td>Savings</td>
                    <td>Juan Dela Cruz</td>
                    <td>P 100</td>
                    <td>05/11/2023</td>
                    <td><button class="bg-green m-auto">Edit</button></td> 
                    <td><button class="bg-red m-auto">Delete</button></td> 
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="edit-transaction p-1rem">
    <h3 class="title">Edit Here</h3>
    <hr>
    <form action="" method="POST">
        <div class="info">
            <label for="transaction-type">Type:</label>
            <input type="text" id="transaction-type" placeholder="Enter Type" disabled>
        </div>
        <div class="info">
            <label for="transaction-id">ID:</label>
            <input type="number" id="transaction-id" placeholder="Enter ID" disabled>
        </div>
        <div class="info">
            <label for="transaction-amount">Amount: <span class="required">*</span></label>
            <input type="number" id="transaction-amount" class="no-spinner" placeholder="Enter Amount" required>
        </div>
        <div class="info">
            <label for="transaction-timestamp">Timestamp:</label>
            <input type="date" id="transaction-timestamp" required>
        </div>
        <button id="edit-btn" type="submit" name="edit-btn" value="submit" >Apply</button>
    </form>
</div>