<?php
    include 'header.php';
    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
        exit;
    }
    
    $categories = $database->select('categories', '*',['parent_id'=>0 , 'user_id' => $user['id']]);
    $count = 0;
?>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

<div class="vertical-overlay"></div>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<head>
    <style>
        .main-content {
        min-height: 100vh; /* Ensure a minimum height of 100% of the viewport height for the main content */
    }
    </style>
</head>
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <form action="add-category-save.php" method="POST" class="needs-validation" enctype="multipart/form-data">

        </div>

        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-header">
                        <h5>CREATE CATEGORY</h5>
                    </div>
                    <div class="card-body">
                        <div class="row gy-3">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <!-- <label for="first-name"> Enter Category :</label> -->
                                    <input type="text" class="form-control" id="category" name="category" required>
                                    <br>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <input type="submit" value="Add Category" name='sub' class="btn btn-primary mb-4">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!--end row gy-3-->
        <div class="card">
            <div class="card-body">

                <form class="app-search d-none d-md-block">
                    <div class="position-relative" style="width: 300px; border: 1px solid #ccc; border-radius: 5px;">
                        <input type="text" class="form-control" placeholder="Search..." autocomplete="off"
                            id="searchInput" value="">
                        <span class="mdi mdi-magnify search-widget-icon"></span>
                        <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                            id="search-close-options"></span>

                        <button type="button" id="searchButton"
                            class="btn btn-primary waves-effect waves-light visually-hidden">Search</button>

                    </div>
                    <!-- <button id="searchButton">Search</button> -->
                    <!-- Base Buttons -->
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
                <!-- <p class="text-muted">Use <code>table</code> class to show bootstrap-based default table.</p> -->
                <div class="live-preview">
                    <div class="table-responsive">
                        <div id="searchResults"></div>
                        <script>
                        var gcsb = 'Categories';
                        </script>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js">
                        </script>
                        <table id="myTable" class="table table-bordered table-nowrap ">
                            <thead style="background-color:  #405189;">
                                <tr style="color: white">
                                    <th scope="col">Sr.No</th>
                                    <th scope="col">Categories</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>

                            <?php
                                $usersCount = count($categories);
                                for ($i = 0; $i <$usersCount; $i++) {
                                    $user_category = $categories[$i];
                            ?>


                            <tr>
                                <td><?php echo $count+=1 ?></td>
                                <td><?php echo $user_category['category_name']; ?></td>
                                <td>
                                    <a class="btn btn-success waves-effect waves-light"
                                        href="update-category.php?update=<?php echo $user_category['category_id'] ;?>">Update</a>


                                    <a class="btn btn-danger waves-effect waves-light" id="custom-sa-warning" href="#"
                                        onclick="showDeleteConfirmation('<?php echo $user_category['category_id']; ?>')">Delete</a>

                                </td>
                            </tr>
                            <?php } ?>

                            <?php              
                                if (isset($_GET['delete']))
                                {
                                    $categoryId = $_GET['delete'];

                                    //$database->delete('categories', ['category_id' => $categoryId]);

                                    // Add the conditions for category_id and user_id using the where method
                                    $condition = [
                                        'category_id' => $categoryId,
                                        'user_id' => $user['id']
                                    ];

                                    // Delete the record from the categories table if the specified category_id and user_id match
                                    $deleteResult = $database->delete('categories', $condition);
                                    echo '<script>window.location.href = "add-category.php";</script>';
                                    exit();
                                    
                                }
                            ?>


                            <link rel="stylesheet"
                                href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
                            <script>
                            function showDeleteConfirmation(groupId) {
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: 'You will not be able to recover this Category!',
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
                        </table>
                    </div>
                </div>

                <div class="d-none code-view">
                </div>
            </div><!-- end card-body -->
        </div>

        <!--end col-->
    </div>

    <!--end row gy-3-->


</div> <!-- container-fluid -->

</div><!-- End Page-content -->
</div>
</div>

<script>
function search()
{
    var query = document.getElementById('searchInput').value.toLowerCase();
    var table = document.getElementById('myTable');
    var rows = table.getElementsByTagName('tr');
    var resultsContainer = document.getElementById('searchResults');

    // Clear previous results
    resultsContainer.innerHTML = '';

    var matchingRows = [];

    // Loop through all rows and find the matching ones
    for (var i = 0; i < rows.length; i++) {
        var rowData = rows[i].getElementsByTagName('td');
        var match = false;
        for (var j = 0; j < rowData.length; j++) {
            if (rowData[j].textContent.toLowerCase().indexOf(query) > -1) {
                match = true;
                break;
            }
        }
        if (match) {
            matchingRows.push(rows[i].cloneNode(true)); // Clone the matching row
        }
    }

    // Display the matching rows in the results container
    if (matchingRows.length > 0) {
        var resultTable = document.createElement('table');
        resultTable.id = 'searchResultTable';
        resultTable.className = 'table table-bordered table-nowrap';

        var thead = document.createElement('thead');
        thead.style.backgroundColor = '#405189';
        var headerRow = document.createElement('tr');
        var th1 = document.createElement('th');
        th1.textContent = 'Sr.No';
        th1.style.color = 'white';
        var th2 = document.createElement('th');
        th2.textContent = 'Category';
        th2.style.color = 'white';
        var th3 = document.createElement('th');
        th3.textContent = 'Action';
        th3.style.color = 'white';

        headerRow.appendChild(th1);
        headerRow.appendChild(th2);
        headerRow.appendChild(th3);

        thead.appendChild(headerRow);
        resultTable.appendChild(thead);

        var tbody = document.createElement('tbody');
        for (var k = 0; k < matchingRows.length; k++) {
            tbody.appendChild(matchingRows[k]);
        }
        resultTable.appendChild(tbody);

        resultsContainer.appendChild(resultTable);
        resultsContainer.style.display = 'block'; // Show the search results container
        table.style.display = 'none'; // Hide the main table
    } else {
        resultsContainer.textContent = 'No matching results found.';
        //resultsContainer.style.display = 'none'; // Hide the search results container
        //table.style.display = 'block'; // Show the main table
    }
}

document.getElementById('searchButton').addEventListener('click', search);

document.getElementById('searchInput').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        search();
    }
});
</script>
<?php

include 'footer.php';
?>