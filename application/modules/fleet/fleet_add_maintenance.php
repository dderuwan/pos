<?php
require_once "layouts/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Establish database connection
    // Include your database connection file

    // Check if all expected POST data is available
    if (isset($_POST['service_type'], $_POST['service_for'], $_POST['vehicle_name'], $_POST['maintenance_type'], $_POST['maintenance_service_name'], $_POST['cost'], $_POST['charge_bear_by'], $_POST['maintenanc_date'], $_POST['priority'], $_POST['total_cost'], $_POST['note'])) {
        $service_type = $_POST['service_type'];
        $service_for = $_POST['service_for'];
        $vehicle_name = $_POST['vehicle_name'];
        $maintenance_type = $_POST['maintenance_type'];
        $maintenance_service_name = $_POST['maintenance_service_name'];
        $cost = $_POST['cost'];
        $charge_bear_by = $_POST['charge_bear_by'];
        $maintenanc_date = $_POST['maintenanc_date'];
        $priority = $_POST['priority'];
        $total_cost = $_POST['total_cost'];
        $note = $_POST['note'];


        // Prepare and execute SQL query to insert data
        $query = "INSERT INTO fleet_maintenance (service_type, service_for, vehicle_name, maintenance_type,maintenance_service_name ,cost ,charge_bear_by ,maintenanc_date ,priority ,total_cost ,note) VALUES (?, ?, ?, ? ,?, ?, ?, ? ,?, ?, ?)";
        $stmt = $link->prepare($query);
        $stmt->bind_param("sssssssssss", $service_type, $service_for, $vehicle_name, $maintenance_type, $maintenance_service_name, $cost, $charge_bear_by, $maintenanc_date, $priority, $total_cost, $note);

        if ($stmt->execute()) {
            echo '<script>alert("Customer Saved Successfully")</script>';
            echo "Data saved successfully.";
            header("Location: fleet_maintenance.php");
            exit();  // Ensure no further processing after a redirect
        } else {
            echo '<script>alert("Customer Save Error")</script>';
            echo "Error saving data: " . $stmt->error;
        }

        // Close the database connection
        $stmt->close();
    } else {
        echo '<script>alert("Please fill all required fields.")</script>';
    }
    $link->close();
}
?>