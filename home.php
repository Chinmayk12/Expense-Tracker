<?php
    include 'header.php';  
    
    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
        exit;
    }

    // $id = $user['id'];
    // echo "<script>alert('$id')</script>";
    
    //----------------------------------------------------------------------------------------------------------------------
    // Todays Expenses 
    $today = date('Y-m-d');
    $todays_expense = $database->select('expenses', '*', [
        'date' => $today,
        'user_id' => $user['id']
    ]);

    $todaysexpenses = 0;
    // Calculate the total expenses by summing up all the amounts in $month_expenses
    foreach ($todays_expense as $row)
    {
        $todaysexpenses += (float)$row['amount'];
    }

    $dataPoints1 = array();
    foreach ($todays_expense as $row)
    {
        $dataPoints1[] = array
        (
            'label' => $row['group'],      
            'y' => (float)$row['amount'],
        );
    }
    //-----------------------------------------------------------------------------------------------------------------------------------
    // Month Expenses
    $currentMonth = date('m');
    $currentYear = date('Y');

    $startMonth = $currentMonth; // June
    $startYear = $currentYear;

    $endMonth = $currentMonth; // September
    $endYear =  $currentYear;

    // Step 2: Construct the start and end dates for the date range
    $startDate = $startYear . '-' . str_pad($startMonth, 2, '0', STR_PAD_LEFT) . '-01';
    $endDate = $endYear . '-' . str_pad($endMonth, 2, '0', STR_PAD_LEFT) . '-31';

    $month_expenses = $database->select('expenses', '*', [
        'date[<>]' => [$startDate, $endDate],
        'user_id' => $user['id']
    ]);

    $month_expenses_sum = $database->sum('expenses', 'amount', [
        'date[<>]' => [$startDate, $endDate],
        'user_id' => $user['id']
    ]);

    $dataPoints2 = array();
    foreach ($month_expenses as $row)
    {
        $dataPoints2[] = array
        (
            'label' => $row['group'],      
            'y' => (float)$row['amount'],
        );
    }

    //-------------------------------------------------------------------------------------------------------------
    // Month Income
    $currentMonth = date('m');
    $currentYear = date('Y');

    $startMonth = $currentMonth; // June
    $startYear = $currentYear;

    $endMonth = $currentMonth; // September
    $endYear =  $currentYear;

    // Step 2: Construct the start and end dates for the date range
    $startDate = $startYear . '-' . str_pad($startMonth, 2, '0', STR_PAD_LEFT) . '-01';
    $endDate = $endYear . '-' . str_pad($endMonth, 2, '0', STR_PAD_LEFT) . '-31';

    $month_income = $database->select('income', '*', [
        'date[<>]' => [$startDate, $endDate],
        'user_id' => $user['id']
    ]);

    $month_income_sum = $database->sum('income', 'amount', [
        'date[<>]' => [$startDate, $endDate],
        'user_id' => $user['id']
    ]);

    $dataPoints3 = array();
    foreach ($month_income as $row)
    {
        $dataPoints3[] = array
        (
            'label' => $row['group'],      
            'y' => (float)$row['amount'],
        );
    }

    //--------------------------------------------------------------------------------------------------------------
    //Yearly Expense
    $currentYear = date('Y');

    $startYear = $currentYear; // Set the start year to the current year
    $endYear = $currentYear;   // Set the end year to the current year

    // Construct the start and end dates for the date range
    $startDate = $startYear . '-01-01'; // Start date is the first day of the start year
    $endDate = $endYear . '-12-31';     // End date is the last day of the end year

    $year_expense = $database->select('expenses', '*', 
    [
        'date[<>]' => [$startDate, $endDate],
        'user_id' => $user['id']
    ]);

    // Initialize an array to store the total income for each month (initialize all months to zero)
    $monthlyExpense = array_fill(1, 12, 0);

    $yearexpense = 0;
    // Calculate the total income for each month
    foreach ($year_expense as $row) 
    {
        $month = date('n', strtotime($row['date'])); // Extract the month (1 to 12) from the date
        $monthlyExpense[$month] += (float)$row['amount'];
        $yearexpense += (float)$row['amount']; 
    }

    
    // Create an array with month names for labeling the chart
    $monthNames = array
    (
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December'
    );

    $dataPoints4 = array();
    foreach ($monthlyExpense as $month => $expense) 
    {
        $dataPoints4[] = array
        (
            'label' => $monthNames[$month],
            'y' => (float)$expense,
        );
    }

    //--------------------------------------------------------------------------------------------------------------
    //Yearly income
    $currentYear = date('Y');

    $startYear = $currentYear; // Set the start year to the current year
    $endYear = $currentYear;   // Set the end year to the current year

    // Construct the start and end dates for the date range
    $startDate = $startYear . '-01-01'; // Start date is the first day of the start year
    $endDate = $endYear . '-12-31';     // End date is the last day of the end year

    $year_incomes = $database->select('income', '*', 
    [
        'date[<>]' => [$startDate, $endDate],
        'user_id' => $user['id']
    ]);

    // Initialize an array to store the total income for each month (initialize all months to zero)
    $monthlyincomes = array_fill(1, 12, 0);

    $yearincomes = 0;
    // Calculate the total income for each month
    foreach ($year_incomes as $row) 
    {
        $month = date('n', strtotime($row['date'])); // Extract the month (1 to 12) from the date
        $monthlyincomes[$month] += (float)$row['amount'];
        $yearincomes += (float)$row['amount']; 
    }

    // Create an array with month names for labeling the chart
    $monthNames = array
    (
        1 => 'January',
        2 => 'February',
        3 => 'March',
        4 => 'April',
        5 => 'May',
        6 => 'June',
        7 => 'July',
        8 => 'August',
        9 => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December'
    );

    $dataPoints5 = array();
    foreach ($monthlyincomes as $month => $income) 
    {
        $dataPoints5[] = array
        (
            'label' => $monthNames[$month],
            'y' => (float)$income,
        );
    }
