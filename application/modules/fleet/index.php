<?php
// Include necessary files and database connection
require_once "layouts/config.php";
include 'layouts/session.php';
include 'layouts/head-main.php';

// Fetch data from the first table (invoice_commercial)
$queryInvoiceCommercial = "SELECT * FROM invoice_commercial";
$resultInvoiceCommercial = mysqli_query($link, $queryInvoiceCommercial);

// Get the total row count for the first table
$rowCountInvoiceCommercial = mysqli_num_rows($resultInvoiceCommercial);

// Fetch data from the second table (manifest_invoice)
$queryManifestInvoice = "SELECT * FROM manifest_invoice";
$resultManifestInvoice = mysqli_query($link, $queryManifestInvoice);

// Get the total row count for the second table
$rowCountManifestInvoice = mysqli_num_rows($resultManifestInvoice);

$querycustomers = "SELECT * FROM customers";
$resultcustomers = mysqli_query($link, $querycustomers);

// Get the total row count for the second table
$rowCountcustomers = mysqli_num_rows($resultcustomers);
?>



<head>

    <title>
        <?php echo $language["Dashboard"]; ?> | New Shaheen LLC - Admin & Dashboard
    </title>

    <?php include 'layouts/head.php'; ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
        integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"
        type="text/css" />
    <?php include 'layouts/head-style.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>




    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Titillium+Web:400,600,700" rel="stylesheet" />

    <link rel="stylesheet" href="assets/styles.css" />
</head>

