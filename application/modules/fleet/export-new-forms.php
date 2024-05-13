<!-- <?php
// require_once "layouts/config.php";

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     // Establish database connection
//     // Include your database connection file

//     // Get BL No and Shipper's name from POST data
//     $blNo = $_POST['blNo'];
//     $shipperName = $_POST['shipperName'];
//     $consigneeName = $_POST['consigneeName'];

//     // Define the location
//     $location = "https://system.Flotillalogistics.com/assets/BILL OF LADING/$blNo.html";

//     // Prepare and execute SQL query to insert data
//     $query = "INSERT INTO invoice_commercial(bl_no,shippername,consignee_name,location) VALUES (?, ?, ?,?)";
//     $stmt = $link->prepare($query);
//     $stmt->bind_param("ssss", $blNo, $shipperName,$consigneeName,$location);

//     if ($stmt->execute()) {
//         echo '<script>alert("Invoice Saved Successfully")</script>';
//         echo "Data saved successfully.";
//         header("Location: export-list-forms.php");

//     } else {
//         echo '<script>alert("Invoice Save Error")</script>';
//         echo "Error saving data.";
//     }

//     // Close the database connection
//     $stmt->close();
//     $link->close();
// }
?> -->
<?php require_once "layouts/config.php"; ?>
<?php include 'layouts/session.php';
?>
<?php include 'layouts/head-main.php'; ?>
<html>

<head>

    <title>
        <?php echo $language["Dashboard"]; ?> | New Shaheen LLC  - Admin & Dashboard
    </title>

    <?php include 'layouts/head.php'; ?>
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"
        type="text/css" />
    <?php include 'layouts/head-style.php'; ?>

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
                $maintitle = "Export New Forms";
                $title = "";
                ?>
                <?php include 'layouts/breadcrumb.php'; ?>
                <!-- end page title -->

                <div class="col-lg-12">
                    <div class="row">
                        <!-- First set of elements -->
                        <div class="col-xl-3 col-md-6" style="">
                            <div class="card card-h-100" onclick="openModal('commercialInvoiceModal1')"
                                style="cursor: pointer; transition: box-shadow 0.3s ease;">
                                <div class="card-body"
                                    style="transition: box-shadow 0.3s ease; border: 3px solid #673AB7; border-radius: 10px;"
                                    onmouseover="this.style.boxShadow='0 0 16px 0 #673AB7';"
                                    onmouseout="this.style.boxShadow='0 0 8px 0 rgba(0,0,0,0.2)';">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1"
                                            style="display: flex; justify-content: space-between; align-items: center;">
                                            <span style="font-weight: 600; text-align: center; margin-right: 10px;">BILL
                                                OF LADING</span>
                                            <div
                                                style="height:40px;width:40px;border-radius: 10px ;background-color:#673AB7;display: flex; justify-content: center; align-items: center;">
                                                <i data-feather="file-plus" style="color: white;"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>



                        <!-- Second set of elements -->
                        <!--<div class="col-xl-3 col-md-6">-->
                        <!--    <div class="card card-h-100" onclick="navigateToModal()"-->
                        <!--        style="cursor: pointer; transition: box-shadow 0.3s ease;">-->
                        <!--        <div class="card-body"-->
                        <!--            style="transition: box-shadow 0.3s ease; border: 3px solid #FFC107 ; border-radius: 10px;"-->
                        <!--            onmouseover="this.style.boxShadow='0 0 16px 0 #FFC107';"-->

                        <!--            onmouseout="this.style.boxShadow='0 0 8px 0 rgba(0,0,0,0.2)';">-->
                        <!--            <div class="d-flex align-items-center">-->
                        <!--                <div class="flex-grow-1"  style="display: flex; justify-content: space-between; align-items: center;">-->
                        <!--                    <span class="" style="font-weight:600;text-align:center">SECOND OF-->
                        <!--                        LADING</span>-->
                        <!--                        <div style="height:40px;width:40px;border-radius: 10px ;background-color:#FFC107;display: flex; justify-content: center; align-items: center;">-->
                        <!--                        <i data-feather="file-plus"style="color: white;"></i>-->
                        <!--                        </div>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->



                    </div>


                </div>
                <!-- Modals -->
                <div class="modal fade" id="commercialInvoiceModal1">
                    <?php include 'forms-models/check-customer.php'; ?>

                </div>

                <script>
                    function openModal(modalId) {
                        // Hide all modals
                        $('.modal').modal('hide');

                        // Show the selected modal
                        $('#' + modalId).modal('show');
                    }

                    function navigateToModal() {
                        // Change the page location to commercialInvoiceModal.php
                        window.location.href = 'secondInvoiceModal.php';
                    }
                </script>
                </script>





            </div>
            <!-- end row-->


        </div>
        <!-- end row-->


    </div>
    <!-- end col -->





    <?php include 'layouts/footer.php'; ?>


</div>



<!-- END layout-wrapper -->

<?php include 'layouts/right-sidebar.php'; ?>


<script src="assets/libs/metismenu/metisMenu.min.js"></script>
<script src="assets/libs/simplebar/simplebar.min.js"></script>

<script src="assets/libs/feather-icons/feather.min.js"></script>
<!-- pace js -->
<script src="assets/libs/pace-js/pace.min.js"></script>

<script src="assets/js/app.js"></script>



<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Plugins js-->
<script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
<!-- dashboard init -->
<script src="assets/js/pages/dashboard.init.js"></script>


</body>

</html>