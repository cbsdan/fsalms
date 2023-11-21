<!--Week PANEL-->
<!-- Panels -->

<?php
function executeQuery($conn, $query) {
    // Attempt to execute the query
    $result = $conn->query($query);

    if ($result === TRUE) {
        // If query executed successfully
        return true;
    } elseif ($result->num_rows > 0) {
        // If the query fetched data (for SELECT queries)
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    } else {
        // If there was an error or no results found
        return array("error" => $conn->error);
    }
}


function commandScalar($sql) {
    global $conn;
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return $row['interest_rate']; // Replace 'column_name' with the appropriate column name from your query result
    } else {
        return null;
    }
}
?>

<!-- MEMBERS PANEL-->
<?php
//member's panel
function countMembers($conn) {
    $totalMembers = 0;

    try {
        $query = "SELECT COUNT(*) as total_members FROM members";
        $result = $conn->query($query);

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $totalMembers = (int) $row['total_members'];
        }

    } catch (Exception $ex) {
        // Handle exceptions if needed
        echo "Error: " . $ex->getMessage();
    }
    return $totalMembers;
}

//Get male count
$queryMaleCount = "SELECT COUNT(mem_id) AS male_count FROM members WHERE sex = 'Male'";
$resultMaleCount = $conn->query($queryMaleCount);

if ($resultMaleCount && $resultMaleCount->num_rows > 0) {
    $rowMaleCount = $resultMaleCount->fetch_assoc();
    $maleCount = $rowMaleCount['male_count'];
    $lblMaleCount = (int) $maleCount;
} else {
    $lblMaleCount = 0;
}

// Get female count
$queryFemaleCount = "SELECT COUNT(mem_id) AS female_count FROM members WHERE sex = 'Female'";
$resultFemaleCount = $conn->query($queryFemaleCount);

if ($resultFemaleCount && $resultFemaleCount->num_rows > 0) {
    $rowFemaleCount = $resultFemaleCount->fetch_assoc();
    $femaleCount = $rowFemaleCount['female_count'];
    $lblFemaleCount = (int) $femaleCount;
} else {
    $lblFemaleCount = 0;
}
?>

<!--INTEREST SHARE PANEL-->

<?php
//function members
function getTotalInterest($conn) {
    $total_interest = 0;

    try {
        $sql = "SELECT SUM(loan_amount * (interest_rate / 100)) AS total_interest FROM loan_details";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $total_interest = (float)$row["total_interest"]; // Convert the result to float
        }
    } catch (Exception $ex) {
        // Handle exceptions
    }

    return $total_interest;
}


$interest = getTotalInterest($conn);
$lblCollectorShare = number_format($interest * 0.2, 2); // 20% of total interest
$lblAllMemberShare = number_format($interest * 0.8, 2); // 80% of total interest
?>


<!-- LOAN PANEL-->

<?php
function getTotalLoan($conn) {
    $totalLoan = 0;

    try {
        // Get total loan amount with interest from the loan table
        $queryTotalLoan = "SELECT SUM(loan_amount + (loan_amount * (interest_rate / 100))) AS total_loan FROM loan_details";
        $resultTotalLoan = $conn->query($queryTotalLoan);

        if ($resultTotalLoan && $resultTotalLoan->num_rows > 0) {
            $rowTotalLoan = $resultTotalLoan->fetch_assoc();
            $totalLoan = (float) $rowTotalLoan['total_loan'];
        }

    } catch (Exception $ex) {
        // Handle exceptions if needed
        echo "Error: " . $ex->getMessage();
    }

    return number_format($totalLoan, 2);
}
function getTotalUnpaidLoan($conn) {
    $totalUnpaidLoan = 0;

    try {
        $sql = "SELECT SUM(payment_amount) as total_amount FROM loan_payment";
        $result = $conn->query($sql);

        if ($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Check if the value is numeric before subtraction
            if (is_numeric($row["total_amount"])) {
                $totalLoan = is_numeric(getTotalLoan($conn));
                $totalUnpaidLoan = (float)$row["total_amount"] - $totalLoan;
            } else {
                // Handle the case where the value is not numeric
                // For example, set $totalUnpaidLoan to a default value or show an error message
                $totalUnpaidLoan = 0;
                
                // // Debug information
                // echo "Non-numeric value encountered: " . $row["total_amount"];
            }
        } else {
            $totalUnpaidLoan = 0;
        }
    } catch (Exception $ex) {
        echo $ex->getMessage(); // Display the exception message
        return 0;
    }

    return round($totalUnpaidLoan, 2);
}





