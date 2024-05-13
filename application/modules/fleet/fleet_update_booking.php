<?php
require_once "layouts/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit_customer_name'], $_POST['edit_vehicle_name'], $_POST['edit_start_date'], $_POST['edit_end_date'], $_POST['edit_join_date'], $_POST['edit_start_location'], $_POST['edit_end_location'], $_POST['edit_trip_type'], $_POST['edit_total_price'], $_POST['edit_trip_status'], $_POST['edit_note'])) {
        $customer_name = $_POST['edit_customer_name'];
        $vehicle_name = $_POST['edit_vehicle_name'];
        $start_date = $_POST['edit_start_date'];
        $end_date = $_POST['edit_end_date'];
        $join_date = $_POST['edit_join_date'];
        $start_location = $_POST['edit_start_location'];
        $end_location = $_POST['edit_end_location'];
        $trip_type = $_POST['edit_trip_type'];
        $total_price = $_POST['edit_total_price'];
        $trip_status = $_POST['edit_trip_status'];
        $note = $_POST['edit_note'];

        // Prepare the SQL query to update the record based on customer name
        $query = "UPDATE fleet_booking SET vehicle_name=?, start_date=?, end_date=?, join_date=?, start_location=?, end_location=?, trip_type=?, total_price=?, trip_status=?, note=? WHERE customer_name=?";
        $stmt = $link->prepare($query);
        // Bind parameters to the prepared statement
        $stmt->bind_param("sssssssssss", $vehicle_name, $start_date, $end_date, $join_date, $start_location, $end_location, $trip_type, $total_price, $trip_status, $note, $customer_name);

        // Execute the statement
        if ($stmt->execute()) {
            echo '<script>alert("Booking Updated Successfully")</script>';
            header("Location: fleet_booking.php");
            exit();
        } else {
            echo '<script>alert("Booking Update Error")</script>';
            echo "Error updating data: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo '<script>alert("Please fill all required fields.")</script>';
    }
    // Close the database connection
    $link->close();
}
?>