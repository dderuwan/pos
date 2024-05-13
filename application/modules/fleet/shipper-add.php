<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php
require_once "layouts/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Establish database connection
    // Include your database connection file

    // Get Customer Name, Address, Phone Number, and Budget from POST data
    $shippername = $_POST['shippername'];
    $address = $_POST['address'];
    $phonenumber = $_POST['phonenumber'];

    
    // Prepare and execute SQL query to insert data
    $query = "INSERT INTO shippers(shippername, address, phonenumber) VALUES (?, ?, ?)";
    $stmt = $link->prepare($query);
    $stmt->bind_param("sss", $shippername, $address, $phonenumber);
    
    if ($stmt->execute()) {
        echo '<script>alert("Customer Saved Successfully")</script>';
        echo "Data saved successfully.";
        header("Location: shipper-list.php");
    } else {
        echo '<script>alert("Customer Save Error")</script>';
        echo "Error saving data.";
    }

    // Close the database connection
    $stmt->close();
    $link->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Create Shipper | New Shaheen LLC - Admin & Dashboard</title>
    <?php include 'layouts/head.php'; ?>
    <!-- datepicker css -->
    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <?php include 'layouts/head-style.php'; ?>
</head>
<body>
    <?php include 'layouts/body.php'; ?>
    <div id="layout-wrapper">
        <?php include 'layouts/menu.php'; ?>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mb-4">Add New Shipper</h4>
                                    <form method="post">
                                        <div class="form-group row mb-4">
                                            <label for="shippername" class="col-form-label col-lg-2">Shipper Name</label>
                                            <div class="col-lg-10">
                                                <input id="shippername" name="shippername" type="text" class="form-control" placeholder="Enter Shipper Name...">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label for="address" class="col-form-label col-lg-2">Address</label>
                                            <div class="col-lg-10">
                                                <input id="address" name="address" type="text" class="form-control" placeholder="Enter Address...">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label for="phonenumber" class="col-form-label col-lg-2">Phone Number</label>
                                            <div class="col-lg-10">
                                                <input id="phonenumber" name="phonenumber" type="text" class="form-control" placeholder="Enter Phone Number...">
                                            </div>
                                        </div>
                                        <div class="row justify-content-end">
                                            <div class="col-lg-10">
                                                <button type="submit" class="btn btn-primary">Add Customer</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'layouts/footer.php'; ?>
    </div>
    <!-- END layout-wrapper -->
    <?php include 'layouts/right-sidebar.php'; ?>
    <?php include 'layouts/vendor-scripts.php'; ?>
    <!-- bootstrap datepicker -->
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- tinymce js -->
    <script src="assets/libs/tinymce/tinymce.min.js"></script>
    <!-- form repeater js -->
    <script src="assets/libs/jquery.repeater/jquery.repeater.min.js"></script>
    <script src="assets/js/pages/task-create.init.js"></script>
</body>
</html>