?>

<html>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
<div class="vertical-overlay"></div>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0"> Total Expenses
                                    </p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">&#8377;
                                        <?php
                                            if($month_expenses_sum>0)
                                            {
                                                echo $month_expenses_sum;
                                            }
                                            else
                                            {
                                                echo "0";
                                            }
                                        ?>
                                        </span></h4>
                                    <a href="expense-records.php" class="text-decoration-underline">Track Expenses</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-info rounded fs-3">
                                        <i class="bx bx-shopping-bag text-info"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Total Income</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">&#8377;
                                        <?php 
                                            if($month_income_sum>0)
                                            {
                                                echo $month_income_sum;
                                            }
                                            else
                                            {
                                                echo "0";
                                            }
                                        ?>
                                        </span>
                                    </h4>
                                    <a href="income-records.php" class="text-decoration-underline">Track Income</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-success rounded fs-3">
                                        <i class="bx bx-dollar-circle text-success"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Bank Details</p>
                                </div>
                            </div>
                            <?php
                                $totalBankRecords = $database->count('bank_details', [
                                    'user_id' => $user['id']
                                ]);
                                // echo "<script>alert('$totalBankRecords')</script>";
                            
                            ?>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        <?php 
                                            if($totalBankRecords>0)
                                            {
                                                echo $totalBankRecords;
                                            }
                                            else
                                            {
                                                echo "0";
                                            }
                                        ?>
                                        </span>
                                    </h4>
                                    <a href="add-bank-details.php" class="text-decoration-underline">Track Bank
                                        Details</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-primary rounded fs-3">
                                        <i class="bx bx-wallet text-primary"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">My Accounts</p>
                                </div>
                            </div>
                            <?php
                                $totalAccounts = $database->count('accounts', [
                                    'user_id' => $user['id']
                                ]);
                                // echo "<script>alert('$totalBankRecords')</script>";
                            
                            ?>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        <?php 
                                            if($totalAccounts>0)
                                            {
                                                echo $totalAccounts;
                                            }
                                            else
                                            {
                                                echo "0";
                                            }
                                        ?>
                                        </span>
                                    </h4>
                                    <a href="add-account-details.php" class="text-decoration-underline">Track Account
                                        Details</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-soft-warning rounded fs-3">
                                        <i class="bx bx-user-circle text-warning"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="row">
                    <div class="col-xl-12">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Today's
                                            Expense
                                        </p>
                                        <div>
                                            <div id="chartContainer1" style="height: 370px; width: 100%;"></div>
                                            <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                </div>
                <div class="col-xl-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Month Expense
                                    </p>
                                    <div>
                                        <div id="chartContainer2" style="height: 370px; width: 100%;"></div>
                                        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div class="col-xl-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Month Income
                                    </p>
                                    <div>
                                        <div id="chartContainer3" style="height: 370px; width: 100%;"></div>
                                        <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
                <div>

                    <div class="row">
                        <div class="col-xl-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Year
                                                Expense
                                            </p>
                                            <div>
                                                <div id="chartContainer4" style="height: 370px; width: 100%;"></div>
                                                <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                        <div class="col-xl-6">
                            <!-- card -->
                            <div class="card card-animate">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1 overflow-hidden">
                                            <p class="text-uppercase fw-medium text-muted text-truncate mb-0">Year
                                                Incomes</p>
                                            <div>
                                                <div id="chartContainer5" style="height: 370px; width: 100%;"></div>
                                                <script src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div>
                </div>
            </div>
        </div>
        <script>
        function togglePasswordVisibility(passwordInputId, passwordAddonId) {
            const passwordInput = document.getElementById(passwordInputId);
            const passwordAddon = document.getElementById(passwordAddonId);

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
                passwordAddon.innerHTML = '<i class="ri-eye-off-fill align-middle"></i>';
            } else {
                passwordInput.type = "password";
                passwordAddon.innerHTML = '<i class="ri-eye-fill align-middle"></i>';
            }
        }
        </script>
        <script>
        window.onload = function() {

            var chart1 = new CanvasJS.Chart("chartContainer1", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "<?php 
                                if($todaysexpenses>0)
                                {
                                    echo "Today's Expense = " . $todaysexpenses;
                                }                            
                                else
                                {
                                    echo "No Today's Expenses Yet";
                                }
                            ?>",
                    fontSize: 18, // Change font size here
                    fontFamily: "Arial", // Change font family here
                    fontWeight: "normal", // Change font weight here (normal, bold, etc.)
                },
                axisY: {
                    includeZero: true
                },
                data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    //indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart1.render();

            var chart2 = new CanvasJS.Chart("chartContainer2", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "<?php 
                                if($month_expenses_sum>0)
                                {
                                    echo "Month Expense = " . $month_expenses_sum;
                                }                            
                                else
                                {
                                    echo "No Monthly Expenses Yet";
                                }
                            ?>",
                    fontSize: 18, // Change font size here
                    fontFamily: "Arial", // Change font family here
                    fontWeight: "normal", // Change font weight here (normal, bold, etc.)
                },
                axisY: {
                    includeZero: true
                },
                data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    //indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart2.render();

            var chart3 = new CanvasJS.Chart("chartContainer3", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "<?php 
                                if($month_income_sum>0)
                                {
                                    echo "Month Income = " . $month_income_sum;
                                }                            
                                else
                                {
                                    echo "No Monthly Incomes Yet";
                                }
                            ?>",
                    fontSize: 18, // Change font size here
                    fontFamily: "Arial", // Change font family here
                    fontWeight: "normal", // Change font weight here (normal, bold, etc.)
                },
                axisY: {
                    includeZero: true
                },
                data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    //indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($dataPoints3, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart3.render();

            var chart4 = new CanvasJS.Chart("chartContainer4", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: "<?php 
                                 if($yearexpense>0)
                                 {
                                     echo "Yearly Expenses = " . $yearexpense;
                                 }                            
                                 else
                                 {
                                     echo "No Yearly Expenses Yet";
                                 }
                           ?>",
                    fontSize: 18, // Change font size here
                    fontFamily: "Arial", // Change font family here
                    fontWeight: "normal", // Change font weight here (normal, bold, etc.)
                },
                axisY: {
                    includeZero: true
                },
                data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    //indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($dataPoints4, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart4.render();

            var chart5 = new CanvasJS.Chart("chartContainer5", {
                animationEnabled: true,
                exportEnabled: true,
                theme: "light1", // "light1", "light2", "dark1", "dark2"
                title: {
                    text: " <?php 
                                 if($yearincomes>0)
                                 {
                                     echo "Yearly Incomes = " . $yearincomes;
                                 }                            
                                 else
                                 {
                                     echo "No Yearly Incomes Yet";
                                 }
                            ?>",
                    fontSize: 18, // Change font size here
                    fontFamily: "Arial", // Change font family here
                    fontWeight: "normal", // Change font weight here (normal, bold, etc.)
                },
                axisY: {
                    includeZero: true
                },
                data: [{
                    type: "column", //change type to bar, line, area, pie, etc
                    //indexLabel: "{y}", //Shows y value on all Data Points
                    indexLabelFontColor: "#5A5757",
                    indexLabelPlacement: "outside",
                    dataPoints: <?php echo json_encode($dataPoints5, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart5.render();

        }
        </script>

</html>
<?php
    include 'footer.php';
?>