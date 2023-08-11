<?php
    include 'header.php';

    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
	    exit;
    }
    
    $catId =  $_GET['update'];

    $catData = $database->select('categories', 'category_name', [
        'category_id' => $catId,
        'user_id' => $user['id']
    ]);

    $catName = $catData[0];
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
                        <h5>UPDATE CATEGORY</h5>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <!-- <label for="first-name"> Enter Category :</label> -->
                                    <input type="text" value="<?php echo $catName ?>" class="form-control" id="category"
                                        name="update_category" required>
                                    <br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="submit" value="Update Category" name='sub' class="btn btn-primary mb-4">
                                <input type="button" value="Cancel" class="btn btn-danger mb-4"
                                    onclick="redirectToCategory()">
                            </div>
                            <script>
                            function redirectToCategory() {
                                // Redirect to "add-group.php" when the Cancel button is clicked
                                window.location.href = "add-category.php";
                            }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
    </div>


    <div>
        <?php
        // Check if the 'id' parameter exists in the URL
        if (isset($_POST['sub'])) 
        {
            $id = $_GET['update'];
            $val = $_POST['update_category'];
           
            $insertResult = $database->update('categories', ['category_name' => $val], [
                'category_id' => $id,
                'user_id' => $user['id']
            ]);
            
                        
            if ($insertResult)
            {
                echo "<script>alert('Category Updated Successfully')</script>";
                echo "<script>window.location='add-category.php'</script>";
            }
            else
            {
                echo "Record Not Inserted<br>";
                echo "Error: " . $database->error()[2];
            }
        }
        ?>
    </div>
</div> <!-- container-fluid -->
</div><!-- End Page-content -->
</div>
</div>

<?php
    include 'footer.php';
?>