<!DOCTYPE html>
<html lang="en">

<?php
// Include necessary files and database connection
require_once "layouts/config.php";
include 'layouts/session.php';
include 'layouts/head-main.php';

// Fetch data from the database (example)
$query = "SELECT * FROM fleet_driver";
$result = mysqli_query($link, $query);

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // Prepare DELETE query and execute it
    $deleteQuery = "DELETE FROM fleet_driver WHERE mobile = '$deleteId'";
    if (mysqli_query($link, $deleteQuery)) {
        // Redirect back to the main page after successful deletion
        header("Location: fleet_driver.php");
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
            display: inline-block;
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
                    $title = "Driver Profile";
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
                                                data-target="#addDriverModal"><i class="fa fa-plus"></i> Add New</a>
                                        </div>
                                    </div>
                                    <table id="datatable"
                                        class="table table-bordered dt-responsive table-responsive w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile Number</th>
                                                <th>Date of Birth</th>
                                                <th>Join Date</th>
                                                <th>License Number</th>
                                                <th>License Type</th>
                                                <th>License Expire Date</th>
                                                <th>Driver Status</th>
                                                <th>Working Time</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody style="overflow: scroll;">
                                            <?php
                                            $rowNumber = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<tr>';
                                                echo '<td>' . $rowNumber . '</td>';
                                                echo '<td>' . $row['name'] . '</td>';
                                                echo '<td>' . $row['email'] . '</td>';
                                                echo '<td>' . $row['mobile'] . '</td>';
                                                echo '<td>' . $row['dob'] . '</td>';
                                                echo '<td>' . $row['join_date'] . '</td>';
                                                echo '<td>' . $row['lincese_number'] . '</td>';
                                                echo '<td>' . $row['lincese_type'] . '</td>';
                                                echo '<td>' . $row['expiry_date'] . '</td>';
                                                echo '<td>' . $row['driver_status'] . '</td>';
                                                echo '<td>' . $row['Working_time'] . '</td>';
                                                echo '<td>' . $row['address'] . '</td>';
                                                echo '<td>
                                                <a href="#" class="btn btn-primary btn-sm editbtn" style="background-color:#3498db;color:white"
                                                data-id="' . $row['mobile'] . '" data-name="' . $row['name'] . '" data-email="' . $row['email'] . '" data-dob="' . $row['dob'] . '" data-join_date="' . $row['join_date'] . '"
                                                 data-lincese_number="' . $row['lincese_number'] . '" data-lincese_type="' . $row['lincese_type'] . '" data-expiry_date="' . $row['expiry_date'] . '" data-driver_status="' . $row['driver_status'] . '" data-working_time="' . $row['Working_time'] . '" data-address="' . $row['address'] . '"> 
                                                 <i class="fas fa-edit"></i>Edit</a>
                                             
                                                <a href="?delete_id=' . $row['mobile'] . '" class="btn btn-danger btn-sm"> <i class="fas fa-trash"></i> Delete</a>
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
                    <div class="modal fade" id="addDriverModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Create New Driver</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="fleet_add_driver.php" accept-charset="UTF-8"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input class="form-control" placeholder="Enter Driver Name"
                                                            required="required" name="name" type="text" id="name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input class="form-control" placeholder="Enter Driver email"
                                                            required="required" name="email" type="email" id="email">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="phone" class="form-label">Mobile Number</label>
                                                        <input class="form-control" placeholder="Enter Driver Number"
                                                            required="required" name="phone" type="text" id="phone">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="dob" class="form-label">Date of Birth</label>
                                                        <input class="form-control" required="required"
                                                            autocomplete="off" placeholder="Select Date of Birth"
                                                            name="dob" type="date" id="dob">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="join_date" class="form-label">Join Date</label>
                                                        <input class="form-control" required="required"
                                                            autocomplete="off" placeholder="Select join date"
                                                            name="join_date" type="date" id="join_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lincese_number" class="form-label">License
                                                            Number</label>
                                                        <input class="form-control" placeholder="Enter License Number"
                                                            required="required" name="lincese_number" type="text"
                                                            id="lincese_number">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="lincese_type" class="form-label">License
                                                            Type</label>
                                                        <select class="form-control" required="required"
                                                            id="lincese_type" name="lincese_type">
                                                            <option value="1">Commercial Driver's License</option>
                                                            <option value="2">Motorcycle License</option>
                                                            <option value="3">Boat License</option>
                                                            <option value="4">Aircraft Pilot's License</option>
                                                            <option value="5">Taxi or Ride-Share License</option>
                                                            <option value="6">Recreational Vehicle License</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="expiry_date" class="form-label">License Expire
                                                            Date</label>
                                                        <input class="form-control" required="required"
                                                            autocomplete="off" placeholder="Select Expiry Date"
                                                            name="expiry_date" type="date" id="expiry_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="driver_status" class="form-label">Driver
                                                            Status</label>
                                                        <select class="form-control" required="required"
                                                            id="driver_status" name="driver_status">
                                                            <option selected="selected" value="">Select Driver Status
                                                            </option>
                                                            <option value="Active">Active</option>
                                                            <option value="Inactive">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="Working_time" class="form-label">Working
                                                            Time</label>
                                                        <input class="form-control" required="required"
                                                            placeholder="10:00AM - 6:00PM" name="Working_time"
                                                            type="text" id="Working_time">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="address" class="form-label">Address</label>
                                                    <textarea class="form-control" placeholder="Enter Driver Address"
                                                        required="required" rows="3" name="address" cols="50"
                                                        id="address"></textarea>
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

                    <!-- Edit popup form -->
                    <!-- ############################################################################################################################################################# -->
                    <div class="modal fade" id="editDriverModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Driver</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="fleet_update_driver.php" accept-charset="UTF-8"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_name" class="form-label">Name</label>
                                                        <input class="form-control" required="required" name="edit_name"
                                                            type="text" id="edit_name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_email" class="form-label">Email</label>
                                                        <input class="form-control" required="required"
                                                            name="edit_email" type="email" id="edit_email">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_mobile" class="form-label">Mobile
                                                            Number</label>
                                                        <input class="form-control" required="required"
                                                            name="edit_mobile" type="text" id="edit_mobile">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_dob" class="form-label">Date of Birth</label>
                                                        <input class="form-control" required="required"
                                                            autocomplete="off" name="edit_dob" type="date"
                                                            id="edit_dob">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_join_date" class="form-label">Join Date</label>
                                                        <input class="form-control" required="required"
                                                            autocomplete="off" name="edit_join_date" type="date"
                                                            id="edit_join_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_lincese_number" class="form-label">License
                                                            Number</label>
                                                        <input class="form-control" required="required"
                                                            name="edit_lincese_number" type="text"
                                                            id="edit_lincese_number">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_lincese_type" class="form-label">License
                                                            Type</label>
                                                        <select class="form-control" required="required"
                                                            id="edit_lincese_type" name="edit_lincese_type">
                                                            <option value="Commercial Driver's License">Commercial
                                                                Driver's License</option>
                                                            <option value="Motorcycle License">Motorcycle License
                                                            </option>
                                                            <option value="Boat License">Boat License</option>
                                                            <option value="Aircraft Pilot's License">Aircraft Pilot's
                                                                License</option>
                                                            <option value="Taxi or Ride-Share License">Taxi or
                                                                Ride-Share License</option>
                                                            <option value="Recreational Vehicle License">Recreational
                                                                Vehicle License</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_expiry_date" class="form-label">License Expire
                                                            Date</label>
                                                        <input class="form-control" required="required"
                                                            autocomplete="off" name="edit_expiry_date" type="date"
                                                            id="edit_expiry_date">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_driver_status" class="form-label">Driver
                                                            Status</label>
                                                        <select class="form-control" required="required"
                                                            id="edit_driver_status" name="edit_driver_status">
                                                            <option selected="selected" value="">Select Driver Status
                                                            </option>
                                                            <option value="Active">Active</option>
                                                            <option value="Inactive">Inactive</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="edit_Working_time" class="form-label">Working
                                                            Time</label>
                                                        <input class="form-control" required="required"
                                                            name="edit_Working_time" type="text" id="edit_Working_time">
                                                    </div>
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label for="edit_address" class="form-label">Address</label>
                                                    <textarea class="form-control" required="required" rows="3"
                                                        name="edit_address" cols="50" id="edit_address"></textarea>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"
                                                name="fleet_update_customer">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ########################################################################################################################### -->
                    <!-- JavaScript and jQuery libraries -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                    <script>
                        $(document).ready(function () {
                            console.log('Script executed!');
                            $(document).on('click', '.editbtn', function () {
                                var mobile = $(this).data('id');
                                var name = $(this).data('name');
                                var email = $(this).data('email');
                                var dob = $(this).data('dob');
                                var join_date = $(this).data('join_date');
                                var lincese_number = $(this).data('lincese_number');
                                var lincese_type = $(this).data('lincese_type');
                                var expiry_date = $(this).data('expiry_date');
                                var driver_status = $(this).data('driver_status');
                                var Working_time = $(this).data('working_time');
                                var address = $(this).data('address');
                                $('#edit_mobile').val(mobile);
                                $('#edit_name').val(name);
                                $('#edit_email').val(email);
                                $('#edit_dob').val(dob);
                                $('#edit_join_date').val(join_date);
                                $('#edit_lincese_number').val(lincese_number);
                                $('#edit_lincese_type').val(lincese_type);
                                $('#edit_expiry_date').val(expiry_date);
                                $('#edit_driver_status').val(driver_status);
                                $('#edit_Working_time').val(Working_time);
                                $('#edit_address').val(address);
                                $('#editDriverModal').modal('show');
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