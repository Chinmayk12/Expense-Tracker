<?php
    include 'header.php';
    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
        exit;
    }

?>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<head>
    <style>
        .main-content {
        min-height: 100vh; /* Ensure a minimum height of 100% of the viewport height for the main content */
    }
    </style>
</head>
<div class="vertical-overlay"></div>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">
        <form action="add-bank-save.php" method="get" class="needs-validation" enctype="multipart/form-data">
            <!-- start page title -->
            <div class="row gy-3">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <!-- <h4 class="mb-sm-0">Add Family Member to (<?php //echo $family_data['last_name']; ?>'s Family)</h4> -->

                    </div>
                </div>
            </div>
         
            <!-- end page title -->
            
            <div class="row">
                    <div class="col-lg-12">
                        
                    <div class="card">
                            <div class="card-header">
                                <h5>Account Details</h5>
                            </div>
                            <div class="card-body">
                             <div class="row gy-3">
                             <div class="col-md-4">      
                                    <div class="form-group">
                                    <label for="account_name">Account Name</label>
                                     <input type="text" class="form-control" id="acct_name" name="acct_name" required>
                            
                                    </div>
                                </div>

                                
                                <div class="col-md-4">      
                                    <div class="form-group">
                                    <label for="acc_no">Account Number:</label>
                                    <input type="text" class="form-control" id="acc_no" name="acc_no" required>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                <div class="form-group">
                                <label for="account_no">Email</label>
                                <input type="email" class="form-control" id="account_email" name="account_email" required>
                                    </div>
                                </div>
                             </div>
                        </div>           
                        </div>
                    </div>
                    </div>
                        <!--end row gy-3-->
                        <input type="submit" value="Add Accounts" name='submit' class="btn btn-primary mb-4">
                        <!--end col-->
                    </div>
                    <!--end row gy-3-->

                </div> <!-- container-fluid -->
            </form>
        </div><!-- End Page-content -->
    </div>
</div>
<?php

include 'footer.php';
?>