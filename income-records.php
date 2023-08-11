<?php
include 'header.php';

if(!isset($_SESSION['user']))
{
	echo "<script>window.location='index.php'</script>";
	exit;
}

//$incomes = $database->select('income', '*');
// $incomes = $database->select('income', '*', ['user_id' => $user['id']]);
$incomes = $database->select('income', '*', ['user_id' => $user['id'], 'ORDER' => ['date' => 'DESC','id' => 'DESC']]);
$count = count($incomes);
?>
<head>
    <style>
        .main-content {
        min-height: 100vh; /* Ensure a minimum height of 100% of the viewport height for the main content */
    }
    </style>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.18/dist/sweetalert2.all.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

<div class="vertical-overlay"></div>

<head>
    <style>
    .image-gallery {
        display: flex;
        flex-wrap: wrap;
    }

    .image {
        height: 70px;
        width: 100px;
    }

    #fullscreen-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.9);
        z-index: 9999;
        cursor: pointer;
    }

    #fullscreen-image {
        max-width: 90%;
        max-height: 90%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    </style>
</head>
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="main-content">

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="card">
                    <!-- Start Search -->
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
                                        <button type="button" id="mobileSearchButtonSubmit" class="btn btn-primary"><i
                                                class="mdi mdi-magnify"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- For screens medium and larger, use the original form -->
                    <form class="app-search d-none d-md-block">
                        <div class="row">
                            <div class="position-relative col-md-3">
                                <label>Search</label>
                                <input type="text" class="form-control" placeholder="Search..." autocomplete="off"
                                    id="desktopSearchInput" value="">
                                <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                                    id="search-close-options"></span>
                                <button type="button" id="desktopSearchButton"
                                    class="btn btn-primary waves-effect waves-light visually-hidden">Search</button>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="startDate">Start Date</label>
                                    <input type="date" class="form-control" id="startDate">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="endDate">End Date</label>
                                    <input type="date" class="form-control" id="endDate">
                                </div>
                            </div>
                            <div class="col-md-3 mt-4">
                                <button type="button" class="btn btn-primary" id="dateSearchButton">Search by
                                    Date</button>
                            </div>
                        </div>

                        <!-- Date Search Button -->

                        <div class="dropdown-menu dropdown-menu-lg" id="search-dropdown">
                            <div data-simplebar style="max-height: 320px;">
                                <div class="notification-list">
                                </div>
                            </div>
                            <div class="text-center pt-3 pb-1">
                                <a href="#" class="btn btn-primary btn-sm">View All Results
                                    <i class="ri-arrow-right-line ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </form>

                    <div class="d-md-none">
                        <!-- Container for mobile date search -->
                        <div class="container">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="mobileStartDate">Start Date</label>
                                        <input type="date" class="form-control" id="mobileStartDate">
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="mobileEndDate">End Date</label>
                                        <input type="date" class="form-control" id="mobileEndDate">
                                    </div>
                                </div>
                                <div class="col-12 mt-3 mb-1">
                                    <button type="button" class="btn btn-primary" id="mobileDateSearchButton">Search by
                                        Date</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                    // Function to handle date search logic for desktop view
                    function searchDesktopExpensesByDate() {
                        var startDate = document.getElementById("startDate").value;
                        var endDate = document.getElementById("endDate").value;

                        var cards = document.getElementsByClassName("expense-card");

                        for (var i = 0; i < cards.length; i++) {
                            var cardDate = cards[i].getAttribute("data-date");
                            if ((startDate === "" || cardDate >= startDate) && (endDate === "" || cardDate <=
                                    endDate)) {
                                cards[i].style.display = "";
                            } else {
                                cards[i].style.display = "none";
                            }
                        }
                    }

                    // Function to handle date search logic for mobile view
                    function searchMobileExpensesByDate() {
                        var startDate = document.getElementById("mobileStartDate").value;
                        var endDate = document.getElementById("mobileEndDate").value;

                        var cards = document.getElementsByClassName("expense-card");

                        for (var i = 0; i < cards.length; i++) {
                            var cardDate = cards[i].getAttribute("data-date");
                            if ((startDate === "" || cardDate >= startDate) && (endDate === "" || cardDate <=
                                    endDate)) {
                                cards[i].style.display = "";
                            } else {
                                cards[i].style.display = "none";
                            }
                        }
                    }

                    // Event listeners for date search buttons
                    $(document).ready(function() {
                        $("#dateSearchButton").on("click", searchDesktopExpensesByDate);
                        $("#mobileDateSearchButton").on("click", searchMobileExpensesByDate);
                    });
                    </script>

                    <!-- End Search -->
                </div>
                <div class="row align-items-center gy-10 mb-3">
                    <div class="col-sm">
                        <div>
                            <h5 class="fs-14 mb-0">Income Records</h5>
                        </div>
                    </div>
                </div>
                <?php
                if (!$count > 0)
                {
                    echo "<script>alert('No Records Founds Add Records!')</script>";
                    echo "<script>window.location='home.php'</script>";
                } else {
                    foreach ($incomes as $record) 
                    {
                ?>
                <div class="card product expense-card"
                    data-date="<?php echo date('Y-m-d', strtotime($record['date'])); ?>">
                    <div class="card-body">
                        <div class="row gy-4">
                            <div class="col-sm-auto">
                                <div class="avatar-lg bg-light rounded p-1">
                                    <div class="image-gallery">
                                        <div class="image-wrapper">
                                            <img src="<?php echo $record['receipt']; ?>"
                                                alt="Image Not Found Or Image Not Uploaded"
                                                class="img-fluid d-block image"
                                                onclick="showFullScreen('<?php echo $record['receipt']; ?>')">
                                        </div>
                                    </div>

                                    <div id="fullscreen-overlay" onclick="hideFullScreen()">
                                        <img id="fullscreen-image">
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <p class="mb-0">
                                        <span class="fw-medium">
                                            <?php echo date('d F Y', strtotime($record['date'])); ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm">
                                <h5 class="fs-14 text-truncate group-name">
                                    <a href="#" class="text-dark"><?php echo $record['group']; ?></a>
                                </h5>
                                <ul class="list-inline text-black">
                                    <li class="list-inline-item ">
                                        Details : <span class="fw-medium"><?php echo $record['details']; ?></span>
                                    </li>
                                    <br>
                                    <li class="list-inline-item">
                                        Payment Details: : <span
                                            class="fw-medium"><?php echo $record['payment_details']; ?></span>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-2">
                                <ul class="list-inline text-muted fs-14">
                                    <br>
                                    <li class="list-inline-item text-black">
                                        Mode : <span class="fw-medium text-black"><?php echo $record['mode']; ?></span>
                                    </li><br>
                                    <li class="list-inline-item text-black">
                                        Bank : <span class="fw-medium text-black"><?php echo $record['bank']; ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <!-- card body -->
                    <div class="card-footer">
                        <div class="row align-items-center gy-3">
                            <div class="col-sm">
                                <div class="d-flex flex-wrap my-n1">
                                    <div class>
                                        <a href="delete-income-record.php?id=<?php echo $record['id']; ?>"
                                            onclick="showDeleteConfirmation(<?php echo $record['id']; ?>); return false;"
                                            class="d-block text-body p-1 px-2 ">
                                            <i class="ri-delete-bin-fill text-muted align-bottom me-1"></i>
                                            Delete
                                        </a>
                                    </div>
                                    <div>
                                        <a href="update-income-record.php?id=<?php echo $record['id'];?>&date=<?php echo $record['date'];?>&mop=<?php echo $record['mode']; ?>"
                                            class="d-block text-body p-1 px-2"><i
                                                class="ri-pencil-fill text-muted align-bottom me-1"></i>
                                            Edit
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div class="d-flex align-items-center gap-2 text-muted">
                                    <div class="text-black">Amount :</div>
                                    <h5 class="fs-14 mb-0">
                                        &#8377;<span
                                            class="product-line-price text-black"><?php echo $record['amount']; ?></span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }   // End of foreach  loop
                }       // End of else part
                ?>
            </div>
            <!--end row gy-3-->
        </div> <!-- container-fluid -->
    </div><!-- End Page-content -->
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function showDeleteConfirmation(groupId) {
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this Income Record!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        iconHtml: '<i class="fas fa-trash-alt"></i>'
    }).then((result) => {
        if (result.isConfirmed) {
            // If the user clicks "Yes, delete it!", manually trigger the link's click event
            const deleteLink = document.createElement('a');
            deleteLink.href = `delete-income-record.php?id=${groupId}`;
            deleteLink.click();
        }
    });
}

