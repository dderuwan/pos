<!DOCTYPE html>
<html lang="en">

<?php
// Include necessary files and database connection
require_once "layouts/config.php";
include 'layouts/session.php';
include 'layouts/head-main.php';

// Fetch data from the database (example)
$query = "SELECT * FROM fleet_fuel";
$result = mysqli_query($link, $query);

if (isset($_GET['delete_fuel_id'])) {
    $deleteId = $_GET['delete_fuel_id'];

    // Prepare DELETE query and execute it
    $deleteQuery = "DELETE FROM fleet_fuel WHERE fuel_id	 = '$deleteId'";
    if (mysqli_query($link, $deleteQuery)) {
        // Redirect back to the main page after successful deletion
        header("Location: fleet_fuel.php");
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
                    $title = "Fuel History";
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
                                                data-target="#addFuelModal"><i class="fa fa-plus"></i> Add
                                                New</a>
                                        </div>
                                    </div>
                                    <table id="datatable" class="table table-bordered table-responsive w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Fuel ID </th>
                                                <th>Driver Name </th>
                                                <th>Vehicle Name</th>
                                                <th>Fuel Type</th>
                                                <th>Fueling Date and Time</th>
                                                <th>Gallons / Liters of Fuel</th>
                                                <th>Cost per Gallon/ Liter</th>
                                                <th>Total Cost</th>
                                                <th>Odometer Reading</th>
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
                                                echo '<td>' . $row['fuel_id'] . '</td>';
                                                echo '<td>' . $row['driver_name'] . '</td>';
                                                echo '<td>' . $row['vehicle_name'] . '</td>';
                                                echo '<td>' . $row['fuel_type'] . '</td>';
                                                echo '<td>' . $row['fueling_date'] . '</td>';
                                                echo '<td>' . $row['gallons_liters'] . '</td>';
                                                echo '<td>' . $row['cost_liter'] . '</td>';
                                                echo '<td>' . $row['total_cost'] . '</td>';
                                                echo '<td>' . $row['odometer'] . '</td>';
                                                echo '<td>' . $row['note'] . '</td>';

                                                echo '<td>
                                                <a href="#" class="btn btn-primary btn-sm editFuelBtn" style="background-color:#3498db;color:white"
                                                data-fuel_id="' . $row['fuel_id'] . '" data-driver_name="' . $row['driver_name'] . '" data-vehicle_name="' . $row['vehicle_name'] . '" data-fuel_type="' . $row['fuel_type'] . '" data-fueling_date="' . $row['fueling_date'] . '"
                                                data-gallons_liters="' . $row['gallons_liters'] . '" data-cost_liter="' . $row['cost_liter'] . '" data-total_cost="' . $row['total_cost'] . '" data-odometer="' . $row['odometer'] . '" data-note="' . $row['note'] . '"> <i class="fas fa-edit"></i>Edit</a>
                                                <a href="?delete_fuel_id=' . $row['fuel_id'] . '" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
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
                    <div class="modal fade" id="addFuelModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Create New Fuel</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="fleet_add_fuel.php" accept-charset="UTF-8"
                                        enctype="multipart/form-data">
                                        <input name="_token" type="hidden"
                                            value="Oc5WCGz8qQEif29mqWOD6fYTP4pe5ZA6X8GWfair">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="driver_name" class="col-form-label">Driver
                                                            Name</label>
                                                        <select class="form-control" required="required"
                                                            id="driver_name" name="driver_name">
                                                            <option value="" selected="selected">Select Driver Name
                                                            </option>
                                                            <option value="Parker">Parker</option>
                                                            <option value="Abel Callahan">Abel Callahan</option>
                                                            <option value="Kirsten Benson">Kirsten Benson</option>
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
                                                        <label for="fuel_type" class="col-form-label">Fuel Type</label>
                                                        <select class="form-control" required="required" id="fuel_type"
                                                            name="fuel_type">
                                                            <option value="" selected="selected">Select Fuel Type
                                                            </option>
                                                            <option value="Gasoline">Gasoline</option>
                                                            <option value="Diesel">Diesel</option>
                                                            <option value="Electricity">Electricity</option>
                                                            <option value="Compressed Natural Gas (CNG):">Compressed
                                                                Natural Gas (CNG):</option>
                                                            <option value="Petrol">Petrol</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6  mb-1">
                                                    <label for="datetime" class="col-form-label">Fueling Date and
                                                        Time</label>
                                                    <input class="form-control" value="2024-04-09 06:30"
                                                        placeholder="Select Fueling Date and Time" required="required"
                                                        name="fueling_date" type="datetime-local">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="gallons_liters"
                                                            class="col-form-label">Gallons/Liters of
                                                            Fuel</label>
                                                        <input class="form-control" required="required"
                                                            placeholder="Enter Gallons/Liters of Fuel"
                                                            name="gallons_liters" type="text" id="gallons_liters">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="cost_liter" class="col-form-label">Cost per
                                                            Gallon/Liter</label>
                                                        <input class="form-control" required="required"
                                                            placeholder="Enter Cost per Gallon/Liter" name="cost_liter"
                                                            type="number" id="cost_liter">
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="odometer" class="col-form-label">Odometer
                                                            Reading</label>
                                                        <input class="form-control" required="required"
                                                            placeholder="Enter Odometer Reading" name="odometer"
                                                            type="text" id="odometer">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="note" class="col-form-label">Notes</label>
                                                        <textarea class="form-control" required="required"
                                                            placeholder="Add Notes" rows="3" name="note" cols="50"
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

                    <!-- ########################################################################################################################### -->

                    <!-- Modal dialog structure -->
                    <!-- Edit Modal dialog structure -->
                    <div class="modal fade" id="editFuelModal" tabindex="-1" role="dialog"
                        aria-labelledby="editModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLongTitle">Edit Fuel Information</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="fleet_update_fuel.php" accept-charset="UTF-8"
                                        enctype="multipart/form-data">
                                        <input name="_token" type="hidden"
                                            value="Oc5WCGz8qQEif29mqWOD6fYTP4pe5ZA6X8GWfair">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_driver_name" class="col-form-label">Driver
                                                            Name</label>
                                                        <select class="form-control" required="required"
                                                            id="edit_driver_name" name="edit_driver_name">
                                                            <option value="" selected="selected">Select Driver Name
                                                            </option>
                                                            <option value="Parker">Parker</option>
                                                            <option value="Abel Callahan">Abel Callahan</option>
                                                            <option value="Kirsten Benson">Kirsten Benson</option>
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
                                                        <label for="edit_fuel_type" class="col-form-label">Fuel
                                                            Type</label>
                                                        <select class="form-control" required="required"
                                                            id="edit_fuel_type" name="edit_fuel_type">
                                                            <option value="" selected="selected">Select Fuel Type
                                                            </option>
                                                            <option value="Gasoline">Gasoline</option>
                                                            <option value="Diesel">Diesel</option>
                                                            <option value="Electricity">Electricity</option>
                                                            <option value="Compressed Natural Gas (CNG):">Compressed
                                                                Natural Gas (CNG):
                                                            </option>
                                                            <option value="Petrol">Petrol</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-6  mb-1">
                                                    <label for="edit_datetime" class="col-form-label">Fueling Date and
                                                        Time</label>
                                                    <input class="form-control" value="2024-04-09 06:30"
                                                        required="required" name="edit_fueling_date"
                                                        type="datetime-local">
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_gallons_liters"
                                                            class="col-form-label">Gallons/Liters of
                                                            Fuel</label>
                                                        <input class="form-control" required="required"
                                                            placeholder="Enter Gallons/Liters of Fuel"
                                                            name="edit_gallons_liters" type="text"
                                                            id="edit_gallons_liters">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_cost_liter" class="col-form-label">Cost per
                                                            Gallon/Liter</label>
                                                        <input class="form-control" required="required"
                                                            name="edit_cost_liter" type="number" id="edit_cost_liter">
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_odometer" class="col-form-label">Odometer
                                                            Reading</label>
                                                        <input class="form-control" required="required"
                                                            name="edit_odometer" type="text" id="edit_odometer">
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



                    <!-- JavaScript and jQuery libraries -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                    <script>
                        $(document).ready(function () {
                            console.log('Script executed!');
                            $('.editFuelBtn').on('click', function () {
                                var fuel_id = $(this).data('id');
                                var driver_name = $(this).data('driver_name');
                                var vehicle_name = $(this).data('vehicle_name');
                                var fuel_type = $(this).data('fuel_type');
                                var fueling_date = $(this).data('fueling_date');
                                var gallons_liters = $(this).data('gallons_liters');
                                var cost_liter = $(this).data('cost_liter');
                                var total_cost = $(this).data('total_cost');

                                var odometer = $(this).data('odometer');
                                var note = $(this).data('note');

                                $('#edit_fuel_id ').val(fuel_id);
                                $('#edit_driver_name').val(driver_name);
                                $('#edit_vehicle_name').val(vehicle_name);
                                $('#edit_fuel_type').val(fuel_type);
                                $('#edit_fueling_date').val(fueling_date);
                                $('#edit_gallons_liters').val(gallons_liters);
                                $('#edit_cost_liter').val(cost_liter);
                                $('#edit_total_cost').val(total_cost);
                                $('#edit_odometer').val(odometer);
                                $('#edit_note').val(note);

                                $('#editFuelModal').modal('show');
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