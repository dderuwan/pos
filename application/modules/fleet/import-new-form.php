<?php include 'layouts/session.php';
?>
<?php include 'layouts/head-main.php'; ?>
<html>

<head>

    <title>
        <?php echo $language["Dashboard"]; ?> New Shaheen LLC - Admin & Dashboard
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
                            <div class="card card-h-100" onClick="(navigateToModal1())"
                                style="cursor: pointer; transition: box-shadow 0.3s ease;">
                                <div class="card-body"
                                    style="transition: box-shadow 0.3s ease; border: 3px solid #673AB7; border-radius: 10px;"
                                    onmouseover="this.style.boxShadow='0 0 16px 0 #673AB7';"
                                    onmouseout="this.style.boxShadow='0 0 8px 0 rgba(0,0,0,0.2)';">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1"
                                            style="display: flex; justify-content: space-between; align-items: center;">
                                            <span
                                                style="font-weight: 600; text-align: center; margin-right: 10px;">MANIFEST</span>
                                            <div
                                                style="height:40px;width:40px;border-radius: 10px ;background-color:#673AB7;display: flex; justify-content: center; align-items: center;">
                                                <i data-feather="file-plus" style="color: white;"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- First set of elements -->
                        <div class="col-xl-3 col-md-6" style="">
                            <div class="card card-h-100" onClick="(navigateToModal2())"
                                style="cursor: pointer; transition: box-shadow 0.3s ease;">
                                <div class="card-body"
                                    style="transition: box-shadow 0.3s ease; border: 3px solid #FFC107; border-radius: 10px;"
                                    onmouseover="this.style.boxShadow='0 0 16px 0 #FFC107';"
                                    onmouseout="this.style.boxShadow='0 0 8px 0 rgba(0,0,0,0.2)';">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-grow-1"
                                            style="display: flex; justify-content: space-between; align-items: center;">
                                            <span
                                                style="font-weight: 600; text-align: center; margin-right: 10px;">DELIVERY
                                                ORDER</span>
                                            <div
                                                style="height:40px;width:40px;border-radius: 10px ;background-color:#FFC107;display: flex; justify-content: center; align-items: center;">
                                                <i data-feather="file-plus" style="color: white;"></i>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>





                    </div>


                </div>





                <script>
                    function openModal(modalId) {
                        // // Hide all modals
                        // $('.modal').modal('hide');

                        // // Show the selected modal
                        // $('#' + modalId).modal('show');
                        // console.log('Opening modal with ID: ' + modalId);
                        // Load content using AJAX when modal is shown
                        // if (modalId === 'manifestModal') {
                        //     $.get('forms-models/menifest.php', function(data) {
                        //         $('#manifestModalContent').html(data);
                        //         console.log('AJAX request to menifest.php completed.');
                        //         console.log('Response data:', data);
                        //     });
                        // } else if (modalId === 'deliveryOrderModal') {
                        //     $.get('forms-models/delivery_order.php', function(data) {
                        //         $('#deliveryOrderModalContent').html(data);
                        //     });
                        // }
                    }

                    function navigateToModal1() {
                        // Change the page location to commercialInvoiceModal.php
                        window.location.href = 'menifest_invoice.php';
                    }
                    function navigateToModal2() {
                        // Change the page location to commercialInvoiceModal.php
                        window.location.href = 'delivery_order_invoice.php';
                    }
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

<?php include 'layouts/vendor-scripts.php'; ?>
<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- Plugins js-->
<script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
<!-- dashboard init -->
<script src="assets/js/pages/dashboard.init.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js"
    integrity="sha512-Fd3EQng6gZYBGzHbKd52pV76dXZZravPY7lxfg01nPx5mdekqS8kX4o1NfTtWiHqQyKhEGaReSf4BrtfKc+D5w=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="printThis.js"></script>
<script src="custom.js"></script>
<script src="printThis.js"></script>

</body>

</html>