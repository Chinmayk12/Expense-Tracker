<?php
    include 'header.php';

    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
	    exit;
    }
    
    $expenseId = $_GET['id'];
    $userId = $user['id'];

    //echo "<script>alert('$expenseId')</script>";

    $expenses = $database->select('expenses', '*', [
        'AND' => [
            'user_id' => $user['id'],
            'id' => $expenseId // Replace 'specific_id' with the actual ID you want to match
        ]
    ]);

    $accounts = $expenses[0]['accounts'];
    $group = $expenses[0]['group'];
    $category = $expenses[0]['category'];
    $subcategory = $expenses[0]['subcategory'];
    $expensedate = $expenses[0]['date'];
    $mode_of_payment= $expenses[0]['mode'];
    $bank= $expenses[0]['bank'];
    $amount= $expenses[0]['amount'];
    $details= $expenses[0]['details'];
    $rate= $expenses[0]['rate'];
    $quantity= $expenses[0]['quantity'];
    $payment_details= $expenses[0]['payment_details'];
    $payment_status= $expenses[0]['payment_status'];

    //echo "<script>alert('$accounts')</script>";
    
?>

<head>
    <style>
    .main-content {
        min-height: 100vh;
        /* Ensure a minimum height of 100% of the viewport height for the main content */
    }
    </style>
