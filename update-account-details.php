<?php
    include 'header.php';
    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
	    exit;
    }
    
    $account_id = $_GET['id'];
    $_SESSION['account_id']  = $account_id;

    $user_account = $database->select('accounts', '*', [
        'id' => $account_id,
    ]);

    $account_name = $user_account[0]['account_name'];
    $account_number = $user_account[0]['account_number'];
    $account_email = $user_account[0]['email'];


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
            <form action="update-account-details-save.php" method="get" class="needs-validation"
                enctype="multipart/form-data">
                <!-- end page title -->

                <div class="row">
                    <div class="col-lg-12">

                        <div class="card">
                            <div class="card-header">
                                <h5>Update Account Details</h5>
                            </div>
                            <div class="card-body">
                                <div class="row gy-3">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="account_name">Account Name</label>
                                            <input type="text" class="form-control" id="acct_name" name="acct_name"
                                                value="<?php echo $account_name?>" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="acc_no">Account Number:</label>
                                            <input type="text" class="form-control" id="acc_no" name="acc_no"
                                                value="<?php echo $account_number?>" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="account_no">Email</label>
                                            <input type="email" class="form-control" id="account_email"
                                                value="<?php echo $account_email?>" name="account_email" required="">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <input type="submit" value="Update Account" name='sub'
                                            class="btn btn-primary">
                                        <input type="button" value="Cancel" class="btn btn-danger"
                                            onclick="redirectToAccountDetails()">
                                    </div>
                                    <script>
                                    function redirectToAccountDetails() {
                                        // Redirect to "add-group.php" when the Cancel button is clicked
                                        window.location.href = "add-account-details.php";
                                    }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
    include 'footer.php';
?>