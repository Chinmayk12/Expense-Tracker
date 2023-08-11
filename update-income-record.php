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

    $income = $database->select('income', '*', [
        'AND' => [
            'user_id' => $user['id'],
            'id' => $expenseId // Replace 'specific_id' with the actual ID you want to match
        ]
    ]);

    $group = $income[0]['group'];
    $expensedate = $income[0]['date'];
    $mode_of_payment= $income[0]['mode'];
    $bank= $income[0]['bank'];
    $amount= $income[0]['amount'];
    $details= $income[0]['details'];
    $payment_details= $income[0]['payment_details'];
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
            <form action="update-income-record-save.php?id=<?php echo $expenseId;?>" method="post"
                class="needs-validation" enctype="multipart/form-data">
                <!-- start page title -->
                <!-- end page title -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header">
                                <h5>Update Income Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
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

                                    <?php
                                        $date = $_GET['date'];
                                    ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="date">Income Date :</label>
                                            <input type="date" class="form-control" id="date" name="date" required=""
                                                value="<?php echo $date; ?>">
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
                                                $user_id = $user['id']; 
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
                                            <textarea class="form-control" rows="1" cols="5" id="details" name="details"
                                                required=""><?php echo $details  ?></textarea>
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
                                                class="btn btn-primary mb-3 mt-3">
                                            <input type="button" value="Cancel" class="btn btn-danger mb-3 mt-3"
                                                onclick="redirectToIncomeRecord()">
                                        </div>
                                    </div>

                                </div>
                                <script>
                                function redirectToIncomeRecord() {
                                    // Redirect to "add-group.php" when the Cancel button is clicked
                                    window.location.href = "income-records.php";
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