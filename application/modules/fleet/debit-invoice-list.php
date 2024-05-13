<?php
// Include necessary files and database connection
require_once "layouts/config.php";
include 'layouts/session.php';
include 'layouts/head-main.php';

// Fetch data from the database (example)
$query = "SELECT * FROM debit_invoice";
$result = mysqli_query($link, $query);

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // Prepare DELETE query and execute it
    $deleteQuery = "DELETE FROM debit_invoice WHERE invoiceNum = '$deleteId'";
    if (mysqli_query($link, $deleteQuery)) {
        // Redirect back to the main page after successful deletion
        header("Location: debit-invoice-list.php");
        exit();
    } else {
        // Display an error message if deletion fails
        echo "Error deleting record: " . mysqli_error($link);
    }
}


?>



<head>

    <title>
        <?php echo $language["DataTables"]; ?> | New Shaheen LLC - Admin & Dashboard
    </title>

    <?php include 'layouts/head.php'; ?>
    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"
        type="text/css" />
    <?php include 'layouts/head-style.php'; ?>
    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
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
                $maintitle = "List";
                $title = "Debit List";
                ?>
                <?php include 'layouts/breadcrumb.php'; ?>
                <!-- end page title -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">

                                    </div>
                                    <div class="col-md-6 d-flex justify-content-md-end align-items-center">
                                        <a class="btn btn-sm btn-default btn-flat border-primaryy"
                                            style="border-color: #2ecc71;" href="./debit-invoice.php"><i
                                                class="fa fa-plus"></i> Add New</a>
                                    </div>
                                </div>
                                <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Invoice Number</th>
                                            <th>Customer Name</th>

                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $rowNumber = 1;
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            echo '<tr>';
                                            echo '<td>' . $rowNumber . '</td>';

                                            echo '<td>' . $row['invoiceNum'] . '</td>';
                                            echo '<td>' . $row['companyName'] . '</td>';
                                            echo '<td>
                                            <a href="#" class="btn btn-success btn-sm btn-view"
                                                    data-id="' . htmlspecialchars($row['invoiceNum']) . '">
                                                    <i class="fas fa-eye"></i> View
                                                </a>
                                            <a href="#" class="btn btn-sm btn-print" data-id="' . htmlspecialchars($row['invoiceNum']) . '"
                                             style="background-color:#3498db;color:white">
                                            <i class="fas fa-print"></i> Print
                                             </a>
                                                <a href="?delete_id=' . $row['invoiceNum'] . '" class="btn btn-danger btn-sm">
                                         <i class="fas fa-trash" ></i> Delete
                                            </a>
                                            </td>';
                                            echo '</tr>';
                                            $rowNumber++;
                                        }

                                        ?>
                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->



                <!-- Modal dialog structure -->
                <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-labelledby="viewModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 1030px;">
                        <div class="modal-content" style="max-width: 1030px;">
                            <div class="modal-header">

                                <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button> -->
                            </div>
                            <div class="modal-body" id="modalBody">
                                <!-- Content will be loaded here -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- JavaScript and jQuery libraries -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                <script>
                    $(document).ready(function () {
                        // Event handler for the View button click
                        $('.btn-view').on('click', function () {
                            var blNumber = $(this).data(
                                'id'); // Get the BL number from data-id attribute
                            var url =
                                'https://system.Flotillalogistics.com/assets/BILL OF DEBIT INVOCE/' +
                                encodeURIComponent(blNumber) + '.html';

                            // Load the HTML file into the modal using AJAX
                            $.get(url, function (data) {
                                $('#modalBody').html(
                                    data); // Load the data into the modal's body
                                $('#viewModal').modal('show'); // Show the modal
                            });
                        });
                        // Search functionality
                        $('#searchInput').on('keyup', function () {
                            var searchText = $(this).val().toLowerCase();
                            $('#list tbody tr').filter(function () {
                                $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -
                                    1);
                            });
                        });
                        // Event handler for the Print button click
                        $('.btn-print').on('click', function (event) {
                            event.preventDefault();
                            var blNumber = $(this).data('id');
                            var url =
                                'https://system.Flotillalogistics.com/assets/BILL OF DEBIT INVOCE/' +
                                encodeURIComponent(blNumber) + '.html';
                            $.get(url, function (data) {
                                var printWindow = window.open('', '_blank');
                                printWindow.document.write(data);
                                printWindow.document.close();
                                printWindow.print();
                            });
                        });
                    });
                </script>

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
<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Buttons examples -->
<script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
<script src="assets/libs/jszip/jszip.min.js"></script>
<script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
<script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- Datatable init js -->
<script src="assets/js/pages/datatables.init.js"></script>

</body>

</html>