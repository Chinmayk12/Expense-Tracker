<?php
include 'header.php';

    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
        exit;
    }
    
    $userBankDetails = $database->select('bank_details', '*', [
        'user_id' => $user['id']
    ]);
    $count = 0 
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
            <form action="add-bank-save.php" method="POST" class="needs-validation" enctype="multipart/form-data">


                <!-- start page title -->
                <div class="row gy-3">
                    <div class="col-12">

                        <!-- <h4 class="mb-sm-0">Add Family Member to (<?php //echo $family_data['last_name']; ?>'s Family)</h4> -->

                    </div>
                </div>
        </div>

        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h5>Bank Information</h5>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account_name">Account Holder Name</label>
                                    <input type="text" class="form-control" id="acct_name" name="acct_name" required>

                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="account_no">Account Number</label>
                                    <input type="number" class="form-control" id="acct_number" name="acct_number"
                                        placeholder='Enter only Numeric Values' required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="bank_name">Bank Name:</label>
                                    <input type="text" class="form-control" id="bank_name" name="bank_name" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="branch">Branch</label>
                                    <input type="text" class="form-control" id="branch" name="branch" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="ifsc_code">IFSC Code</label>
                                    <input type="text" class="form-control" id="ifsc_code" name="ifsc_code" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="micr_code">MICR Code</label>
                                    <input type="text" class="form-control" id="micr_code" name="micr_code" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <input type="submit" value="Add Bank Details" name='sub' class="btn btn-primary mb-4">
                            </div>
                        </div>

                    </div>



                </div>
                </form>
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown d-md-none topbar-head-dropdown header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                id="mobileSearchButton" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="bx bx-search fs-22"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="mobileSearchButton">
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search..."
                                                autocomplete="off" id="mobileSearchInput" value="">
                                            <button type="button" id="mobileSearchButtonSubmit"
                                                class="btn btn-primary"><i class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- For screens medium and larger, use the original form -->
                        <form class="app-search d-none d-md-block">
                            <div class="position-relative"
                                style="width: 300px; border: 1px solid #ccc; border-radius: 5px;">
                                <input type="text" class="form-control" placeholder="Search..." autocomplete="off"
                                    id="desktopSearchInput" value="">
                                <span class="mdi mdi-magnify search-widget-icon"></span>
                                <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                                    id="search-close-options"></span>
                                <button type="button" id="desktopSearchButton"
                                    class="btn btn-primary waves-effect waves-light visually-hidden">Search</button>
                            </div>

                            <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                                <div data-simplebar style="max-height: 320px;">
                                    <div class="notification-list">
                                    </div>
                                </div>
                                <div class="text-center pt-3 pb-1">
                                    <a href="#" class="btn btn-primary btn-sm">View All Results
                                        <i class="ri-arrow-right-line ms-1"></i></a>
                                </div>
                            </div>
                        </form>

                        <div class="live-preview">
                            <div class="table-responsive">
                                <div id="searchResults"></div>
                                <div id="tableContainer">
                                    <!-- Search results will be inserted here -->
                                </div>

                                <style>
                                #tableContainer {
                                    display: none;
                                }
                                </style>
                                <script
                                    src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js">
                                </script>

                                <table id="myTable" class="table table-bordered table-nowrap ">
                                    <thead style="background-color: #405189;">
                                        <tr style="color: white">
                                            <th scope="col">Sr.No</th>
                                            <th scope="col">Account Holder Name</th>
                                            <th scope="col">Account Number</th>
                                            <th scope="col">Bank Name</th>
                                            <th scope="col">Branch</th>
                                            <th scope="col">IFSC Code</th>
                                            <th scope="col">MICR Code</th>
                                            <th scope="col">Action</th>

                                        </tr>
                                    </thead>

                                    <?php
                                        $usersCount = count($userBankDetails);
                                        for ($i = 0; $i <$usersCount; $i++) 
                                        {
                                            $userBank = $userBankDetails[$i];
                                                            
                                        ?>


                                    <tr>
                                        <td><?php echo $count+=1 ?></td>
                                        <td><?php echo $userBank['acct_name']; ?></td>
                                        <td><?php echo $userBank['acct_number']; ?></td>
                                        <td><?php echo $userBank['bank_name']; ?></td>
                                        <td><?php echo $userBank['branch']; ?></td>
                                        <td><?php echo $userBank['ifsc_code']; ?></td>
                                        <td><?php echo $userBank['micr_code']; ?></td>
                                        </td>
                                        <td>
                                            <a class="btn btn-success waves-effect waves-light"
                                                href="update-bank-details.php?update=<?php echo $userBank['bank_id'] ?>">Update</a>
                                            <a class="btn btn-danger waves-effect waves-light" href="#"
                                                onclick="showDeleteConfirmation('<?php echo $userBank['bank_id']; ?>')">Delete</a>


                                        </td>




                                    </tr>
                                    <?php } ?>


                                </table>

                                <?php
                                                    
                                    if (isset($_GET['delete'])) 
                                    {
                                        $bankId = $_GET['delete'];
                                        $database->delete('bank_details', ['bank_id' => $bankId , 'user_id' => $user['id']]);
                                        echo '<script>window.location.href = "add-bank-details.php";</script>';
                                        exit();    
                                    }
                                ?>

                                <link rel="stylesheet"
                                    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                                <script>
                                function showDeleteConfirmation(groupId) {
                                    Swal.fire({
                                        title: 'Are you sure?',
                                        text: 'You will not be able to recover this Bank Details!',
                                        icon: 'warning',
                                        showCancelButton: true,
                                        confirmButtonColor: '#d33',
                                        cancelButtonColor: '#3085d6',
                                        confirmButtonText: 'Yes, delete it!',
                                        iconHtml: '<i class="fas fa-trash-alt"></i>'
                                    }).then((result) => {
                                        if (result.isConfirmed) {
                                            // If the user clicks "Yes, delete it!", perform the delete action
                                            window.location.href = '?delete=' + groupId;
                                        }
                                    });
                                }
                                </script>
                            </div>
                        </div>



                        <div class="d-none code-view">

                        </div>
                    </div>
                </div><!-- end card-body -->
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
</form>
</div><!-- End Page-content -->
</div>
<style>
/* Add CSS to style the fixed table header */
.fixed-header {
    position: sticky;
    top: 0;
    z-index: 1;
    background-color: #405189;
    color: white;
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function searchTable(inputId) {
    var input, filter, table, tr, td, i, j, txtValue;
    input = document.getElementById(inputId);
    filter = input.value.toUpperCase();
    table = document.getElementById("myTable");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) { // Start from index 1 to skip the table header row
        var visible = false;

        for (j = 0; j < tr[i].getElementsByTagName("td").length; j++) {
            td = tr[i].getElementsByTagName("td")[j];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    visible = true;
                    break;
                }
            }
        }

        tr[i].style.display = visible ? "" : "none";
    }
}

$(document).ready(function() {
    $("#desktopSearchInput").on("keyup", function() {
        searchTable("desktopSearchInput");
    });

    $("#mobileSearchInput").on("keyup", function() {
        searchTable("mobileSearchInput");
    });
});
</script>
<?php

include 'footer.php';
?>