<?php
require_once "layouts/config.php"; // Make sure this path is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all expected POST data is available
    if (isset($_POST['edit_vehicle_name'], $_POST['edit_teacher'], $_POST['edit_chassis_number'], $_POST['edit_odometer'], $_POST['edit_model_year'], $_POST['edit_engine_transmission'], $_POST['edit_location'])) {
        // Assign variables from POST data
        $vehicle_name = $_POST['edit_vehicle_name'];
        $teacher = $_POST['edit_teacher'];
        $chassis_number = $_POST['edit_chassis_number']; // Corrected field name
        $odometer = $_POST['edit_odometer'];
        $model_year = $_POST['edit_model_year'];
        $engine_transmission = $_POST['edit_engine_transmission'];
        $location = $_POST['edit_location'];

        // Prepare SQL query to update data
        $query = "UPDATE fleet_vehicle SET vehicle_name=?, teacher=?, odometer=?, model_year=?, engine_transmission=?, location=? WHERE chassis_number=?";
        $stmt = $link->prepare($query);
        // Ensure the parameters are in the correct order as in your SQL query
        $stmt->bind_param("sssssss", $vehicle_name, $teacher, $odometer, $model_year, $engine_transmission, $location, $chassis_number);

        if ($stmt->execute()) {
            echo '<script>alert("Vehicle Updated Successfully");</script>';
            // Redirect and stop script execution
            header("Location: fleet_vehicle.php");
            exit();
        } else {
            echo '<script>alert("Update Error: ' . htmlspecialchars($stmt->error) . '");</script>';
        }

        // Close statement and database connection
        $stmt->close();
    } else {
        echo '<script>alert("Please fill all required fields.")</script>';
    }
    $link->close();
}
?>