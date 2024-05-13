<!DOCTYPE html>
<html lang="en">

<?php
// Include necessary files and database connection
require_once "layouts/config.php";
include 'layouts/session.php';
include 'layouts/head-main.php';

// Fetch data from the database (example)
$query = "SELECT * FROM fleet_insurance";
$result = mysqli_query($link, $query);

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // Prepare DELETE query and execute it
    $deleteQuery = "DELETE FROM fleet_insurance WHERE policy_number = '$deleteId'";
    if (mysqli_query($link, $deleteQuery)) {
        // Redirect back to the main page after successful deletion
        header("Location: fleet_insurance.php");
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
            width: 68%;
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
                    $title = "Insurance";
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
                                                data-target="#addinsuranceModal"><i class="fa fa-plus"></i> Add New</a>
                                        </div>
                                    </div>
                                    <table id="datatable"
                                        class="table table-bordered dt-responsive table-responsive w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Insurance Provider Name</th>
                                                <th>Vehicle Name</th>
                                                <th>Start Date</th>
                                                <th>End Date</th>
                                                <th>Recurring Date</th>
                                                <th>Recurring Period</th>
                                                <th>Insurance Deductible</th>
                                                <th>Charge Payble</th>
                                                <th>Policy Number</th>
                                                <th>Policy Document</th>
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
                                                echo '<td>' . $row['provider_name'] . '</td>';
                                                echo '<td>' . $row['vehicle_name'] . '</td>';
                                                echo '<td>' . $row['start_date'] . '</td>';
                                                echo '<td>' . $row['end_date'] . '</td>';
                                                echo '<td>' . $row['recurring_date'] . '</td>';
                                                echo '<td>' . $row['recurring_period'] . '</td>';
                                                echo '<td>' . $row['insurance_deductible'] . '</td>';
                                                echo '<td>' . $row['charge_payble'] . '</td>';
                                                echo '<td>' . $row['policy_number'] . '</td>';
                                                echo '<td>' . $row['policy_document'] . '</td>';
                                                echo '<td>' . $row['note'] . '</td>';

                                                echo '<td>
                                                <a href="#" class="editInsuranceBtn btn btn-primary btn-sm" style="background-color:#3498db;color:white"
    data-id="' . $row['policy_number'] . '" data-provider_name="' . $row['provider_name'] . '" data-vehicle_name="' . $row['vehicle_name'] . '" data-start_date="' . $row['start_date'] . '" data-end_date="' . $row['end_date'] . '" data-recurring_date="' . $row['recurring_date'] . '" data-recurring_period="' . $row['recurring_period'] . '" data-insurance_deductible="' . $row['insurance_deductible'] . '" data-charge_payble="' . $row['charge_payble'] . '" data-policy_document="' . $row['policy_document'] . '" data-note="' . $row['note'] . '"> 
    <i class="fas fa-edit"></i>Edit
</a>

                                                    <a href="?delete_id=' . $row['policy_number'] . '" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
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
                    <div class="modal fade" id="addinsuranceModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Create New Insurance</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="fleet_add_insurance.php" accept-charset="UTF-8"
                                        enctype="multipart/form-data">
                                        <input name="_token" type="hidden"
                                            value="Oc5WCGz8qQEif29mqWOD6fYTP4pe5ZA6X8GWfair">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="provider_name" class="col-form-label">Insurance
                                                            Provider Name</label>
                                                        <input class="form-control" required="required"
                                                            placeholder="Enter Insurance Provider Name"
                                                            name="provider_name" type="text" id="provider_name">
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
                                                        <label for="start_date" class="col-form-label">Start
                                                            Date</label>
                                                        <input class="form-control" required="required"
                                                            name="start_date" type="date" id="start_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="end_date" class="col-form-label">End Date</label>
                                                        <input class="form-control" required="required" name="end_date"
                                                            type="date" id="end_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="recurring_date" class="col-form-label">Recurring
                                                            Date</label>
                                                        <input class="form-control" required="required"
                                                            name="recurring_date" type="date" id="recurring_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="recurring_period" class="col-form-label">Recurring
                                                            Period</label>
                                                        <select class="form-control" required="required"
                                                            id="recurring_period" name="recurring_period">
                                                            <option value="" selected="selected">Select Recurring
                                                            </option>
                                                            <option value="Air Filter Replacement Interval">Air Filter
                                                                Replacement Interval</option>
                                                            <option value="Brake Pad Replacement Interval">Brake Pad
                                                                Replacement Interval</option>
                                                            <option value="Coolant Flush Interval">Coolant Flush
                                                                Interval</option>
                                                            <option value="Oil Change Interval">Oil Change Interval
                                                            </option>
                                                            <option value="Tire Rotation Interval">Tire Rotation
                                                                Interval</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="insurance_deductible"
                                                            class="col-form-label">Insurance
                                                            Deductible</label>
                                                        <input class="form-control" required="required"
                                                            placeholder="Enter Insurance Deductible Number"
                                                            name="insurance_deductible" type="number"
                                                            id="insurance_deductible">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="charge_payble" class="col-form-label">Charge
                                                            Payable</label>
                                                        <input class="form-control" required="required"
                                                            placeholder="Charge Payable" name="charge_payble"
                                                            type="number" id="charge_payble">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="policy_number" class="col-form-label">Policy
                                                            Number</label>
                                                        <input class="form-control" required="required"
                                                            placeholder="Add Policy Number" minlength="10"
                                                            name="policy_number" type="number" id="policy_number">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="policy_document" class="col-form-label">Policy
                                                            Document</label>
                                                        <div class="choose-file form-group">
                                                            <label for="file" class="form-label">
                                                                <input type="file" name="policy_document"
                                                                    id="policy_document" class="form-control"
                                                                    accept="image/*,"
                                                                    onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])"
                                                                    required="">
                                                                <img src="" id="blah2" class="mt-2" width="25%">
                                                            </label>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="note" class="col-form-label">Note</label>
                                                        <textarea class="form-control" required="required"
                                                            placeholder="Add note" rows="3" name="note" cols="50"
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

                    <!-- ######################################################################################################## -->
                    <!-- Edit Modal dialog structure -->
                    <div class="modal fade" id="editInsuranceModal" tabindex="-1" role="dialog"
                        aria-labelledby="editModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLongTitle">Edit Insurance</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="editForm" method="POST" action="fleet_update_insurance.php"
                                        accept-charset="UTF-8" enctype="multipart/form-data">
                                        <input name="_token" type="hidden"
                                            value="Oc5WCGz8qQEif29mqWOD6fYTP4pe5ZA6X8GWfair">
                                        <!-- <input name="insurance_id" type="hidden"
                                            value="Insert insurance ID here -->
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_provider_name" class="col-form-label">Insurance
                                                        Provider Name</label>
                                                    <input class="form-control" required="required"
                                                        name="edit_provider_name" type="text" id="edit_provider_name">
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
                                                    <label for="edit_start_date" class="col-form-label">Start
                                                        Date</label>
                                                    <input class="form-control" required="required"
                                                        name="edit_start_date" type="date" id="edit_start_date">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_end_date" class="col-form-label">End Date</label>
                                                    <input class="form-control" required="required" name="edit_end_date"
                                                        type="date" id="edit_end_date">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_recurring_date" class="col-form-label">Recurring
                                                        Date</label>
                                                    <input class="form-control" required="required"
                                                        name="edit_recurring_date" type="date" id="edit_recurring_date">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_recurring_period" class="col-form-label">Recurring
                                                        Period</label>
                                                    <select class="form-control" required="required"
                                                        id="edit_recurring_period" name="edit_recurring_period">
                                                        <option value="" selected="selected">Select Recurring</option>
                                                        <option value="Air Filter Replacement Interval">Air Filter
                                                            Replacement Interval</option>
                                                        <option value="Brake Pad Replacement Interval">Brake Pad
                                                            Replacement Interval</option>
                                                        <option value="Coolant Flush Interval">Coolant Flush Interval
                                                        </option>
                                                        <option value="Oil Change Interval">Oil Change Interval</option>
                                                        <option value="Tire Rotation Interval">Tire Rotation Interval
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_insurance_deductible"
                                                        class="col-form-label">Insurance Deductible</label>
                                                    <input class="form-control" required="required"
                                                        name="edit_insurance_deductible" type="number"
                                                        id="edit_insurance_deductible">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_charge_payble" class="col-form-label">Charge
                                                        Payable</label>
                                                    <input class="form-control" required="required"
                                                        name="edit_charge_payble" type="number" id="edit_charge_payble">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_policy_number" class="col-form-label">Policy
                                                        Number</label>
                                                    <input class="form-control" required="required" minlength="10"
                                                        name="edit_policy_number" type="text" id="edit_policy_number">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="edit_policy_document" class="col-form-label">Policy
                                                        Document</label>
                                                    <div class="choose-file form-group">
                                                        <label for="edit_file" class="form-label">
                                                            <input type="file" name="edit_policy_document"
                                                                id="edit_policy_document" class="form-control"
                                                                accept="image/*,"
                                                                onchange="document.getElementById('edit_blah2').src = window.URL.createObjectURL(this.files[0])">
                                                            <img src="" id="edit_blah2" class="mt-2" width="25%">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="edit_note" class="col-form-label">Note</label>
                                                    <textarea class="form-control" required="required" rows="3"
                                                        name="edit_note" id="edit_note"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
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
                            console.log('Document loaded');
                            $(document).on('click', '.editInsuranceBtn', function () {
                                console.log('Edit button clicked');
                                var policy_number = $(this).data('id');
                                var provider_name = $(this).data('provider_name');
                                var vehicle_name = $(this).data('vehicle_name');
                                var start_date = $(this).data('start_date');
                                var end_date = $(this).data('end_date');
                                var recurring_date = $(this).data('recurring_date');
                                var recurring_period = $(this).data('recurring_period');
                                var insurance_deductible = $(this).data('insurance_deductible');
                                var charge_payble = $(this).data('charge_payble');
                                var policy_document = $(this).data('policy_document');
                                var note = $(this).data('note');
                                $('#edit_provider_name').val(provider_name);
                                $('#edit_vehicle_name').val(vehicle_name);
                                $('#edit_start_date').val(start_date);
                                $('#edit_end_date').val(end_date);
                                $('#edit_recurring_date').val(recurring_date);
                                $('#edit_recurring_period').val(recurring_period);
                                $('#edit_insurance_deductible').val(insurance_deductible);
                                $('#edit_charge_payble').val(charge_payble);
                                $('#edit_policy_number').val(policy_number);
                                $('#edit_note').val(note);

                                $('#editInsuranceModal').modal('show');


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

    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>

</body>

</html>