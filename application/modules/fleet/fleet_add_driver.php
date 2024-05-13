<?php
require_once "layouts/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all expected POST data is available
    if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['dob'], $_POST['join_date'], $_POST['lincese_number'], $_POST['lincese_type'], $_POST['expiry_date'], $_POST['driver_status'], $_POST['Working_time'], $_POST['address'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $dob = $_POST['dob'];
        $join_date = $_POST['join_date'];
        $lincese_number = $_POST['lincese_number'];
        $lincese_type = $_POST['lincese_type'];
        $expiry_date = $_POST['expiry_date'];
        $driver_status = $_POST['driver_status'];
        $Working_time = $_POST['Working_time'];
        $address = $_POST['address'];

        // Prepare and execute SQL query to insert data
        $query = "INSERT INTO fleet_driver (name, email, mobile, dob, join_date, lincese_number, lincese_type, expiry_date, driver_status, Working_time, address) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $link->prepare($query);
        $stmt->bind_param("sssssssssss", $name, $email, $mobile, $dob, $join_date, $lincese_number, $lincese_type, $expiry_date, $driver_status, $Working_time, $address);

        if ($stmt->execute()) {
            echo '<script>alert("Driver Saved Successfully")</script>';
            header("Location: fleet_driver.php");
            exit();  // Ensure no further processing after a redirect
        } else {
            echo '<script>alert("Driver Save Error")</script>';
            echo "Error saving driver: " . $stmt->error;
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