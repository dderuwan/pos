<!DOCTYPE html>
<html lang="en">

<?php
// Include necessary files and database connection
require_once "layouts/config.php";
include 'layouts/session.php';
include 'layouts/head-main.php';

// Fetch data from the database (example)
$query = "SELECT * FROM invoice_commercial";
$result = mysqli_query($link, $query);

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // Prepare DELETE query and execute it
    $deleteQuery = "DELETE FROM invoice_commercial WHERE bl_no = '$deleteId'";
    if (mysqli_query($link, $deleteQuery)) {
        // Redirect back to the main page after successful deletion
        header("Location: export-list-forms.php");
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

    <?php include 'layouts/head-style.php'; ?>
</head>

<body>

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
                    $title = "System Setup";
                    ?>
                    <?php include 'layouts/breadcrumb.php'; ?>
                    <!-- end page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body ">
                                    <div class="row mb-3">
                                        <div class="col-md-6">

                                        </div>
                                        <div class="col-md-6 d-flex justify-content-md-end align-items-center">
                                            <!-- Button trigger modal for adding new entry -->
                                            <button class="btn btn-sm btn-default btn-flat border-primaryy"
                                                style="border-color: #2ecc71;" data-toggle="modal"
                                                data-target="#addModal"><i class="fa fa-plus"></i> Add
                                                New</button>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="card " style="">
                                                <div class="list-group list-group-flush" id="useradd-sidenav">
                                                    <!-- Different types of data -->
                                                    <a href="#" class="list-group-item list-group-item-action border-0"
                                                        onclick="showDetails('license')">License Type
                                                        <div class="float-end"><i class="ti ti-chevron-right"></i>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action border-0 "
                                                        onclick="showDetails('vehicle')">Vehicle Type
                                                        <div class="float-end"><i class="ti ti-chevron-right"></i>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action border-0 "
                                                        onclick="showDetails('fuel')">Fuel Type
                                                        <div class="float-end"><i class="ti ti-chevron-right"></i>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action border-0 "
                                                        onclick="showDetails('recurring')">Recurring
                                                        <div class="float-end"><i class="ti ti-chevron-right"></i>
                                                        </div>
                                                    </a>
                                                    <a href="#" class="list-group-item list-group-item-action border-0 "
                                                        onclick="showDetails('maintenance')">Maintenance Type
                                                        <div class="float-end"><i class="ti ti-chevron-right"></i>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="card">
                                                <div class="card-body table-border-style">
                                                    <div class="table-responsive" id="detailsTable">
                                                        <table class="table mb-0" id="dynamicTable">
                                                            <thead>
                                                                <tr>
                                                                    <th>Name</th>
                                                                    <th width="200px">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <!-- Table rows will be dynamically generated -->
                                                            </tbody>
                                                        </table>
                                                        <!-- Details will be loaded dynamically here -->

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <!-- Modal dialog structure for adding new entry -->
                    <div id="addModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel">Add New Entry</h4>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <!-- Your form for adding new entry goes here -->
                                    <form>
                                        <div class="mb-3">
                                            <label for="entryName" class="form-label">Entry Name</label>
                                            <input type="text" class="form-control" id="entryName" name="entryName">
                                        </div>
                                        <!-- Add other necessary input fields for your form -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </form>
                                </div>


                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->

                    <!-- JavaScript and jQuery libraries -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                    <script>
                        function showDetails(type) {
                            // You can load data dynamically based on the type here
                            // For demonstration purpose, let's just show a simple message
                            var message = "";
                            switch (type) {
                                case "license":
                                    // Fetch license data and populate table
                                    message = "<tr><td>License Name</td><td>Action</td></tr>";
                                    break;
                                case "vehicle":
                                    // Fetch vehicle data and populate table
                                    message = "<tr><td>Vehicle Name</td><td>Action</td></tr>";
                                    break;
                                case "fuel":
                                    // Fetch fuel data and populate table
                                    message = "<tr><td>Fuel Type Name</td><td><td>Action</td></td></tr>";
                                    break;
                                case "recurring":
                                    // Fetch recurring data and populate table
                                    message = "<tr><td>Recurring </td><td>Action</td></tr>";
                                    break;
                                case "maintenance":
                                    // Fetch maintenance data and populate table
                                    message = "<tr><td>Maintenance </td><td>Action</td></tr>";
                                    break;
                            }
                            document.getElementById("dynamicTable").innerHTML = "<tbody>" + message + "</tbody>";
                        }


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


</body>

</html>