</head>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="update-expense-record-save.php?id=<?php echo $expenseId;?>" method="post"
                class="needs-validation" enctype="multipart/form-data">
                <!-- start page title -->
                <!-- end page title -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header">
                                <h5>Update Expense Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                            $user_id = $user['id']; 
                                            $userAccounts = $database->select('accounts', 'account_name', ['user_id' => $user_id]);
                                        ?>

                                            <label for="accounts">Select Accounts</label>
                                            <select class="form-control form-select" id="accounts" name="accounts"
                                                required="">
                                                <?php
                                            // Loop through user accounts and populate the dropdown
                                            echo '<option value="Cash">Cash</option>';

                                            // Loop through user accounts and populate the dropdown
                                            foreach ($userAccounts as $userAccount)
                                            {
                                                if ($userAccount == $accounts) 
                                                {
                                                    echo '<option selected value="' . $userAccount . '">' . $userAccount . '</option>';
                                                }
                                                else
                                                {
                                                    echo '<option value="' . $userAccount . '">' . $userAccount . '</option>';
                                                }
                                            }
                                            $noneOptionSelected = null;
                                            // Check if the "None" option should be displayed and selected
                                            if($accounts === 'None')
                                            {
                                                $noneOptionSelected = 1;
                                            }
                                            else
                                            {
                                                $noneOptionSelected = 0;
                                            }

                                            // Display the selected account as a selected option if it's not "None"
                                            if ($noneOptionSelected==1)
                                            {
                                                echo '<option value="' . $accounts . '" selected>' . $accounts . '</option>';
                                            }
                                            else 
                                            {
                                                echo '<option value="None">None</option>';
                                            }
                                            ?>
                                            </select>

                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $user_id = $user['id']; 
                                                $userGroups = $database->select('groups', 'group_name', ['user_id' => $user_id]);
                                            ?>
                                            <label for="group">Select Group</label>
                                            <select class="form-control form-select" id="group" name="group"
                                                required="">
                                                <?php
                                                    // Loop through user accounts and populate the dropdown
                                                    foreach ($userGroups as $userGroup)
                                                    {
                                                        if ($userGroup == $group) 
                                                        {
                                                            echo '<option selected value="' . $userGroup . '">' . $userGroup . '</option>';
                                                        }
                                                        else
                                                        {
                                                            echo '<option value="' . $userGroup . '">' . $userGroup . '</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $user_id = $user['id'];

                                                $userCategories = $database->select('categories', ['category_id', 'category_name'], [
                                                    'AND' => [
                                                        'user_id' => $user_id,
                                                        'parent_id' => 0
                                                    ]
                                                ]);              
                                            ?>
                                            <label for="category">Category</label>
                                            <select class="form-control form-select" id="category" name="category"
                                                required="">
                                                <?php
                                                    echo '<option value="None">None</option>';
                                                    // Loop through user accounts and populate the dropdown
                                                    foreach ($userCategories as $userCategory)
                                                    {
                                                        if ($userCategory['category_name'] == $category) 
                                                        {
                                                            echo '<option selected value="' . $userCategory['category_name'] . '">' . $userCategory['category_name'] . '</option>';
                                                        }
                                                        else
                                                        {
                                                            echo '<option value="' . $userCategory['category_name'] . '">' . $userCategory['category_name'] . '</option>';
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $user_id = $user['id'];

                                                $userSubategories = $database->select('categories', ['category_id', 'category_name'], [
                                                    'AND' => [
                                                        'user_id' => $user_id,
                                                        'parent_id[!]' => 0
                                                    ]
                                                ]);          
                                            ?>
                                            <label for="subcategory">Subcategory</label>
                                            <select class="form-control form-select" id="subcategory" name="subcategory"
                                                required="">
                                                <?php
                                                echo '<option value="None">None</option>';
                                                // Loop through user accounts and populate the dropdown
                                                foreach ($userSubategories as $userSubategory)
                                                {
                                                    if ($userSubategory['category_name'] == $subcategory) 
                                                    {
                                                        echo '<option selected value="' . $userSubategory['category_name'] . '">' . $userSubategory['category_name'] . '</option>';
                                                    }
                                                    else
                                                    {
                                                        echo '<option value="' . $userSubategory['category_name'] . '">' . $userSubategory['category_name'] . '</option>';
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <?php
                                        $date = $_GET['date'];
                                    ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="expensedate">Expesne Date :</label>
                                            <input type="date" class="form-control" id="expensedate" name="expensedate"
                                                required="" value="<?php echo $date; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                            $payment_mode = $_GET['mop'];
                                            ?>
                                            <label for="mop">Mode of payment:</label>
                                            <select class="form-control" id="mop" name="mop" required=""
                                                onchange="toggleFileInput()">
                                                <option value="Online"
                                                    <?php if ($payment_mode === 'Online') echo 'selected'; ?>>Online
                                                </option>
                                                <option value="Cash"
                                                    <?php if ($payment_mode === 'Cash') echo 'selected'; ?>>Cash
                                                </option>
                                                <option value="Check"
                                                    <?php if ($payment_mode === 'Check') echo 'selected'; ?>>Check
                                                </option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <?php
                                                $userbanks = $database->select('bank_details', 'bank_name', ['user_id' => $user_id]);
                                            ?>
                                            <label for="bank">Select Bank</label>
                                            <select class="form-control form-select" id="bank" name="bank" required="">
                                                <?php
                                                     foreach ($userbanks as $userbank)
                                                     {
                                                         if ($userbank == $bank) 
                                                         {
                                                            echo '<option selected value="' . $userbank . '">' . $userbank . '</option>';
                                                         }
                                                         else
                                                         {
                                                            echo '<option value="' . $userbank . '">' . $userbank . '</option>';
                                                         }
                                                     }
                                                ?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="text" class="form-control" id="amount" name="amount"
                                                value="<?php echo $amount  ?>" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="details">Details</label>
                                            <input type="text" class="form-control" id="details" name="details"
                                                value="<?php echo $details?>" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="rate">Rate</label>
                                            <input type="text" class="form-control" id="rate" name="rate"
                                                value="<?php echo $rate  ?>" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="qty">Quantity</label>
                                            <input type="text" class="form-control" id="qty" name="qty"
                                                value="<?php echo $quantity  ?>" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="payment_details">Payment Details</label>
                                            <input type="text" class="form-control" id="payment_details"
                                                name="payment_details" value="<?php echo $payment_details  ?>"
                                                required="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="payment _status">Payment Status</label>
                                            <select class="form-control" id="payment_status" name="payment_status"
                                                required="">
                                                <option value="done">Done</option>
                                                <option value="pending">Pending</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="photo">Upload Receipt:</label>
                                            <input type="file" name="photo" id="photo" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="submit" value="Update Record" name="submit"
                                                class="btn btn-primary mb-4 mt-3">
                                            <input type="button" value="Cancel" class="btn btn-danger mb-4 mt-3"
                                                onclick="redirectToExpenseRecord()">
                                        </div>
                                    </div>

                                </div>
                                <script>
                                function redirectToExpenseRecord() {
                                    // Redirect to "add-group.php" when the Cancel button is clicked
                                    window.location.href = "expense-records.php";
                                }
                                </script>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row gy-3-->
                </div> <!-- container-fluid -->
            </form>
        </div><!-- End Page-content -->
    </div>
    <script>
    window.onload = toggleFileInput;

    function toggleFileInput() {
        var mopDropdown = document.getElementById('mop');
        var photoInput = document.getElementById('photo');

        if (mopDropdown.value === 'Cash') {
            // Disable the file input when "Cash" is selected for mode of payment
            photoInput.disabled = true;
        } else {
            // Enable the file input for other payment modes
            photoInput.disabled = false;
        }
    }
    </script>
</div>
<?php
    include 'footer.php';
?>