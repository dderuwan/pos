<?php include 'layouts/session.php'; ?>
<?php include 'layouts/head-main.php'; ?>
<?php
require_once "layouts/config.php";

// Check if the customer ID is provided in the URL
if (isset($_GET['phonenumber'])) {
    $customerphonenumber = $_GET['phonenumber'];

    // Retrieve customer information from the database
    $query = "SELECT * FROM customers WHERE phonenumber = ?";
    $stmt = $link->prepare($query);
    $stmt->bind_param("i", $customerphonenumber);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Fetch customer data
        $row = $result->fetch_assoc();
        $customername = $row['customername'];
        $address = $row['address'];
        $phonenumber = $row['phonenumber'];

        // Close the prepared statement
        $stmt->close();
    } else {
        // Customer not found, handle the error
        echo "Customer not found.";
        exit;
    }
} else {
    // Customer ID not provided in the URL, handle the error
    echo "Customer ID not provided.";
    exit;
}

// Handle form submission for updating customer information
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get updated customer information from POST data
    $customername = $_POST['customername'];
    $address = $_POST['address'];
    $phonenumber = $_POST['phonenumber'];

    // Prepare and execute SQL query to update customer data
    $updateQuery = "UPDATE customers SET customername = ?, address = ? WHERE phonenumber = ?";
    $stmt = $link->prepare($updateQuery);
    $stmt->bind_param("sss", $customername, $address, $phonenumber);

    if ($stmt->execute()) {
        echo '<script>alert("Customer Updated Successfully")</script>';
        echo "Data updated successfully.";
        header("Location: customer-list.php");
    } else {
        echo '<script>alert("Customer Update Error")</script>';
        echo "Error updating data.";
    }

    // Close the database connection
    $stmt->close();
    $link->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Customer | Dason - Admin & Dashboard Template</title>
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
                                    <h4 class="card-title mb-4">Edit Customer</h4>
                                    <form method="post">
                                        <div class="form-group row mb-4">
                                            <label for="customername" class="col-form-label col-lg-2">Customer
                                                Name</label>
                                            <div class="col-lg-10">
                                                <input id="customername" name="customername" type="text"
                                                    class="form-control" placeholder="Enter Customer Name..."
                                                    value="<?php echo $customername; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label for="address" class="col-form-label col-lg-2">Address</label>
                                            <div class="col-lg-10">
                                                <input id="address" name="address" type="text" class="form-control"
                                                    placeholder="Enter Address..." value="<?php echo $address; ?>">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-4">
                                            <label for="phonenumber" class="col-form-label col-lg-2">Phone
                                                Number</label>
                                            <div class="col-lg-10">
                                                <input id="phonenumber" name="phonenumber" type="text" readonly
                                                    class="form-control" placeholder="Enter Phone Number..."
                                                    value="<?php echo $phonenumber; ?>">
                                            </div>
                                        </div>

                                        <div class="row justify-content-end">
                                            <div class="col-lg-10">
                                                <button type="submit" class="btn btn-primary">Update Customer</button>
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