<?php
require_once "layouts/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all expected POST data is available
    if (isset($_POST['customer_name'], $_POST['vehicle_name'], $_POST['start_date'], $_POST['end_date'], $_POST['join_date'], $_POST['start_location'], $_POST['end_location'], $_POST['trip_type'], $_POST['total_price'], $_POST['trip_status'], $_POST['note'])) {
        $customer_name = $_POST['customer_name'];
        $vehicle_name = $_POST['vehicle_name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $join_date = $_POST['join_date'];
        $start_location = $_POST['start_location'];
        $end_location = $_POST['end_location'];
        $trip_type = $_POST['trip_type'];
        $total_price = $_POST['total_price'];
        $trip_status = $_POST['trip_status'];
        $note = $_POST['note'];

        // Prepare and execute SQL query to insert data
        $query = "INSERT INTO fleet_booking (customer_name, vehicle_name, start_date, end_date ,join_date,start_location,end_location,trip_type,total_price,trip_status,note ) VALUES (?, ?, ?, ?,?, ?, ?,?,?,?,?)";
        $stmt = $link->prepare($query);
        $stmt->bind_param("sssssssssss", $customer_name, $vehicle_name, $start_date, $end_date, $join_date, $start_location, $end_location, $trip_type, $total_price, $trip_status, $note);

        if ($stmt->execute()) {
            echo '<script>alert("Booking Saved Successfully")</script>';
            header("Location: fleet_booking.php");
            exit();  // Ensure no further processing after a redirect
        } else {
            echo '<script>alert("Booking Save Error")</script>';
            echo "Error saving booking: " . $stmt->error;
        }

        // Close the database connection
        $stmt->close();
    } else {
        echo '<script>alert("Please fill all required fields.")</script>';
    }
}
?>