$queryTotalLoan = "SELECT SUM(loan_amount) AS total_loan FROM loan_details";
$resultTotalLoan = $conn->query($queryTotalLoan);

if ($resultTotalLoan && $resultTotalLoan->num_rows > 0) {
    $rowTotalLoan = $resultTotalLoan->fetch_assoc();
    $totalLoan = (float) $rowTotalLoan['total_loan'];
    $lblTotalLoan = number_format($totalLoan, 2); // Format the total loan amount
} else {
    $lblTotalLoan = "0.00";
}


// Get total paid loan amount from loan_payment table
$queryTotalPaidLoan = "SELECT SUM(payment_amount) AS total_paid_loan FROM loan_payment";
$resultTotalPaidLoan = $conn->query($queryTotalPaidLoan);

if ($resultTotalPaidLoan && $resultTotalPaidLoan->num_rows > 0) {
    $rowTotalPaidLoan = $resultTotalPaidLoan->fetch_assoc();
    $totalPaidLoan = (float) $rowTotalPaidLoan['total_paid_loan'];
    $lblTotalPaidLoan = number_format($totalPaidLoan, 2); // Format the total paid loan amount
} else {
    $lblTotalPaidLoan = "0.00";
}
?>

<!-- Calculating Dates -->

<?php
// Create DateTime objects from start and end dates
//$startDateTime = new DateTime($start_date);
//$endDateTime = new DateTime($end_date);

// Calculate the week number (assuming ISO-8601 week numbering)
//$weekTotal = (int) $startDateTime->format('W');

// Calculate the total weeks between start and end dates
//$interval = $endDateTime->diff($startDateTime);
//$weekNo= (int) ($interval->format('%a') / 7) + 1;

$lblWeekNo = 1;
$lblTotalWeeks = 12;

$currentDate = new DateTime();

// Calculate the start date based on the current date and week number
$startDateTime = clone $currentDate;
$startDateTime->modify('+' . ($lblWeekNo - 1) . ' weeks');

// Calculate the end date based on the start date and total number of weeks
$endDateTime = clone $startDateTime;
$endDateTime->modify('+' . ($lblTotalWeeks - 1) . ' weeks');

// Format dates for display
$startDate = $startDateTime->format('Y-m-d');
$endDate = $endDateTime->format('Y-m-d'); 
?>

<!-- MEMBERS SHARE PANEL -->

<?php

$weekly_payment = 0; // You can set an initial value here
$weekNo = 0; // You can set an initial value here
$membership_fee = 0; 
// Assuming $end_date is in a valid date format
// Calculate memberShare
$members = countMembers($conn);
if ($members > 0) {
    $memberShare = $membership_fee + ($weekly_payment * $weekNo) + (getTotalInterest($conn) * 0.8) / countMembers($conn);

    $memberShare = round($memberShare, 2); // Round the memberShare to 2 decimal places
    $lblMemberShare = number_format($memberShare, 2); // Format the rounded number with 2 decimal places and thousands separator if needed
    
    // Calculate lblMemberSavings
    $memberSavings = $membership_fee + ($weekly_payment * $weekNo);
    $lblMemberSavings = number_format($memberSavings, 2);
    
    // Calculate lblMemberInterestShare
    $memberInterestShare = getTotalInterest($conn) * 0.8 / countMembers($conn);
    $lblMemberInterestShare = number_format($memberInterestShare, 2);
} else {
    $memberShare = 0;
    $lblMemberSavings = 0;
    $lblMemberInterestShare = 0;
}


?>

<!-- INTEREST PANEL -->
<?php

