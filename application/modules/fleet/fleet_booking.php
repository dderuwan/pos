<!DOCTYPE html>
<html lang="en">

<?php
// Include necessary files and database connection
require_once "layouts/config.php";
include 'layouts/session.php';
include 'layouts/head-main.php';

// Fetch data from the database (example)
$query = "SELECT * FROM fleet_booking";
$result = mysqli_query($link, $query);

if (isset($_GET['delete_trip_id'])) {
    $deleteId = $_GET['delete_trip_id'];

    // Prepare DELETE query and execute it
    $deleteQuery = "DELETE FROM fleet_booking WHERE trip_id = '$deleteId'";
    if (mysqli_query($link, $deleteQuery)) {
        // Redirect back to the main page after successful deletion
        header("Location: fleet_booking.php");
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
            width: 30%;
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
                    $title = "Booking";
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
                                                data-target="#addBookingModal"><i class="fa fa-plus"></i> Add New</a>
                                        </div>
                                    </div>
                                    <table id="datatable"
                                        class="table table-bordered dt-responsive table-responsive w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Trip Id</th>
                                                <th>Customer Name</th>
                                                <th>Vehicle Name</th>
                                                <th>Start Date</th>
                                                <th>End Date/</th>
                                                <th>Join Date/</th>
                                                <th>Start Location</th>
                                                <th>End Location</th>
                                                <th>Trip Type</th>
                                                <th>Total Price</th>
                                                <th>Status</th>
                                                <th>Notes</th>
                                                <th>Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody style="overflow: scroll;">
                                            <?php
                                            $rowNumber = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<tr>';
                                                echo '<td>' . $rowNumber . '</td>';
                                                echo '<td>' . $row['trip_id'] . '</td>';
                                                echo '<td>' . $row['customer_name'] . '</td>';
                                                echo '<td>' . $row['vehicle_name'] . '</td>';
                                                echo '<td>' . $row['start_date'] . '</td>';
                                                echo '<td>' . $row['end_date'] . '</td>';
                                                echo '<td>' . $row['join_date'] . '</td>';
                                                echo '<td>' . $row['start_location'] . '</td>';
                                                echo '<td>' . $row['end_location'] . '</td>';
                                                echo '<td>' . $row['trip_type'] . '</td>';
                                                echo '<td>' . $row['total_price'] . '</td>';
                                                echo '<td>' . $row['trip_status'] . '</td>';
                                                echo '<td>' . $row['note'] . '</td>';


                                                // Assuming the column name is consigneename
                                                // Add more data columns if needed
                                                echo '<td>
                                                <a href="#" class="btn btn-primary btn-sm editBookingBtn" style="background-color:#3498db;color:white"
                                                data-trip_id="' . $row['trip_id'] . '" data-customer_name="' . $row['customer_name'] . '" data-vehicle_name="' . $row['vehicle_name'] . '" data-start_date="' . $row['start_date'] . '" data-end_date="' . $row['end_date'] . '"
                                                data-join_date="' . $row['join_date'] . '" data-start_location="' . $row['start_location'] . '" data-end_location="' . $row['end_location'] . '" data-trip_type="' . $row['trip_type'] . '" data-total_price="' . $row['total_price'] . '" data-trip_status="' . $row['trip_status'] . '" data-note="' . $row['note'] . '"> <i class="fas fa-edit"></i>Edit</a>
                                               
                                               
                                                <a href="?delete_trip_id=' . $row['trip_id'] . '" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Delete</a>
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
                    <div class="modal fade" id="addBookingModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Create Booking</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="fleet_add_booking.php" accept-charset="UTF-8"
                                        enctype="multipart/form-data">
                                        <input name="_token" type="hidden"
                                            value="Oc5WCGz8qQEif29mqWOD6fYTP4pe5ZA6X8GWfair">
                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="customer_name" class="form-label">Customer
                                                            Name</label>
                                                        <select class="form-control" required="required"
                                                            id="customer_name" name="customer_name">
                                                            <option value="" selected="selected">Select Customer
                                                            </option>
                                                            <option value="Buffy Walte">Buffy Walter</option>
                                                            <option value="Fapor Slims">Fapor Slims</option>
                                                            <option value="Antikstion Grum">Antikstion Grum</option>
                                                            <option value="Juliet May">Juliet May</option>
                                                            <option value="Juliet May">Juliet May</option>
                                                            <option value="Buffy Walter">Buffy Walter</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="vehicle_name" class="form-label">Vehicle
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
                                                        <label for="datetime" class="col-form-label">Start
                                                            Date/Time</label>
                                                        <input class="form-control" value="2024-04-06T11:39"
                                                            placeholder="Select Date/Time" required="required"
                                                            name="start_date" type="datetime-local">

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="datetime" class="col-form-label">End
                                                            Date/Time</label>
                                                        <input class="form-control" value="2024-04-06T11:39"
                                                            placeholder="Select Date/Time" required="required"
                                                            name="end_date" type="datetime-local">

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="join_date" class="form-label">Join Date</label>
                                                        <input class="form-control current_date" required="required"
                                                            autocomplete="off" placeholder="Select join date"
                                                            name="join_date" type="date" id="join_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="start_location" class="form-label">Start
                                                            Location</label>
                                                        <input type="text" class="form-control pac-target-input"
                                                            id="start_location" name="start_location" required=""
                                                            autocomplete="off" placeholder="Enter a location">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="end_location" class="form-label">End
                                                            Location</label>
                                                        <input type="text" class="form-control pac-target-input"
                                                            id="end_location" name="end_location" required=""
                                                            autocomplete="off" placeholder="Enter a location">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="trip_type" class="form-label">Trip Type</label>
                                                        <select class="form-control" required="required" id="trip_type"
                                                            name="trip_type">
                                                            <option selected="selected" value="">Select Trip Type
                                                            </option>
                                                            <option value="Single Trip">Single Trip</option>
                                                            <option value="Round Trip">Round Trip</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="total_price" class="form-label">Total Price</label>
                                                        <input class="form-control" required="required"
                                                            placeholder="Enter Total Amount" name="total_price"
                                                            type="number" id="total_price">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="trip_status" class="form-label">Select Trip
                                                            Status</label>
                                                        <select class="form-control" required="required"
                                                            id="trip_status" name="trip_status">
                                                            <option selected="selected" value="">Select Trip
                                                                Status
                                                            </option>
                                                            <option value="Yet to start">Yet to start</option>
                                                            <option value="Completed">Completed</option>
                                                            <option value="OnGoing">OnGoing</option>
                                                            <option value="Cancelled">Cancelled</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="note" class="form-label">Note</label>
                                                    <textarea class="form-control" placeholder="Enter Description"
                                                        required="required" rows="3" name="note" cols="50"
                                                        id="note"></textarea>
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


                    <!-- ################################################################################# -->

                    <!-- Modal dialog structure for edit -->
                    <div class="modal fade" id="editBookingModal" tabindex="-1" role="dialog"
                        aria-labelledby="editBookingModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editBookingModalLabel">Edit Booking</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="fleet_update_booking.php" accept-charset="UTF-8"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_customer_name" class="form-label">Customer
                                                            Name</label>
                                                        <select class="form-control" required="required"
                                                            id="edit_customer_name" name="edit_customer_name">
                                                            <option value="" selected="selected">Select Customer
                                                            </option>
                                                            <option value="Buffy Walte">Buffy Walter</option>
                                                            <option value="Fapor Slims">Fapor Slims</option>
                                                            <option value="Antikstion Grum">Antikstion Grum</option>
                                                            <option value="Juliet May">Juliet May</option>
                                                            <option value="Juliet May">Juliet May</option>
                                                            <option value="Buffy Walter">Buffy Walter</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_vehicle_name" class="form-label">Vehicle
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
                                                            Date/Time</label>
                                                        <input class="form-control" value="2024-04-06T11:39"
                                                            required="required" name="edit_start_date"
                                                            type="datetime-local">

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_end_date" class="col-form-label">End
                                                            Date/Time</label>
                                                        <input class="form-control" value="2024-04-06T11:39"
                                                            required="required" name="edit_end_date"
                                                            type="datetime-local">

                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_join_date" class="form-label">Join Date</label>
                                                        <input class="form-control current_date" required="required"
                                                            autocomplete="off" name="edit_join_date" type="date"
                                                            id="edit_join_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_start_location" class="form-label">Start
                                                            Location</label>
                                                        <input type="text" class="form-control pac-target-input"
                                                            id="edit_start_location" name="edit_start_location"
                                                            required="" autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_end_location" class="form-label">End
                                                            Location</label>
                                                        <input type="text" class="form-control pac-target-input"
                                                            id="edit_end_location" name="edit_end_location" required=""
                                                            autocomplete="off">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_trip_type" class="form-label">Trip Type</label>
                                                        <select class="form-control" required="required"
                                                            id="edit_trip_type" name="edit_trip_type">
                                                            <option selected="selected" value="">Select Trip Type
                                                            </option>
                                                            <option value="Single Trip">Single Trip</option>
                                                            <option value="Round Trip">Round Trip</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_total_price" class="form-label">Total
                                                            Price</label>
                                                        <input class="form-control" required="required"
                                                            name="edit_total_price" type="number" id="edit_total_price">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_trip_status" class="form-label">Select Trip
                                                            Status</label>
                                                        <select class="form-control" required="required"
                                                            id="edit_trip_status" name="edit_trip_status">
                                                            <option selected="selected" value="">Select Trip
                                                                Status
                                                            </option>
                                                            <option value="Yet to start">Yet to start</option>
                                                            <option value="Completed">Completed</option>
                                                            <option value="OnGoing">OnGoing</option>
                                                            <option value="Cancelled">Cancelled</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="edit_note" class="form-label">Note</label>
                                                    <textarea class="form-control" required="required" rows="3"
                                                        name="edit_note" cols="50" id="edit_note"></textarea>
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
                            console.log('Document loaded');
                            $(document).on('click', '.editBookingBtn', function () {
                                console.log('Edit button clicked');
                                var trip_id = $(this).data('id');
                                var customer_name = $(this).data('customer_name');
                                var vehicle_name = $(this).data('vehicle_name');
                                var start_date = $(this).data('start_date');
                                var end_date = $(this).data('end_date');
                                var join_date = $(this).data('join_date');
                                var start_location = $(this).data('start_location');
                                var end_location = $(this).data('end_location');
                                var trip_type = $(this).data('trip_type');
                                var total_price = $(this).data('total_price');
                                var trip_status = $(this).data('trip_status');
                                var note = $(this).data('note');
                                $('#edit_trip_id').val(trip_id);
                                $('#edit_customer_name').val(customer_name);
                                $('#edit_vehicle_name').val(vehicle_name);
                                $('#edit_start_date').val(start_date);
                                $('#edit_end_date').val(end_date);
                                $('#edit_join_date').val(join_date);
                                $('#edit_start_location').val(start_location);
                                $('#edit_end_location').val(end_location);
                                $('#edit_trip_type').val(trip_type);
                                $('#edit_total_price').val(total_price);
                                $('#edit_trip_status').val(trip_status);
                                $('#edit_note').val(note);
                                $('#editBookingModal').modal('show');
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