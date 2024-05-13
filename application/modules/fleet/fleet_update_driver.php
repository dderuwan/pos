<?php
require_once "layouts/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all expected POST data is available
    if (isset($_POST['edit_name'], $_POST['edit_email'], $_POST['edit_mobile'], $_POST['edit_dob'], $_POST['edit_join_date'], $_POST['edit_lincese_number'], $_POST['edit_lincese_type'], $_POST['edit_expiry_date'], $_POST['edit_driver_status'], $_POST['edit_Working_time'], $_POST['edit_address'])) {
        $name = $_POST['edit_name'];
        $email = $_POST['edit_email'];
        $mobile = $_POST['edit_mobile'];
        $dob = $_POST['edit_dob'];
        $join_date = $_POST['edit_join_date'];
        $lincese_number = $_POST['edit_lincese_number'];
        $lincese_type = $_POST['edit_lincese_type'];
        $expiry_date = $_POST['edit_expiry_date'];
        $driver_status = $_POST['edit_driver_status'];
        $Working_time = $_POST['edit_Working_time'];
        $address = $_POST['edit_address'];

        // Prepare and execute SQL query to update data
        $query = "UPDATE fleet_driver SET name=?, email=?, dob=?, join_date=?, lincese_number=?, lincese_type=?, expiry_date=?, driver_status=?, Working_time=?, address=? WHERE mobile=?";
        $stmt = $link->prepare($query);
        $stmt->bind_param("sssssssssss", $name, $email, $dob, $join_date, $lincese_number, $lincese_type, $expiry_date, $driver_status, $Working_time, $address, $mobile);

        if ($stmt->execute()) {
            echo '<script>alert("Driver Updated Successfully")</script>';
            header("Location: fleet_driver.php");
            exit();  // Ensure no further processing after a redirect
        } else {
            echo '<script>alert("Driver Update Error")</script>';
            echo "Error updating driver: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo '<script>alert("Please fill all required fields.")</script>';
    }
}

// Close the database connection
$link->close();
?>