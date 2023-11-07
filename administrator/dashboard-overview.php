<?php
$database_path = '../database/config.php';
$database_path_index = './database/config.php';

if (file_exists($database_path)) {
    include($database_path);
} else if (file_exists($database_path_index)){
    include($database_path_index);
}

$function_path = '../functions/read_db.php';
$function_path_index = './functions/read_db.php';

if (file_exists($function_path)) {
    include($function_path);
} else if(file_exists($function_path_index)){
    include($function_path_index);
}

?>

<div id="greet-card">
    <h1>Welcome back, Admin</h1>
    <p>Your analytics are ready</p>
</div>
<h1 class="content-title">Overview</h1>
<hr>

<div class="overview">
    <div class="overview-card">
        <div class="card-header">
            <p>Members</p>
        </div>
        <div class="card-body">
            <div class="information">
                <p class="label">Male: </p>
                <p class="data">
                    <span class="detail"><?php echo $lblMaleCount; ?> </span>
                </p>
            </div>
            <div class="information">
                <p class="label">Female:</p>
                <p class="data">
                    <span class="detail"><?php echo $lblFemaleCount; ?></span>
                </p>
            </div>
            <div class="information">
                <p class="label">Total:</p>
                <p class="data">
                    <span class="detail"><?php echo  countMembers($conn); ?></span>
                </p>
            </div>
        </div>
    </div>
    <div class="overview-card">
        <div class="card-header">
            <p>Member Share</p>
        </div>
        <div class="card-body">
            <div class="information">
                <p class="label">Savings:</p>
                <p class="data">
                    <span class="detail">P <?php echo  $lblMemberSavings; ?></span>
                </p>
            </div>
            <div class="information">
                <p class="label">Interest Share:</p>
                <p class="data">
                    <span class="detail">P <?php echo  $lblMemberInterestShare; ?> </span>
                </p>
            </div>
            <div class="information">
                <p class="label">Total:</p>
                <p class="data">
                    <span class="detail">P <?php echo  $memberShare; ?></span>
                </p>
            </div>
        </div>
    </div>
    <div class="overview-card">
        <div class="card-header">
            <p>Savings</p>
        </div>
        <div class="card-body">
            <div class="information">
                <p class="label">Total Deposit: </p>
                <p class="data">
                    <span class="detail">P <?php echo getTotalSavings($conn); ?></span>
                </p>
            </div>
            <div class="information">
                <p class="label">Available Money:</p>
                <p class="data">
                    <span class="detail">P <?php echo getTotalAvailableMoney($conn); ?></span>
                </p>
            </div>
            <div class="information">
                <p class="label">Currently on Loan:</p>
                <p class="data">
                    <span class="detail">P <?php echo getTotalUnpaidLoan($conn); ?></span>
                </p>
            </div>
        </div>
    </div>
    <div class="overview-card">
        <div class="card-header">
            <p>Week</p>
        </div>
        <div class="card-body">
            <div class="information">
                <p class="label">Week No.: </p>
                <p class="data">
                    <span class="detail"> <?php echo  $lblWeekNo; ?> </span><span class="smaller"> over  <?php echo  $lblTotalWeeks; ?></span><br>
                    
                </p>
            </div>
            <div class="information">
                <p class="label">Start Date:</p>
                <p class="data">
                    <span class="detail"><?php echo  $startDate; ?></span>
                </p>
            </div>
            <div class="information">
                <p class="label">End Date:</p>
                <p class="data">
                    <span class="detail"><?php echo  $endDate; ?></span>
                </p>
            </div>
        </div>
    </div>
    <div class="overview-card">
        <div class="card-header">
            <p>Loan</p>
        </div>
        <div class="card-body">
            <div class="information">
                <p class="label">Unpaid Loan</p>
                <p class="data">
                    <span class="detail">P <?php echo  getTotalUnpaidLoan($conn); ?></span>
                </p>
            </div>
            <div class="information">
                <p class="label">Total Loan: </p>
                <p class="data">
                    <span class="detail">P  <?php echo  $lblTotalLoan; ?> </span>
                </p>
            </div>
            <div class="information">
                <p class="label">Paid Loan: </p>
                <p class="data">
                    <span class="detail">P <?php echo  $lblTotalPaidLoan; ?></span>
                </p>
            </div>
        </div>
    </div>
    <div class="overview-card">
        <div class="card-header">
            <p>Interest</p>
        </div>
        <div class="card-body">
            <div class="information">
                <p class="label">Total Interest: </p>
                <p class="data">
                    <span class="detail">P <?php echo  $interest; ?></span>
                </p>
            </div>
            <div class="information">
                <p class="label">Paid:</p>
                <p class="data">
                    <span class="detail">P <?php echo  $lblPaidInterest; ?></span>
                </p>
            </div>
            <div class="information">
                <p class="label">Pending:</p>
                <p class="data">
                    <span class="detail">P <?php echo  $lblPendingInterest; ?></span>
                </p>
            </div>
        </div>
    </div>
    <div class="overview-card">
        <div class="card-header">
            <p>Interest Share</p>
        </div>
        <div class="card-body">
            <div class="information">
                <p class="label">Collector / Manager:</p>
                <p class="data">
                    <span class="detail">P <?php echo $lblCollectorShare; ?> </span>
                    <span class="gray-text">(20%)</span>
                </p>
            </div>
            <div class="information">
                <p class="label">All Members:</p>
                <p class="data">
                    <span class="detail">P <?php echo $lblAllMemberShare; ?></span>
                    <span class="gray-text">(80%)</span>
                </p>
            </div>
        </div>
    </div>
</div>