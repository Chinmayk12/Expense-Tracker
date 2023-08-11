<?php
include 'header.php';
if(!isset($_SESSION['user']))
{
    echo "<script>window.location='index.php'</script>";
    exit;
}
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

<?php 
$userCategories = $database->select('categories', 'category_name', ['parent_id' => 0 , 'user_id' => $user['id']]);

$categoryId = $_GET['category'];
$parentId =  $_GET['update'];

$catData = $database->select('categories', 'category_name', [
    'category_id' => $parentId ,'user_id' => $user['id']]);

    $catName = $catData[0];


    
$subcat = $database->select('categories', 'category_name', [
    'parent_id' => $parentId ,'user_id' => $user['id'],'category_id'=> $categoryId]);

    $subcatName = $subcat[0];

      
$subcatIddata = $database->select('categories', 'category_id', [
    'parent_id' => $parentId ,'user_id' => $user['id'],'category_id'=> $categoryId]);

    $subcatId = $subcatIddata[0];

?>
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
                        <h5>UPDATE SUBCATEGORY </h5>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="category">Category</label>
                                    <select class="form-control form-select" id="category" name="update_category"
                                        required="">
                                        <option value="<?php echo $catName ?>"><?php echo $catName ?>
                                        </option>
                                        <?php foreach ($userCategories as $userCategory)
                                        {
                                            if ($userCategory !== $catName) 
                                            { // Check if the current value is not equal to $catName
                                        ?>
                                        <option value="<?php echo $userCategory; ?>"><?php echo $userCategory; ?>
                                        </option>
                                        <?php
                                            }
                                        } ?>
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group ">
                                    <label for="first-name"> Subcategory </label>
                                    <input type="text" value="<?php echo $subcatName ?>" class="form-control"
                                        id="subcategory" name="update_subcategory" required>
                                    <br>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <input type="submit" value="Update Subcategory" name='sub' class="btn btn-primary mt-4">
                                <input type="button" value="Cancel" class="btn btn-danger mt-4"
                                    onclick="redirectToSubCategory()">
                            </div>
                            <script>
                            function redirectToSubCategory() {
                                // Redirect to "add-group.php" when the Cancel button is clicked
                                window.location.href = "add-subcategory.php";
                            }
                            </script>
                        </div>
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
        if (isset($_POST['sub'])) {
            $id = $_GET['update'];
            $val1 = $_POST['update_subcategory'];
            $val2 = $_POST['update_category'];
            // echo "<script>alert('$val2')</script>";

                        
            $categoryData = $database->select('categories', 'category_id', [
                'category_name' => $val2 ,'user_id' => $user['id']]);

                if (!empty($categoryData)) {
                    $categoryId = $categoryData[0];
                    // echo "<script>alert('$categoryId')</script>";
                }
           
                $insertResult1 = $database->update('categories', ['category_name' => $val1, 'parent_id' => $categoryId], [
                    'category_id' => $subcatId,
                    'user_id' => $user['id']
                ]);
                        if ($insertResult1) {
                        echo "<script>alert('Subcategory Updated Successfully')</script>";
                        echo "<script>window.location='add-subcategory.php'</script>";
                    } else {
                        echo "Record Not Inserted<br>";
                        echo "Error: " . $database->error()[2];
                    }

        }
        
        
        ?>
</div>




<!--end row gy-3-->



<!--end col-->

<!--end row gy-3-->


</div> <!-- container-fluid -->

</div><!-- End Page-content -->
</div>
</div>
<?php

include 'footer.php';
?>