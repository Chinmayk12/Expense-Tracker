<?php
    include 'header.php';
    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
        exit;
    }
    
    $user_id = $user['id'];
    //echo "<script>alert('$mobileno')</script>";
?>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
<div class="vertical-overlay"></div>

<head>
    <style>
    .main-content {
        min-height: 100vh;
        /* Ensure a minimum height of 100% of the viewport height for the main content */
    }
    </style>
</head>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="add-income-save.php" method="post" class="needs-validation" enctype="multipart/form-data">
                <!-- start page title -->
                <!-- end page title -->
                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header">
                                <h5>Income Information</h5>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">

                                    <?php
                                       $data = $database->select('groups', 'group_name', ['user_id' => $user_id]);
                                    ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="group">Select Group</label>
                                            <select class="form-control form-select" id="group" name="group"
                                                required="">
                                                <option value="" disabled selected>Please select Group</option>
                                                <?php foreach ($data as $user) {?> <option value="<?php echo $user; ?>">
                                                    <?php echo $user; ?></option> <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="expensedate">Income Date :</label>
                                            <input type="date" class="form-control" id="incomedate" name="incomedate"
                                                required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="amount">Amount</label>
                                            <input type="text" class="form-control" id="amount" name="amount" required>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="mop">Mode of Income:</label>
                                            <select class="form-control" id="moi" name="moi" required
                                                onchange="toggleFileInput()">
                                                <option value="Online">Online</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Check">Check</option>
                                            </select>
                                        </div>
                                    </div>

                                    <?php
                                       $banks = $database->select('bank_details', 'bank_name',['user_id' => $user_id]);
                                    ?>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="bank">Select Bank</label>
                                            <select class="form-control form-select" id="bank" name="bank" required>
                                                <option value="" disabled selected>select bank</option>
                                                <?php foreach ($banks as $bank) {?> <option
                                                    value="<?php echo $bank; ?>"><?php echo $bank; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="details">Details</label>
                                            <textarea class="form-control" rows="1" cols="5" id="details" name="details"
                                                required>
                                        </textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="payment_details">Payment Details</label>
                                            <input type="text" class="form-control" id="payment_details"
                                                name="payment_details" required>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="photo">Upload Receipt:</label>
                                            <input type="file" name="photo" id="photo" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <input type="submit" value="Add Income" name="submit" class="btn btn-primary mb-2 mt-4">
                                    </div>
                                </div>
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
    function toggleFileInput() {
        var moiDropdown = document.getElementById('moi');
        var photoInput = document.getElementById('photo');

        if (moiDropdown.value === 'Cash') {
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