function showFullScreen(imageUrl) {
    const fullscreenOverlay = document.getElementById('fullscreen-overlay');
    const fullscreenImage = document.getElementById('fullscreen-image');

    fullscreenImage.setAttribute('src', imageUrl);
    fullscreenOverlay.style.display = 'block';
}

function hideFullScreen() {
    const fullscreenOverlay = document.getElementById('fullscreen-overlay');
    fullscreenOverlay.style.display = 'none';
}
</script>
<script>
// Function to handle search logic for desktop search input
function searchDesktopExpenses() {
    var input, filter, cards, i, txtValue;
    input = document.getElementById("desktopSearchInput");
    filter = input.value.toUpperCase();
    cards = document.getElementsByClassName("expense-card");

    for (i = 0; i < cards.length; i++) {
        var textElements = cards[i].querySelectorAll(
            '.text-black, .group-name, .record-date'); // Include .group-name and .record-date classes for search

        var foundMatch = false;
        for (var j = 0; j < textElements.length; j++) {
            txtValue = textElements[j].textContent || textElements[j].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                foundMatch = true;
                break;
            }
        }

        if (foundMatch) {
            cards[i].style.display = ""; // Show the card if a match is found
        } else {
            cards[i].style.display = "none"; // Hide the card if no match is found
        }
    }
}

// Function to handle search logic for mobile search input
function searchMobileExpenses() {
    var input, filter, cards, i, txtValue;
    input = document.getElementById("mobileSearchInput");
    filter = input.value.toUpperCase();
    cards = document.getElementsByClassName("expense-card");

    for (i = 0; i < cards.length; i++) {
        var textElements = cards[i].querySelectorAll(
            '.text-black, .group-name, .record-date'); // Include .group-name and .record-date classes for search

        var foundMatch = false;
        for (var j = 0; j < textElements.length; j++) {
            txtValue = textElements[j].textContent || textElements[j].innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                foundMatch = true;
                break;
            }
        }

        if (foundMatch) {
            cards[i].style.display = ""; // Show the card if a match is found
        } else {
            cards[i].style.display = "none"; // Hide the card if no match is found
        }
    }
}

// Event listeners for desktop and mobile search inputs
$(document).ready(function() {
    $("#desktopSearchInput").on("keyup", searchDesktopExpenses);
    $("#mobileSearchInput").on("keyup", searchMobileExpenses);
});
</script>
</div>
<?php

include 'footer.php';
?>