<!DOCTYPE html>
<html lang="en">

<?php
// Include necessary files and database connection
require_once "layouts/config.php";
include 'layouts/session.php';
include 'layouts/head-main.php';

// Fetch data from the database (example)
$query = "SELECT * FROM fleet_maintenance";
$result = mysqli_query($link, $query);

if (isset($_GET['delete_maintenance_id'])) {
    $deleteId = $_GET['delete_maintenance_id'];

    // Prepare DELETE query and execute it
    $deleteQuery = "DELETE FROM fleet_maintenance WHERE maintenance_id  = '$deleteId'";
    if (mysqli_query($link, $deleteQuery)) {
        // Redirect back to the main page after successful deletion
        header("Location: fleet_maintenance.php");
        exit();
    } else {
        // Display an error message if deletion fails
        echo "Error deleting record: " . mysqli_error($link);
    }
}
?>

<head>
    <style>
        /* Custom CSS */
        .modal-body .form-group {
            margin-bottom: 10px;
        }

        /* Adjust font size for select boxes and inputs */
        .modal-body select,
        .modal-body input {
            font-size: 14px;
        }

        #customerDialogLabel {
            text-align: center;
        }

        /* Style the label and input elements horizontally */
        .modal-body .form-group label {
            display: inline-block;
            /* width: 30%; */
            /* Adjust as needed */
            vertical-align: top;
        }

        .modal-body .form-group input,
        .modal-body .form-group select {
            /* display: inline-block; */
            /* width: 68%; */
            /* Adjust as needed */
            vertical-align: top;
        }

        /* Style the select element to match the form-control class */
    </style>

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
                    $title = "Maintenances";
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
                                            <a class="btn btn-sm btn-default btn-flat border-primaryy"
                                                style="border-color: #2ecc71;" href="#" data-toggle="modal"
                                                data-target="#addMaintenanceModal"><i class="fa fa-plus"></i> Add
                                                New</a>
                                        </div>
                                    </div>
                                    <table id="datatable"
                                        class="table table-bordered dt-responsive table-responsive w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Id</th>
                                                <th>Service Type</th>
                                                <th>Service For</th>
                                                <th>Vehicle Name</th>
                                                <th>Maintenance Type</th>
                                                <th>Maintenance Service Name/</th>
                                                <th>Cost</th>
                                                <th>Charge Bear By</th>
                                                <th>Maintenance Date</th>
                                                <th>Priority</th>
                                                <th>Total Cost</th>
                                                <th>Note</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody style="overflow: scroll;">
                                            <?php
                                            $rowNumber = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<tr>';
                                                echo '<td>' . $rowNumber . '</td>';
                                                echo '<td>' . $row['maintenance_id'] . '</td>';
                                                echo '<td>' . $row['service_type'] . '</td>';
                                                echo '<td>' . $row['service_for'] . '</td>';
                                                echo '<td>' . $row['vehicle_name'] . '</td>';
                                                echo '<td>' . $row['maintenance_type'] . '</td>';
                                                echo '<td>' . $row['maintenance_service_name'] . '</td>';
                                                echo '<td>' . $row['cost'] . '</td>';
                                                echo '<td>' . $row['charge_bear_by'] . '</td>';
                                                echo '<td>' . $row['maintenanc_date'] . '</td>';
                                                echo '<td>' . $row['priority'] . '</td>';
                                                echo '<td>' . $row['total_cost'] . '</td>';
                                                echo '<td>' . $row['note'] . '</td>';

                                                echo '<td>
                                                <a href="#" class="btn btn-primary btn-sm editMainBtn" style="background-color:#3498db;color:white"
                                                data-maintenance_id="' . $row['maintenance_id'] . '" data-service_type="' . $row['service_type'] . '" data-service_for="' . $row['service_for'] . '" data-vehicle_name="' . $row['vehicle_name'] . '" data-maintenance_type="' . $row['maintenance_type'] . '"
                                                data-maintenance_service_name="' . $row['maintenance_service_name'] . '" data-cost="' . $row['cost'] . '" data-charge_bear_by="' . $row['charge_bear_by'] . '" data-maintenanc_date="' . $row['maintenanc_date'] . '" data-priority="' . $row['priority'] . '" data-total_cost="' . $row['total_cost'] . '" data-note="' . $row['note'] . '"> <i class="fas fa-edit"></i>Edit</a>
                                                <a href="?delete_maintenance_id=' . $row['maintenance_id'] . '" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
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
                    <div class="modal fade" id="addMaintenanceModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Create New Maintenance</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="fleet_add_maintenance.php" accept-charset="UTF-8"
                                        enctype="multipart/form-data">
                                        <input name="_token" type="hidden"
                                            value="Oc5WCGz8qQEif29mqWOD6fYTP4pe5ZA6X8GWfair">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="service_type" class="col-form-label">Service
                                                            Type</label>
                                                        <div class="d-flex radio-check">
                                                            <div
                                                                class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="maintenance" value="Maintenance"
                                                                    name="service_type" class="form-check-input">
                                                                <label class="form-check-label "
                                                                    for="maintenance">Maintenance</label>
                                                            </div>
                                                            <div
                                                                class="custom-control custom-radio ms-5 custom-control-inline">
                                                                <input type="radio" id="general" value="General"
                                                                    name="service_type" class="form-check-input">
                                                                <label class="form-check-label "
                                                                    for="general">General</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="service_for" class="col-form-label">Service
                                                            For</label>
                                                        <select class="form-control" required="required"
                                                            id="service_for" name="service_for">
                                                            <option value="" selected="selected">Select Users</option>
                                                            <option value="Richard Atkinson">Richard Atkinson</option>
                                                            <option value="Sonya Sims">Sonya Sims</option>
                                                            <option value="Joseph Fiennes">Joseph Fiennes</option>
                                                            <option value="Maia">Maia</option>
                                                            <option value="Kirsten Benson">Kirsten Benson</option>
                                                            <option value="Chloe Humphrey">Chloe Humphrey</option>
                                                            <option value="Shafira Barnes">Shafira Barnes</option>
                                                            <option value="Dr. Michael Rodriguez">Dr. Michael Rodriguez
                                                            </option>

                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="vehicle_name" class="col-form-label">Vehicle
                                                            Name</label>
                                                        <select class="form-control" required="required"
                                                            id="vehicle_name" name="vehicle_name">
                                                            <option value="" selected="selected">Select Vehicle</option>
                                                            <option value="BMW Z4">BMW Z4</option>
                                                            <option value="Toyota Camry">Toyota Camry</option>
                                                            <option value="Tru">Tru</option>
                                                            <option value="Kia Sedona">Kia Sedona</option>
                                                            <option value="BMW">BMW</option>
                                                            <option value="Hyundai Kona Electric">Hyundai Kona Electric
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="maintenance_type" class="col-form-label">Maintenance
                                                            Type</label>
                                                        <select class="form-control" required="required"
                                                            id="maintenance_type" name="maintenance_type">
                                                            <option value="" selected="selected">Select MaintenanceType
                                                            </option>
                                                            <option value="Routine Maintenance">Routine Maintenance
                                                            </option>
                                                            <option value="Preventive Maintenance">Preventive
                                                                Maintenance</option>
                                                            <option value="Corrective Maintenance">Corrective
                                                                Maintenance</option>
                                                            <option value="Scheduled Maintenance">Scheduled Maintenance
                                                            </option>
                                                            <option value="Seasonal Maintenance">Seasonal Maintenance
                                                            </option>
                                                            <option value="Safety Maintenance">Safety Maintenance
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="maintenance_service_name"
                                                            class="col-form-label">Maintenance
                                                            Service Name</label>
                                                        <input class="form-control" required="required"
                                                            placeholder="Enter Maintenance Service Name"
                                                            name="maintenance_service_name" type="text"
                                                            id="maintenance_service_name">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="cost" class="col-form-label">Cost</label>
                                                        <input class="form-control" required="required"
                                                            placeholder="Enter Cost" name="cost" type="number"
                                                            id="cost">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="charge_bear_by" class="col-form-label">Charge Bear
                                                            By</label>
                                                        <input class="form-control" required="required"
                                                            placeholder="Enter Charge Bear By" name="charge_bear_by"
                                                            type="number" id="charge_bear_by">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="maintenanc_date" class="col-form-label">Maintenance
                                                            Date</label>
                                                        <input class="form-control" required="required"
                                                            placeholder="Enter Maintenance Date" name="maintenanc_date"
                                                            type="date" id="maintenanc_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="priority" class="col-form-label">Priority</label>
                                                        <select class="form-control" required="required" id="priority"
                                                            name="priority">
                                                            <option selected="selected" value="">Select Priority
                                                            </option>
                                                            <option value="High">High</option>
                                                            <option value="Medium">Medium</option>
                                                            <option value="Low">Low</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="total_cost" class="col-form-label">Total
                                                            Cost</label>
                                                        <input class="form-control" required="required"
                                                            placeholder="Enter Total Cost" name="total_cost"
                                                            type="number" id="total_cost">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="note" class="col-form-label">Notes</label>
                                                        <textarea class="form-control" required="required"
                                                            placeholder="Enter Notes" rows="3" name="note" cols="50"
                                                            id="note"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>




                    <!-- ############################################################################################## -->
                    <!-- Edit Modal dialog structure -->

                    <div class="modal fade" id="editMainModal" tabindex="-1" role="dialog"
                        aria-labelledby="editModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLongTitle">Edit Maintenance</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="fleet_update_maintenance.php" accept-charset="UTF-8"
                                        enctype="multipart/form-data">
                                        <input name="_token" type="hidden"
                                            value="Oc5WCGz8qQEif29mqWOD6fYTP4pe5ZA6X8GWfair">
                                        <input type="hidden" name="edit_maintenance_id" id="edit_maintenance_id">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_service_type" class="col-form-label">Service
                                                            Type</label>
                                                        <div class="d-flex radio-check">
                                                            <div
                                                                class="custom-control custom-radio custom-control-inline">
                                                                <input type="radio" id="edit_maintenance"
                                                                    value="Maintenance" name="edit_service_type"
                                                                    class="form-check-input">
                                                                <label class="form-check-label"
                                                                    for="edit_maintenance">Maintenance</label>
                                                            </div>
                                                            <div
                                                                class="custom-control custom-radio ms-5 custom-control-inline">
                                                                <input type="radio" id="edit_general" value="General"
                                                                    name="edit_service_type" class="form-check-input">
                                                                <label class="form-check-label"
                                                                    for="edit_general">General</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_service_for" class="form-label">Service
                                                            For</label>
                                                        <select class="form-control" required="required"
                                                            id="edit_service_for" name="edit_service_for">
                                                            <option value="" selected="selected">Select Users</option>
                                                            <option value="Richard Atkinson">Richard Atkinson</option>
                                                            <option value="Sonya Sims">Sonya Sims</option>
                                                            <option value="Joseph Fiennes">Joseph Fiennes</option>
                                                            <option value="Maia">Maia</option>
                                                            <option value="Kirsten Benson">Kirsten Benson</option>
                                                            <option value="Chloe Humphrey">Chloe Humphrey</option>
                                                            <option value="Shafira Barnes">Shafira Barnes</option>
                                                            <option value="Dr. Michael Rodriguez">Dr. Michael Rodriguez
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_vehicle_name" class="col-form-label">Vehicle
                                                            Name</label>
                                                        <select class="form-control" required="required"
                                                            id="edit_vehicle_name" name="edit_vehicle_name">
                                                            <option value="" selected="selected">Select Vehicle</option>
                                                            <option value="BMW Z4">BMW Z4</option>
                                                            <option value="Toyota Camry">Toyota Camry</option>
                                                            <option value="Tru">Tru</option>
                                                            <option value="Kia Sedona">Kia Sedona</option>
                                                            <option value="BMW">BMW</option>
                                                            <option value="Hyundai Kona Electric">Hyundai Kona Electric
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_maintenance_type"
                                                            class="col-form-label">Maintenance Type</label>
                                                        <select class="form-control" required="required"
                                                            id="edit_maintenance_type" name="edit_maintenance_type">
                                                            <option value="" selected="selected">Select Maintenance Type
                                                            </option>
                                                            <option value="Routine Maintenance">Routine Maintenance
                                                            </option>
                                                            <option value="Preventive Maintenance">Preventive
                                                                Maintenance</option>
                                                            <option value="Corrective Maintenance">Corrective
                                                                Maintenance</option>
                                                            <option value="Scheduled Maintenance">Scheduled Maintenance
                                                            </option>
                                                            <option value="Seasonal Maintenance">Seasonal Maintenance
                                                            </option>
                                                            <option value="Safety Maintenance">Safety Maintenance
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_maintenance_service_name"
                                                            class="col-form-label">Maintenance Service Name</label>
                                                        <input class="form-control" required="required"
                                                            name="edit_maintenance_service_name" type="text"
                                                            id="edit_maintenance_service_name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_cost" class="col-form-label">Cost</label>
                                                        <input class="form-control" required="required" name="edit_cost"
                                                            type="number" id="edit_cost">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_charge_bear_by" class="col-form-label">Charge
                                                            Bear By</label>
                                                        <input class="form-control" required="required"
                                                            name="edit_charge_bear_by" type="number"
                                                            id="edit_charge_bear_by">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_maintenanc_date"
                                                            class="col-form-label">Maintenance Date</label>
                                                        <input class="form-control" required="required"
                                                            name="edit_maintenanc_date" type="date"
                                                            id="edit_maintenanc_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_priority"
                                                            class="col-form-label">Priority</label>
                                                        <select class="form-control" required="required"
                                                            id="edit_priority" name="edit_priority">
                                                            <option selected="selected" value="">Select Priority
                                                            </option>
                                                            <option value="High">High</option>
                                                            <option value="Medium">Medium</option>
                                                            <option value="Low">Low</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_total_cost" class="col-form-label">Total
                                                            Cost</label>
                                                        <input class="form-control" required="required"
                                                            name="edit_total_cost" type="number" id="edit_total_cost">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="edit_note" class="col-form-label">Notes</label>
                                                        <textarea class="form-control" required="required" rows="3"
                                                            name="edit_note" cols="50" id="edit_note"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                    <script>
                        $(document).ready(function () {
                            $(document).on('click', '.editMainBtn', function () {
                                var maintenance_id = $(this).data('maintenance_id');
                                var service_type = $(this).data('service_type');
                                var service_for = $(this).data('service_for');
                                var vehicle_name = $(this).data('vehicle_name');
                                var maintenance_type = $(this).data('maintenance_type');
                                var maintenance_service_name = $(this).data('maintenance_service_name');
                                var cost = $(this).data('cost');
                                var charge_bear_by = $(this).data('charge_bear_by');
                                var maintenanc_date = $(this).data('maintenanc_date');
                                var priority = $(this).data('priority');
                                var total_cost = $(this).data('total_cost');
                                var note = $(this).data('note');

                                $('#edit_maintenance_id').val(maintenance_id);
                                $('#edit_service_type').val(service_type);
                                $('#edit_service_for').val(service_for);
                                $('#edit_vehicle_name').val(vehicle_name);
                                $('#edit_maintenance_type').val(maintenance_type);
                                $('#edit_maintenance_service_name').val(maintenance_service_name);
                                $('#edit_cost').val(cost);
                                $('#edit_charge_bear_by').val(charge_bear_by);
                                $('#edit_maintenanc_date').val(maintenanc_date);
                                $('#edit_priority').val(priority);
                                $('#edit_total_cost').val(total_cost);
                                $('#edit_note').val(note);
                                $('#editMainModal').modal('show');
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