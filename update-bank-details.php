<?php
include 'header.php';
if(!isset($_SESSION['user']))
{
    echo "<script>window.location='index.php'</script>";
    exit;
}
$user_bank_details = $database->select('bank_details', '*');
$count = 0 ;

$bankId = $_GET['update'];
// echo "<script>alert('$bankId')</script>";

$results = $database->select('bank_details', '*', ['bank_id' => $bankId]);

?>

<head>
    <style>
    .main-content {
        min-height: 100vh;
        /* Ensure a minimum height of 100% of the viewport height for the main content */
    }
    </style>
</head>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

<div class="vertical-overlay"></div>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
            <form action="" method="POST" class="needs-validation" enctype="multipart/form-data">
        </div>

        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h5>Update Bank Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account_name">Account Holder Name</label>
                                    <input type="text" class="form-control" id="acct_name"
                                        value="<?php echo $results[0]['acct_name'] ?>" name="acct_name" required>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account_no">Account Number</label>
                                    <input type="number" class="form-control" id="acct_number" name="acct_number"
                                        value="<?php echo $results[0]['acct_number'] ?>" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name:</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $results[0]['bank_name'] ?>" id="bank_name" name="bank_name"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch">Branch</label>
                                    <input type="text" value="<?php echo $results[0]['branch'] ?>" class="form-control"
                                        id="branch" name="branch" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ifsc_code">IFSC Code</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $results[0]['ifsc_code'] ?>" id="ifsc_code" name="ifsc_code"
                                        required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="micr_code">MICR Code</label>
                                    <input type="text" class="form-control"
                                        value="<?php echo $results[0]['micr_code'] ?>" id="micr_code" name="micr_code"
                                        required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <input type="submit" value="Update Bank Details" name='sub' class="btn btn-primary">
                                <input type="button" value="Cancel" class="btn btn-danger"
                                    onclick="redirectToBankDetails()">
                            </div>
                            <script>
                            function redirectToBankDetails() {
                                window.location.href = "add-bank-details.php";
                            }
                            </script>
                        </div>
                    </div>
                </div>
                </form>
            </div><!-- end card-body -->

            <?php
// Make sure to include the Medoo library and set up the database connection before this code.

                if (isset($_POST['sub'])) {
                    $bankId = $_GET['update'];
                    
                    // Get the data from the form
                    $accountName = $_POST['acct_name'];
                    $accountNumber = $_POST['acct_number'];
                    $bankName = $_POST['bank_name'];
                    $branch = $_POST['branch'];
                    $ifscCode = $_POST['ifsc_code'];
                    $micrCode = $_POST['micr_code'];

                    // Update the bank details in the database
                    $updateResult = $database->update('bank_details', [
                        'acct_name' => $accountName,
                        'acct_number' => $accountNumber,
                        'bank_name' => $bankName,
                        'branch' => $branch,
                        'ifsc_code' => $ifscCode,
                        'micr_code' => $micrCode,
                    ], [
                        'bank_id' => $bankId,
                    ]);

                    if ($updateResult) {
                        echo "<script>alert('Bank Details Updated Successfully');</script>";
                        echo "<script>window.location='add-bank-details.php'</script>"; // Replace 'your-target-page.php' with the desired destination page after successful update
                    } else {
                        echo "Bank Details Not Updated<br>";            
                        echo "Error: " . $database->error()[2];
                    }
                }
            ?>

        </div>


    </div>

    <!--end row gy-3-->




    <!--end col-->
</div>

<!--end row gy-3-->


</div> <!-- container-fluid -->

</div><!-- End Page-content -->
</div>
</div>
<?php

include 'footer.php';
?>