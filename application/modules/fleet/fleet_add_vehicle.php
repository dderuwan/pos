<?php
require_once "layouts/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Establish database connection
    // Include your database connection file

    // Check if all expected POST data is available
    if (isset($_POST['vehicle_name'], $_POST['teacher'], $_POST['chassis_number'], $_POST['odometer'], $_POST['engine_tranmission'], $_POST['location'])) {
        $vehicle_name = $_POST['vehicle_name'];
        $teacher = $_POST['teacher'];
        $chassis_number = $_POST['chassis_number'];
        $odometer = $_POST['odometer'];
        $model_year = isset($_POST['model_year']) ? $_POST['model_year'] : null; // Make sure to handle model_year separately
        $engine_transmission = $_POST['engine_tranmission'];
        $location = $_POST['location'];

        // Prepare and execute SQL query to insert data
        $query = "INSERT INTO fleet_vehicle (vehicle_name, teacher, chassis_number, odometer, model_year, engine_transmission, location) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $link->prepare($query);

        // Bind parameters
        $stmt->bind_param("sssssss", $vehicle_name, $teacher, $chassis_number, $odometer, $model_year, $engine_transmission, $location);

        if ($stmt->execute()) {
            echo '<script>alert("Vehicle Saved Successfully")</script>';
            header("Location: fleet_vehicle.php");
            exit();  // Ensure no further processing after a redirect
        } else {
            echo '<script>alert("Vehicle Save Error")</script>';
            echo "Error saving data: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        // Display error message if not all required fields are filled
        echo '<script>alert("Please fill all required fields.")</script>';
        header("Location: fleet_vehicle.php"); // Redirect back to the form page
        exit();
    }

    // Close the database connection
    $link->close();
}
?>