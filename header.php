<?php
    include 'header-data.php';
    // echo "<script>alert('$photo')</script>";
    // echo "<script>alert('$name')</script>";
?>

<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none">


<!-- Mirrored from themesbrand.com/velzon/html/default/forms-layouts.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 01 Jul 2022 06:36:30 GMT -->

<head>

    <meta charset="utf-8" />
    <title>Expense Tracker</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/softanic.png">

    <!-- Layout config Js -->
    <script src="assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="assets/css/custom.min.css" rel="stylesheet" type="text/css" />

</head>

<body>
    <!-- Begin page -->
    <div id="layout-wrapper">
        <header id="page-topbar">
            <div class="layout-width">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box horizontal-logo">
                            <a href="home.php" class="logo logo-light mt-5">
                                <span class="logo-sm">
                                    <img src="assets/images/softanic.png" alt="" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/softanic.png" alt="" height="17">
                                </span>
                            </a>
                        </div>

                        <button type="button"
                            class="btn btn-sm px-3 fs-16 header-item vertical-menu-btn topnav-hamburger"
                            id="topnav-hamburger-icon">
                            <span class="hamburger-icon">
                                <span></span>
                                <span></span>
                                <span></span>
                            </span>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-md-block">
                            <div class="position-relative">
                                <input type="text" class="form-control" id="searchInput1" placeholder="Search..."
                                    autocomplete="off" id="search-options" value="">
                                <span class="mdi mdi-magnify search-widget-icon"></span>
                                <span class="mdi mdi-close-circle search-widget-icon search-widget-icon-close d-none"
                                    id="search-close-options"></span>
                                <button type="button" id="searchButton1"
                                    class="btn btn-primary waves-effect waves-light visually-hidden">Search</button>
                            </div>
                        </form>
                    </div>

                    <div class="d-flex align-items-center">

                        <div class="dropdown d-md-none topbar-head-dropdown header-item">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                id="page-header-search-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                <i class="bx bx-search fs-22"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
                                <form class="p-3">
                                    <div class="form-group m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ..."
                                                aria-label="Recipient's username">
                                            <button class="btn btn-primary" type="submit"><i
                                                    class="mdi mdi-magnify"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button" class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle"
                                data-toggle="fullscreen">
                                <i class='bx bx-fullscreen fs-22'></i>
                            </button>
                        </div>


                        <div class="ms-1 header-item d-none d-sm-flex">
                            <button type="button"
                                class="btn btn-icon btn-topbar btn-ghost-secondary rounded-circle light-dark-mode">
                                <i class='bx bx-moon fs-22'></i>
                            </button>
                        </div>

                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="<?php echo $photo?>"
                                        alt="Image Not Found">
                                    <span class="text-start ms-xl-2">
                                        <span
                                            class="d-none d-xl-inline-block ms-1 fw-medium user-name-text"><?php echo $name;?>
                                        </span>
                                    </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">Welcome <?php echo $name;?>!</h6>
                                <a class="dropdown-item" href="user-profile.php"><i
                                        class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle">Profile</span></a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item"><i
                                        class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle">Total Expenses : <b>
                                            <?php
                                                // $totalexpense = $database->sum('expenses', 'amount');
                                                // echo $totalexpense;
                                                //$totalexpense = $database->sum('expenses', 'amount', ['user_id' => $user['id']]);       
                                                
                                                $currentMonth = date('m');
                                                $currentYear = date('Y');

                                                $startMonth = $currentMonth; // June
                                                $startYear = $currentYear;

                                                $endMonth = $currentMonth; // September
                                                $endYear =  $currentYear;

                                                // Step 2: Construct the start and end dates for the date range
                                                $startDate = $startYear . '-' . str_pad($startMonth, 2, '0', STR_PAD_LEFT) . '-01';
                                                $endDate = $endYear . '-' . str_pad($endMonth, 2, '0', STR_PAD_LEFT) . '-31';

                                                $totalexpense = $database->sum('expenses', 'amount', [
                                                    'date[<>]' => [$startDate, $endDate],
                                                    'user_id' => $user['id']
                                                ]);
                                                if($totalexpense>0)
                                                {
                                                    echo $totalexpense;
                                                }
                                                else
                                                {
                                                    echo "0";
                                                }
                                            ?></b></span></a>
                                <a class="dropdown-item"><i
                                        class="mdi mdi-wallet text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle">Total Income: <b>
                                            <?php
                                                // $totalincome = $database->sum('income', 'amount');
                                                // echo $totalincome;
                                                //$totalincome = $database->sum('income', 'amount', ['user_id' => $user['id']]);       
                                                
                                                $currentMonth = date('m');
                                                $currentYear = date('Y');

                                                $startMonth = $currentMonth; // June
                                                $startYear = $currentYear;

                                                $endMonth = $currentMonth; // September
                                                $endYear =  $currentYear;

                                                // Step 2: Construct the start and end dates for the date range
                                                $startDate = $startYear . '-' . str_pad($startMonth, 2, '0', STR_PAD_LEFT) . '-01';
                                                $endDate = $endYear . '-' . str_pad($endMonth, 2, '0', STR_PAD_LEFT) . '-31';

                                                $totalincome = $database->sum('income', 'amount', [
                                                    'date[<>]' => [$startDate, $endDate],
                                                    'user_id' => $user['id']
                                                ]);

                                                if($totalincome>0)
                                                {
                                                    echo $totalincome;
                                                }
                                                else
                                                {
                                                    echo "0";
                                                }
                                            ?></b></span></a>
                                <a class="dropdown-item" href="logout.php?logout=1"><i
                                        class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle" data-key="t-logout">Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box d-flex justify-content-center mt-2">
                <a href="home.php" class="logo logo-light mt-5">
                    <span class="logo-lg mt-5">
                        <a href='home.php'><img src="assets/images/softanic_home.jpeg" alt="" height="50"></a>
                    </span>
                </a>
            </div>
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="home.php" class="logo logo-dark mt-5">
                    <span class="logo-lg">
                        <img src="assets/images/logo-dark.png" alt="" height="17">
                    </span>
                </a>
                <!-- Light Logo-->

                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
                    id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarMaps1" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarMaps">
                                <i class="ri-honour-line"></i> <span data-key="t-maps">Master</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarMaps1">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="add-group.php" class="nav-link" data-key="t-google">
                                            Add Group

                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="add-category.php" class="nav-link" data-key="t-vector">
                                            Add Category
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <a href="add-subcategory.php" class="nav-link" data-key="t-vector">
                                            Add Subcategory
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarMaps2" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarMaps">
                                <i class="ri-honour-line"></i> <span data-key="t-maps">Banks</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarMaps2">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="add-bank-details.php" class="nav-link" data-key="t-google">
                                            Add Bank Details
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarMaps3" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarMaps">
                                <i class="ri-honour-line"></i> <span data-key="t-maps">Add Account</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarMaps3">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="add-account-details.php" class="nav-link" data-key="t-google">
                                            Account Details
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarMaps4" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarMaps">
                                <i class="ri-honour-line"></i> <span data-key="t-maps">Add Expenses/Income</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarMaps4">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="add-expense.php" class="nav-link" data-key="t-google">
                                            Add Expenses
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="add-income.php" class="nav-link" data-key="t-vector">
                                            Add Income
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarMaps5" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarMaps">
                                <i class="ri-honour-line"></i> <span data-key="t-maps">View Records</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarMaps5">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="expense-records.php" class="nav-link" data-key="t-google">
                                            View Expenses
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="income-records.php" class="nav-link" data-key="t-vector">
                                            View Incomes
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link menu-link" href="#sidebarMaps6" data-bs-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="sidebarMaps">
                                <i class="ri-honour-line"></i> <span data-key="t-maps">View Reports</span>
                            </a>
                            <div class="collapse menu-dropdown" id="sidebarMaps6">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="expense-report.php" class="nav-link" data-key="t-google">
                                            View Expenses Report
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="income-report.php" class="nav-link" data-key="t-vector">
                                            View Income Report
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </li>



                    </ul>
                </div>
                <!-- Sidebar -->
            </div>

        </div>
    </div>
</body>