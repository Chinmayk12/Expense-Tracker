<?php
    include 'header.php';
    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
	    exit;
    }
    
    $user_id = $user['id'];
    
    $userdetails = $database->select('users', '*', [
        'AND' => [
            'mobile' => $_SESSION['mobile'],
            'id' => $user_id
        ]
    ]);
    
?>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Other head content -->
</head>

<head>
    <style>
    body {
        margin: 0;
        padding: 0;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #f0f0f0;
    }

    .image-gallery {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;

    }

    .image-wrapper {
        margin: 10px;
    }

    .image {
        max-width: 200px;
        cursor: pointer;
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
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    /* Add a class to the footer container to position it at the bottom */
    .footer{
        position: absolute;
        bottom: 0;
        padding: 10px;
    }
    </style>
</head>

<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->

<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="text-center">
                                <div class="profile-user position-relative d-inline-block mx-auto  mb-4">
                                    <img src="<?php echo $userdetails[0]['photo']?>"
                                        class="rounded-circle avatar-xl img-thumbnail user-profile-image image"
                                        alt="user-profile-image"
                                        onclick="showFullScreen('<?php echo $userdetails[0]['photo']?>')">
                                </div>
                                <h5 class="fs-16 mb-1"><?php echo $userdetails[0]['name']; ?></h5>
                                <div class="image-gallery">
                                </div>
                                <div id="fullscreen-overlay" onclick="hideFullScreen()">
                                    <img id="fullscreen-image">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end card-->
                </div>
                <div class="col-xxl-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                        <i class="fas fa-home"></i> Personal Details
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="card-body p-4">
                            <div class="tab-content">
                                <div class="tab-pane active" id="personalDetails" role="tabpanel">
                                    <form action="update-user-profile.php" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="">
                                                    <label for="firstnameInput" class="form-label">Name</label>
                                                    <input type="text" class="form-control" id="firstnameInput"
                                                        name="fname" placeholder="Enter your firstname"
                                                        value="<?php echo $userdetails[0]['name']; ?>" required>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mt-1">
                                                    <label for="phonenumberInput" class="form-label">Phone
                                                        Number</label>
                                                    <input type="text" class="form-control" id="phonenumberInput"
                                                        name="mobileno" value="<?php echo $userdetails[0]['mobile']; ?>"
                                                        placeholder="Enter your phone number" required>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            <div class="col-lg-6">
                                                <div class="mt-1">
                                                    <label for="emailInput" class="form-label">Email Address</label>
                                                    <input type="email" class="form-control" id="emailInput"
                                                        name="email" value="<?php echo $userdetails[0]['email']; ?>"
                                                        placeholder="Enter your email" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="mt-1">
                                                    <label for="image" class="form-label">Update Profile Photo</label>
                                                    <input type="file" name="photo" class="form-control" id="photo">
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="hstack gap-2 mt-2">
                                                    <button type="submit" class="btn btn-primary">Update
                                                        Profile</button>
                                                </div>
                                            </div>
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
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
</div>
<?php
include 'footer.php';
?>