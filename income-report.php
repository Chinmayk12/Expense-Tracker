<?php
    include 'header.php';
    if(!isset($_SESSION['user']))
    {
        echo "<script>window.location='index.php'</script>";
        exit;
    }
    $username = $user['name'];
    // Get the current month name
    $currentMonth = date("F");
    $currentYear = date("Y");
?>
<html>
<head>
    <style>
        .main-content {
        min-height: 100vh; /* Ensure a minimum height of 100% of the viewport height for the main content */
    }
    </style>
</head>
<head>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <!-- Add Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
    /* Remove the default styling for the DataTables buttons */
    .dt-buttons {
        margin-bottom: 10px;
    }

    .dt-button {
        background-color: #007bff;
        /* Blue for all buttons */
        color: #fff;
        border: none;
        box-shadow: none;
        margin-right: 5px;
        /* Add some spacing between buttons */
        cursor: pointer;
        font-weight: bold;
    }

    /* Customize the colors for each button */
    .dt-button.buttons-csv {
        background-color: #17a2b8;
    }

    /* Cyan for CSV button */
    .dt-button.buttons-excel {
        background-color: #28a745;
    }

    /* Green for Excel button */
    .dt-button.buttons-pdf {
        background-color: #dc3545;
    }

    /* Red for PDF button */
    .dt-button.buttons-print {
        background-color: #6c757d;
    }

    /* Gray for Print button */

    /* Hover effect */
    .dt-button:hover {
        opacity: 0.8;
    }

    /* Remove border from DataTables table */
    .dataTables_wrapper .table {
        border: none;
    }
    </style>
</head>

<body>
    <div class="vertical-overlay"></div>
    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">
        <div class="page-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0">Income Report</h5>
                            </div>
                            <div class="card-body table-responsive" style="overflow-y: auto;">
                                <table id="tablerecord"
                                    class="table table-bordered dt-responsive responsive: true table-striped align-middle display nowrap"
                                    style="width:100%">

                                    <?php
                                        $income_report = $database->select('income', '*', ['user_id' => $user['id']]);
                                        $income_report_count = count($income_report);
                                    ?>
                                    <thead style="background-color:#405189; color:white;">
                                        <tr>
                                            <th>SR No.</th>
                                            <th>Date</th>
                                            <th>Group</th>
                                            <th>Mode</th>
                                            <th>Bank</th>
                                            <th>Amount</th>
                                            <th>Details</th>
                                            <th>Payment Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php
                                            if (!$income_report_count > 0) 
                                            {
                                                echo "<script>alert('No Reports Founds Add Records!')</script>";
                                                echo "<script>window.location='home.php'</script>";
                                            } else 
                                            {
                                                $count = 0;
                                                foreach ($income_report as $record)
                                                {
                                                    $count++;
                                            ?>
                                        <tr>
                                            <td><?php echo $count?></td>
                                            <td><?php echo date('d - F - Y', strtotime($record['date'])); ?></td>
                                            <td><?php echo $record['group'] ?></td>
                                            <td><?php echo $record['mode'] ?></td>
                                            <td><?php echo $record['bank'] ?></td>
                                            <td><?php echo $record['amount'] ?></td>
                                            <td><?php echo $record['details'] ?></td>
                                            <td><?php echo $record['payment_details'] ?></td>
                                        </tr>
                                        <?php
                                        }
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <div class="total-expense">
                                    <strong>Total Income: <span id="totalIncome"></span></strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <!-- Rest of the code remains the same -->

    <script>
    $(document).ready(function() 
    {
        var user = "<?php echo $username ?>";
        var month = "<?php echo $currentMonth ?>";
        var year = "<?php echo $currentYear ?>";
        function initDataTable() {
            table = $('#tablerecord').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'copy',
                        exportOptions: {
                            columns: ':visible'
                        },
                        buttonCss: 'btn btn-primary' // Custom CSS class for the Copy button
                    },
                    {
                        extend: 'csv',
                        exportOptions: {
                            columns: ':visible'
                        },
                        filename: user + '-' + month + '-' + year + '-income',
                        buttonCss: 'btn btn-info' // Custom CSS class for the CSV button
                    },
                    {
                        extend: 'excel',
                        exportOptions: {
                            columns: ':visible'
                        },
                        filename: user + '-' + month + '-' + year + '-income',
                        buttonCss: 'btn btn-success', // Custom CSS class for the Excel button
                    },
                    {
                        extend: 'pdf',
                        orientation: 'landscape', // Set landscape orientation
                        exportOptions: {
                            columns: ':visible'
                        },
                        filename: user + '-' + month + '-' + year + '-income',
                        buttonCss: 'btn btn-danger' // Custom CSS class for the PDF button
                    },
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: ':visible'
                        },
                        filename: user + '-' + month + '-' + year + '-income',
                        buttonCss: 'btn btn-secondary' // Custom CSS class for the Print button
                    }
                ],
                ordering: false,
                paging: false,
                lengthChange: false,
                language: {
                    info: false
                },
                infoCallback: function(settings, start, end, max, total, pre) {
                    return '';
                },
            });
        }

        // Calculate and display the overall record expense sum
        function updateTotalIncome() {
            var totalIncome = 0;
            table.rows({
                search: 'applied'
            }).every(function(index, element) {
                totalIncome += parseFloat(this.data()[5]);
            });
            $("#totalIncome").text(totalIncome.toFixed(2));
        }

        // Destroy any existing DataTable instance before initializing
        if ($.fn.DataTable.isDataTable('#tablerecord')) {
            $('#tablerecord').DataTable().destroy();
        }

        initDataTable(); // Initialize the DataTable

        updateTotalIncome(); // Initial calculation

        // Update the sum when the user searches or filters the table
        table.on('search.dt', function() {
            updateTotalIncome();
        });
    });
    </script>
</body>

</html>

<?php
include 'footer.php';
?>