// Get paid interest
$result = $conn->query("SELECT ROUND(SUM(loan_amount * (interest_rate / 100)), 2) AS paid_interest FROM loan_details WHERE is_paid = 1;");
$row = $result->fetch_assoc();
if ($row !== null) {
    $lblPaidInterest = number_format($row['paid_interest'], 2);
} else {
    $lblPaidInterest = "N/A"; // or any default value you want to set
}

// Get pending interest
$result = $conn->query("SELECT ROUND(SUM(loan_amount * (interest_rate / 100)), 2) AS pending_interest FROM loan_details WHERE is_paid = 0;");
$row = $result->fetch_assoc();
if ($row !== null) {
    $lblPendingInterest = number_format($row['pending_interest'], 2);
} else {
    $lblPendingInterest = "N/A"; // or any default value you want to set
}

?>


<!-- SAVINGS PANEL -->
<?php
function getTotalAvailableMoney($conn) {
    $totalSavings = 0;
    $totalLoan = 0;
    $totalPaidLoan = 0;
    $availableMoney = 0;

    try {
        $result = $conn->query("SELECT SUM(deposited) FROM deposit;");
        if ($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_row();
            $totalSavings = floatval($row[0]);
        }

        $result = $conn->query("SELECT SUM(loan_amount) FROM loan_details;");
        if ($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_row();
            $totalLoan = floatval($row[0]);
        }

        $result = $conn->query("SELECT SUM(payment_amount) FROM loan_payment;");
        if ($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_row();
            $totalPaidLoan = floatval($row[0]);
        }

        $availableMoney = $totalSavings - $totalLoan + $totalPaidLoan;

    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

    return number_format($availableMoney, 2);
}


function getTotalSavings($conn) {
    $totalSavings = 0;

    try {
        $result = $conn->query("SELECT SUM(deposited) FROM deposit;");
        if ($result !== false && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $totalSavings = isset($row['SUM(deposited)']) ? floatval($row['SUM(deposited)']) : 0;
        }

    } catch (Exception $ex) {
        echo $ex->getMessage();
    }

    return $totalSavings;
}

?>

<!-- USER-> info_section -->
<?php
function getTotalDeposits($conn, $mem_id) {
    $sql = "SELECT SUM(deposited) AS total_deposit FROM deposit WHERE mem_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $mem_id); // Assuming mem_id is a string, change "s" to "i" if it's an integer
    $stmt->execute();
    $result = $stmt->get_result();

    // Fetch the result
    $row = $result->fetch_assoc();
    $totalDeposit = $row['total_deposit'];

    // Return the total deposit
    return $totalDeposit;
}
?>

<?php

function computeEndDate($conn) {
    $weeks= 52;
    // Get the start date from the database using the getStartDate function
    $start_date = getStartDate($conn);

    // Check if the start date is retrieved successfully
    if ($start_date === "No rows found in the system_info table.") {
        return "Error: " . $start_date;
    }

    // Convert start date to timestamp
    $start_timestamp = strtotime($start_date);

    // Calculate the number of seconds in a week
    $seconds_in_a_week = 60 * 60 * 24 * 7;

    // Calculate the total seconds for the specified number of weeks
    $total_seconds = $weeks * $seconds_in_a_week;

    // Calculate the end timestamp by adding total seconds to start timestamp
    $end_timestamp = $start_timestamp + $total_seconds;

    // Format the end timestamp as a date
    $end_date = date("Y-m-d", $end_timestamp);

    return $end_date;
}


function getStartDate($conn) {
    // Fetch start_date from the system_info table
    $sql = "SELECT start_date FROM system_info";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Assuming you only have one row in the system_info table
        $row = $result->fetch_assoc();
        $start_date = $row['start_date'];

        return $start_date;
    } else {
        return "No rows found in the system_info table.";
    }
}


