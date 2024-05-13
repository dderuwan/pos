<?php
require_once "layouts/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit_driver_name'], $_POST['edit_vehicle_name'], $_POST['edit_fuel_type'], $_POST['edit_fueling_date'], $_POST['edit_gallons_liters'], $_POST['edit_cost_liter'], $_POST['edit_total_cost'], $_POST['edit_odometer'], $_POST['edit_note'])) {
        $driver_name = $_POST['edit_driver_name'];
        $vehicle_name = $_POST['edit_vehicle_name'];
        $fuel_type = $_POST['edit_fuel_type'];
        $fueling_date = $_POST['edit_fueling_date'];
        $gallons_liters = $_POST['edit_gallons_liters'];
        $cost_liter = $_POST['edit_cost_liter'];
        $total_cost = $_POST['edit_total_cost'];
        $odometer = $_POST['edit_odometer'];
        $note = $_POST['edit_note'];


        // Prepare the SQL query to update the record based on customer name
        $query = "UPDATE  fleet_fuel SET driver_name=?, vehicle_name=?,fueling_date=?, gallons_liters=?, cost_liter=?, total_cost=?, odometer=?, note=? WHERE fuel_type=?";
        $stmt = $link->prepare($query);
        // Bind parameters to the prepared statement
        $stmt->bind_param("sssssssss", $driver_name, $vehicle_name, $fueling_date, $gallons_liters, $cost_liter, $total_cost, $odometer, $note, $fuel_type);

        // Execute the statement
        if ($stmt->execute()) {
            echo '<script>alert("Booking Updated Successfully")</script>';
            header("Location: fleet_fuel.php");
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