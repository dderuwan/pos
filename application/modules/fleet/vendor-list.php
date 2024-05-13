<?php
// Include necessary files and database connection
require_once "layouts/config.php";
include 'layouts/session.php';
include 'layouts/head-main.php';

// Fetch data from the database (example)
$query = "SELECT * FROM vendor";
$result = mysqli_query($link, $query);

if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // Prepare DELETE query and execute it
    $deleteQuery = "DELETE FROM vendor WHERE id = '$deleteId'";
    if (mysqli_query($link, $deleteQuery)) {
        // Redirect back to the main page after successful deletion
        header("Location: import-list-delivery-order-invoice.php");
        exit();
    } else {
        // Display an error message if deletion fails
        echo "Error deleting record: " . mysqli_error($link);
    }
}

// Handle data updates
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $vendorname = $_POST['vendorname'];
    $address = $_POST['address'];
    $phonenumber = $_POST['phonenumber'];


    // Perform validation and update the database
    // You should also perform proper input validation and error handling here

    $updateQuery = "UPDATE vendor SET vendorname = ?, address = ?, phonenumber = ?WHERE id = ?";
    $stmt = mysqli_prepare($link, $updateQuery);
    mysqli_stmt_bind_param($stmt, 'sssi', $vendorname, $address, $phonenumber,$id);

    if (mysqli_stmt_execute($stmt)) {
        // Update successful
        echo json_encode(['success' => true]);
        exit(); // Exit to prevent further HTML output
    } else {
        // Update failed
        echo json_encode(['success' => false, 'error' => mysqli_error($link)]);
        exit(); // Exit to prevent further HTML output
    }

    mysqli_stmt_close($stmt);
}
?>

<head>

    <title><?php echo $language["Editable"]; ?> | Fotilla- Admin & Dashboard </title>

    <?php include 'layouts/head.php'; ?>

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
                $title = "Vendor List";
                ?>
                <?php include 'layouts/breadcrumb.php'; ?>
                <!-- end page title -->


                <div class="row">
                    <div class="col-12">
                        <div class="card">

                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-editable table-nowrap align-middle table-edits">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Vendor Name</th>
                                                <th>Address</th>
                                                <th>Phone Number</th>
                                               
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                echo '<tr data-id="' . $row['id'] . '">';
                                                echo '<td data-field="id">' . $row['id'] . '</td>';
                                                echo '<td data-field="vendorname">' . $row['vendorname'] . '</td>';
                                                echo '<td data-field="address">' . $row['address'] . '</td>';
                                                echo '<td data-field="phonenumber">' . $row['phonenumber'] . '</td>';
                                              
                                                echo '<td style="width: 100px">';
                                                echo '<a class="btn btn-outline-secondary btn-sm edit" title="Edit">';
                                                echo '<i class="fas fa-pencil-alt"></i>';
                                                echo '</a>';
                                                echo '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->
                <script>
                    $(document).ready(function () {
                        $('.table-edits').Tabledit({
                            // The JavaScript code for handling updates is included here
                            url: 'shipper-list.php', // URL to the same file for handling updates
                            columns: {
                                identifier: [0, 'id'], // Column index and field name for the unique identifier
                                editable: [
                                    [1, 'vendorname'],
                                    [2, 'address'],
                                    [3, 'phonenumber'],
                
                                ]
                            },
                            restoreButton: false, // Set to true if you want to allow restoring edited data
                            onSuccess: function (data, textStatus, jqXHR) {
                                // Handle success after data update (if needed)
                                console.log(data);
                            },
                            onFail: function (jqXHR, textStatus, errorThrown) {
                                // Handle failure after data update (if needed)
                                console.error(errorThrown);
                            }
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
<!-- Table Editable plugin -->
<script src="assets/libs/table-edits/build/table-edits.min.js"></script>

<script src="assets/js/pages/table-editable.int.js"></script>

</body>

</html>