function getWeekNumber($conn) {
    // Fetch start_date from the system_info table
    $sql = "SELECT start_date FROM system_info";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Assuming you only have one row in the system_info table
        $row = $result->fetch_assoc();
        $start_date = $row['start_date'];

        // Get the current date
        $current_date = date("Y-m-d");

        // Calculate the number of seconds in a week
        $seconds_in_a_week = 60 * 60 * 24 * 7;

        // Calculate the difference in seconds between the start and current dates
        $start_timestamp = strtotime($start_date);
        $current_timestamp = strtotime($current_date);
        $difference = $current_timestamp - $start_timestamp;

        // Calculate the number of weeks
        $week_number = ceil($difference / $seconds_in_a_week);

        return abs($week_number);
    } else {
        return "No rows found in the system_info table.";
    }
}

?>
<?php
function getWeeklyPayment($conn) {
$sql = "SELECT weekly_payment FROM system_info";

// Execute the query
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    // Fetch the result as an associative array
    $row = $result->fetch_assoc();

    // Close the database connection

    // Return the weekly payment value
    return $row['weekly_payment'];
} else {
    // If the query fails, return an error or handle it accordingly
    return "Error: " . $conn->error;
}
}
?>

<?php

// Function to compute the pending amount
function computePendingAmount($conn, $weeklyPayment, $weekNumber, $totalDeposits) {
    // Calculate the expected total payment up to the given week
    $expectedTotalPayment = $weeklyPayment * $weekNumber;

    // Calculate the pending amount by subtracting total deposits from expected total payment
    $pendingAmount = $expectedTotalPayment - $totalDeposits;

    return $pendingAmount;
}
?>
 <?php

function getTotalLoanBalance($conn, $member_id) {
    $loanQuery = "
        SELECT ld.loan_amount
        FROM loan_requests lr
        JOIN loan_details ld ON lr.loan_detail_id = ld.loan_detail_id
        WHERE lr.mem_id = $member_id
          AND lr.request_status = 'approved'
    ";

    $loanResult = $conn->query($loanQuery);

    if ($loanResult) {
        // Calculate the total loan balance
        $totalLoanBalance = 0;
        while ($row = $loanResult->fetch_assoc()) {
            $totalLoanBalance += $row['loan_amount'];
        }

        // Don't close the connection here; you might still need it
        // $conn->close();

        return $totalLoanBalance;
    } else {
        // If the loan query fails, return an error or handle it accordingly
        return "Error: " . $conn->error;
    }
}
?>


<?php
function computeInterestShare($conn, $loanAmount, $member_id) {
    // Fetch loan details from loan_details table for the specified member_id
    $loanDetailsQuery = "
        SELECT lr.mem_id, lr.request_status, ld.loan_amount, ld.interest_rate, ld.month_duration
        FROM loan_requests lr
        JOIN loan_details ld ON lr.mem_id = ld.loan_detail_id
        WHERE lr.mem_id = $member_id
    ";

    $loanDetailsResult = $conn->query($loanDetailsQuery);

    if ($loanDetailsResult && $loanDetailsResult->num_rows > 0) {
        $loanDetails = $loanDetailsResult->fetch_assoc();

        // Extract loan details
        $requestStatus = $loanDetails['request_status'];
        $interestRate = $loanDetails['interest_rate'];
        $loanDurationMonths = $loanDetails['month_duration'];

        // Check if the loan request is approved
        if ($requestStatus == 'approved') {
            // Convert annual interest rate to weekly rate
            $weeklyInterestRate = ($interestRate / 100) / 52;

            // Calculate the total interest over the loan period using compound interest formula
            $compoundInterestFactor = pow(1 + $weeklyInterestRate, 52 * $loanDurationMonths / 12);
            $totalInterest = $loanAmount * $compoundInterestFactor - $loanAmount;
        
            // Calculate the interest share per week
            $interestSharePerWeek = $totalInterest / ($loanDurationMonths * 4); // Assuming 4 weeks in a month
        
            return number_format($interestSharePerWeek, 2);
        } else {
            // Handle the case where the loan request is not approved
            return "Error: Loan request not approved for member $member_id";
        }
    } else {
        // Handle the case where the loan details are not found
        return "Error: Loan details not found for member $member_id";
    }
}
?>



<!-- USER-> request_section -->