<?php include 'layouts/body.php'; ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?php include 'layouts/menu.php'; ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <?php
                $maintitle = "Dashboard";
                $title = "Welcome !";
                ?>
                <?php include 'layouts/breadcrumb.php'; ?>
                <!-- end page title -->

                <script>
                    // Parse the JSON data
                    var totalAmountData = <?php echo $totalAmountJson; ?>;

                    // Access the total amount
                    var totalAmount = totalAmountData.totalAmount;

                    // Initialize your charts here using the configuration from chart-configuration.js
                    new ApexCharts(document.querySelector("#spark1"), spark1).render();
                    // Initialize other charts if needed
                </script>

                <!-- <div class="col-lg-12">
       
          <div class="main">
            <div class="row sparkboxes mt-4 mb-4">
              <div class="col-md-4">
                <div class="box box1">
                  <div id="spark1"></div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box box2">
                  <div id="spark2"></div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="box box3">
                  <div id="spark3"></div>
                </div>
              </div>
            </div>

            <div class="row mt-3 mb-3">
              <div class="col-md-6">
                <div class="box">
                  <div id="bar"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="box">
                  <div id="donut"></div>
                </div>
              </div>
            </div>

            <div class="row mt-3 mb-3">
              <div class="col-md-6">
                <div class="box">
                  <div id="area"></div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="box">
                  <div id="line"></div>
                </div>
              </div>
            </div>
          </div>
        </div> -->
                <div>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Export</span>
                                            <h4 class="mb-3">
                                                <span>
                                                    <?php echo $rowCountInvoiceCommercial; ?>
                                                </span>
                                            </h4>
                                        </div>
                                        <div class="icon-container">
                                            <img src="assets/images/export.png" width="60px" alt="">
                                            <!-- Replace with the icon you want to use -->
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Total Import</span>
                                            <h4 class="mb-3">
                                                <span>
                                                    <?php echo $rowCountManifestInvoice; ?>
                                                </span></span>
                                            </h4>
                                        </div>
                                        <div class="icon-container">
                                            <img src="assets/images/import.png" width="60px" alt="">
                                            <!-- Replace with the icon you want to use -->
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Gross Profit</span>
                                            <h4 class="mb-3">
                                                <span>250.000 OMR</span></span>
                                            </h4>
                                        </div>
                                        <div class="icon-container">
                                            <img src="assets/images/gross-profit.png" width="60px" alt="">
                                            <!-- Replace with the icon you want to use -->
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->




                        <div class="col-xl-3 col-md-6">
                            <!-- card -->
                            <div class="card card-h-100">
                                <!-- card body -->
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1">
                                            <span class="text-muted mb-3 lh-1 d-block text-truncate">Totla Customer
                                                Count</span>
                                            <h4 class="mb-3">
                                                <span>
                                                    <?php echo $rowCountcustomers; ?>
                                                </span></span>
                                            </h4>
                                        </div>
                                        <div class="icon-container">
                                            <img src="assets/images/customer.png" width="60px" alt="">
                                            <!-- Replace with the icon you want to use -->
                                        </div>
                                    </div>
                                </div><!-- end card body -->
                            </div><!-- end card -->
                        </div><!-- end col -->
                    </div><!-- end row-->
                    <div class="row">
                        <div class="col-xl-8">
                            <!-- Business Overview -->
                            <div class="card" style="height: 530px;">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center mb-4">
                                        <h5 class="card-title me-2">Business Overview</h5>
                                    </div>
                                    <div>
                                        <div id="pie-business" style="height: 100%;"
                                            data-colors='["#1c84ee", "#33c38e"]' class="apex-charts"></div>
                                        <script>
                                            // Replace this with your actual data
                                            var customerCount = <?php echo $rowCountcustomers; ?>;
                                            var businessData = {
                                                series: [customerCount, 20], // Example data
                                                labels: ["Customer Count Air Freight", "Customer Count Sea Freight"], // Example labels
                                            };

                                            var optionsBusiness = {
                                                chart: {
                                                    type: 'pie',
                                                    height: '400px', // Set the height to 100% to fill the container
                                                },
                                                series: businessData.series,
                                                labels: businessData.labels,
                                                plotOptions: {
                                                    pie: {
                                                        dataLabels: {
                                                            style: {
                                                                colors: ['#ffff', '#ffff'], // Change text color for each label
                                                            },
                                                        },
                                                    },
                                                },
                                                colors: ['#ff7675', '#1abc9c', '#f1c40f']
                                            };

                                            var chartBusiness = new ApexCharts(document.querySelector("#pie-business"), optionsBusiness);
                                            chartBusiness.render();
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4">
                            <!-- Number of Business -->
                            <div class="card" style="height: 250px;">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center mb-4">
                                        <h5 class="card-title me-2">Number of Business</h5>
                                    </div>
                                    <div>
                                        <div id="mini-chart12" style="height: 100%;"
                                            data-colors='["#1c84ee", "#33c38e"]' class="apex-charts"></div>
                                        <script>
                                            // Get the row counts for export and import from PHP
                                            var exportCount = <?php echo $rowCountInvoiceCommercial; ?>;
                                            var importCount = <?php echo $rowCountManifestInvoice; ?>;

                                            // Create a pie chart using ApexCharts
                                            var options = {
                                                chart: {
                                                    type: 'donut',
                                                    height: '100%', // Set the height to 100% to fill the container
                                                },
                                                series: [exportCount, importCount],
                                                labels: ['Export', 'Import'],
                                                plotOptions: {
                                                    pie: {
                                                        dataLabels: {
                                                            style: {
                                                                colors: ['#ffff', '#ffff'], // Change text color for each label
                                                            },
                                                        },
                                                    },
                                                },
                                                colors: ['#ff7675', '#27ae60']
                                            };

                                            var chart = new ApexCharts(document.querySelector("#mini-chart12"), options);
                                            chart.render();
                                        </script>
                                    </div>
                                </div>
                            </div>

                            <!-- Revenue -->
                            <div class="card mt-4" style="height: 250px;">
                                <div class="card-body">
                                    <div class="d-flex flex-wrap align-items-center mb-4">
                                        <h5 class="card-title me-2">Revenue</h5>
                                    </div>
                                    <div>
                                        <div id="pie-rev" style="height: 100%;" data-colors='["#1c84ee", "#33c38e"]'
                                            class="apex-charts"></div>
                                        <script>
                                            // Get the row counts for export and import from PHP
                                            var exportCount1 = <?php echo $rowCountInvoiceCommercial; ?>;
                                            var importCount1 = <?php echo $rowCountManifestInvoice; ?>;

                                            // Create a pie chart for revenue using ApexCharts
                                            var optionsRev = {
                                                chart: {
                                                    type: 'donut',
                                                    height: '100%', // Set the height to 100% to fill the container
                                                },
                                                series: [exportCount1, importCount1],
                                                labels: ['Sea', 'Air'],
                                                colors: ['#0652DD', '#f39c12']
                                            };

                                            var chartRev = new ApexCharts(document.querySelector("#pie-rev"), optionsRev);
                                            chartRev.render();
                                        </script>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>
            </div>

        </div>

        <!-- end card body -->
    </div>
    <!-- end card -->

    <!-- end card body -->
</div>
<!-- end card -->




</div>





<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js">
</script>
<script src="../../../../dist/apexcharts.js"></script>
<script src="assets/data.js"></script>
<script src="assets/scripts.js"></script>

<script></script>


</div>
<!-- end col -->

<!-- end card -->
</div>
<!-- end col -->
</div><!-- end row -->

</div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

<?php include 'layouts/footer.php'; ?>
</div>
<!-- end main content-->

</div>
<!-- END layout-wrapper -->
<?php include 'layouts/right-sidebar.php'; ?>

<?php include 'layouts/vendor-scripts.php'; ?>
<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Plugins js-->
<script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
<!-- dashboard init -->
<script src="assets/js/pages/dashboard.init.js"></script>



</body>

</html>