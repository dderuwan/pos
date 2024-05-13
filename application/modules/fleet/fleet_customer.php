<!DOCTYPE html>
<html lang="en">

<?php
// Include necessary files and database connection
require_once "layouts/config.php";
include 'layouts/session.php';
include 'layouts/head-main.php';

// Fetch data from the database (example)
$query = "SELECT * FROM fleet_customer";
$result = mysqli_query($link, $query);

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // Prepare DELETE query and execute it
    $deleteQuery = "DELETE FROM fleet_customer WHERE mobile = '$deleteId'";
    if (mysqli_query($link, $deleteQuery)) {
        // Redirect back to the main page after successful deletion
        header("Location:fleet_customer.php");
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
                    $title = "Customer";
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
                                                data-target="#addCustomerModal"><i class="fa fa-plus"></i> Add New</a>
                                        </div>
                                    </div>
                                    <table id="datatable"
                                        class="table table-bordered dt-responsive table-responsive w-100">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Address</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $rowNumber = 1;
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<tr>';
                                                echo '<td>' . $rowNumber++ . '</td>';
                                                echo '<td>' . $row['name'] . '</td>';
                                                echo '<td>' . $row['email'] . '</td>';
                                                echo '<td>' . $row['mobile'] . '</td>';
                                                echo '<td>' . $row['address'] . '</td>';
                                                echo '<td>
                                                <a href="#" class="btn btn-primary btn-sm editbtn" style="background-color:#3498db;color:white"
                                                data-id="' . $row['mobile'] . '" data-name="' . $row['name'] . '" data-email="' . $row['email'] . '" data-address="' . $row['address'] . '"> <i class="fas fa-edit"></i>Edit</a>
                                            <a href="?delete_id=' . $row['mobile'] . '" class="btn btn-danger btn-sm"> <i class="fas fa-trash"></i> Delete</a>
                                        </td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>


                                    </table>

                                </div>
                            </div>
                        </div> <!-- end col -->
                    </div> <!-- end row -->

                    <!-- Modal dialog structure -->
                    <div class="modal fade" id="addCustomerModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Create New Customer</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="fleet_add_customer.php" accept-charset="UTF-8"
                                        enctype="multipart/form-data">
                                        <input name="_token" type="hidden"
                                            value="Oc5WCGz8qQEif29mqWOD6fYTP4pe5ZA6X8GWfair">
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class="form-label">Name</label>
                                                        <input class="form-control" placeholder="Enter Customer Name"
                                                            required="required" name="name" type="text" id="name">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="email" class="form-label">Email</label>
                                                        <input class="form-control" placeholder="Enter Customer email"
                                                            required="required" name="email" type="email" id="email">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="mobile" class="form-label">Mobile Number</label>
                                                        <input class="form-control" placeholder="Enter Customer Number"
                                                            required="required" name="mobile" type="text" id="mobile">
                                                    </div>
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label for="address" class="form-label">Address</label>
                                                    <textarea class="form-control" placeholder="Enter Customer Address"
                                                        required="required" rows="3" name="address" cols="50"
                                                        id="address"></textarea>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary"
                                                name="add_customer">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- ############################################################################################## -->
                    <!-- Edit popup-->
                    <div class="modal fade" id="editModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Edit New Customer</h5>
                                    <button type="button" class="btn-close" data-dismiss="modal"
                                        aria-label="Close"></button>

                                </div>
                                <div class="modal-body">
                                    <form id="editForm" method="POST" action="fleet_update_customer.php"
                                        accept-charset="UTF-8" enctype="multipart/form-data">
                                        <input name="_token" type="hidden"
                                            value="Oc5WCGz8qQEif29mqWOD6fYTP4pe5ZA6X8GWfair">
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
                                                            name="edit_mobile" type="text" id="edit_mobile" readonly>
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
                    <!-- ############################################# ###########################################################-->
                    <!-- JavaScript and jQuery libraries -->
                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

                    <script>
                        $(document).ready(function () {
                            console.log('Script executed!');
                            $('.editbtn').on('click', function () {
                                var mobile = $(this).data('id');
                                var name = $(this).data('name');
                                var email = $(this).data('email');
                                var address = $(this).data('address');
                                $('#edit_mobile').val(mobile);
                                $('#edit_name').val(name);
                                $('#edit_email').val(email);
                                $('#edit_address').val(address);
                                $('#editModal').modal('show');
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


    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>

</body>

</html>