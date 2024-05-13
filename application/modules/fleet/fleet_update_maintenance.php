<?php
require_once "layouts/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['edit_maintenance_id'], $_POST['edit_service_type'], $_POST['edit_service_for'], $_POST['edit_vehicle_name'], $_POST['edit_maintenance_type'], $_POST['edit_maintenance_service_name'], $_POST['edit_cost'], $_POST['edit_charge_bear_by'], $_POST['edit_maintenanc_date'], $_POST['edit_priority'], $_POST['edit_total_cost'], $_POST['edit_note'])) {

        $maintenance_id = $_POST['edit_maintenance_id'];
        $service_type = $_POST['edit_service_type'];
        $service_for = $_POST['edit_service_for'];
        $vehicle_name = $_POST['edit_vehicle_name'];
        $maintenance_type = $_POST['edit_maintenance_type'];
        $maintenance_service_name = $_POST['edit_maintenance_service_name'];
        $cost = $_POST['edit_cost'];
        $charge_bear_by = $_POST['edit_charge_bear_by'];
        $maintenanc_date = $_POST['edit_maintenanc_date'];
        $priority = $_POST['edit_priority'];
        $total_cost = $_POST['edit_total_cost'];
        $note = $_POST['edit_note'];

        // Prepare the SQL query to update the record based on maintenance_id
        $query = "UPDATE fleet_maintenance SET service_type=?, service_for=?, vehicle_name=?, maintenance_type=?, maintenance_service_name=?, cost=?, charge_bear_by=?, maintenanc_date=?, priority=?, total_cost=?, note=? WHERE maintenance_id=?";
        $stmt = $link->prepare($query);

        // Bind parameters to the prepared statement
        $stmt->bind_param("sssssssssssi", $service_type, $service_for, $vehicle_name, $maintenance_type, $maintenance_service_name, $cost, $charge_bear_by, $maintenanc_date, $priority, $total_cost, $note, $maintenance_id);

        // Execute the statement
        if ($stmt->execute()) {
            echo '<script>alert("Maintenance Record Updated Successfully")</script>';
            header("Location: fleet_maintenance.php");
            exit();
        } else {
            echo '<script>alert("Error updating Maintenance Record")</script>';
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