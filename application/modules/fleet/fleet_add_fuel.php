<?php
require_once "layouts/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (isset($_POST['driver_name'], $_POST['vehicle_name'], $_POST['fuel_type'], $_POST['fueling_date'], $_POST['gallons_liters'], $_POST['cost_liter'], $_POST['total_cost'], $_POST['odometer'], $_POST['note'])) {
        $driver_name = $_POST['driver_name'];
        $vehicle_name = $_POST['vehicle_name'];
        $fuel_type = $_POST['fuel_type'];
        $fueling_date = $_POST['fueling_date'];
        $gallons_liters = $_POST['gallons_liters'];
        $cost_liter = $_POST['cost_liter'];
        $total_cost = $_POST['total_cost'];
        $odometer = $_POST['odometer'];
        $note = $_POST['note'];

        // Prepare and execute SQL query to insert data
        $query = "INSERT INTO fleet_fuel (driver_name, vehicle_name, fuel_type, fueling_date,gallons_liters,cost_liter,total_cost,odometer,note) VALUES (?, ?, ?, ?,?, ?, ?, ? ,?)";
        $stmt = $link->prepare($query);
        $stmt->bind_param("sssssssss", $driver_name, $vehicle_name, $fuel_type, $fueling_date, $gallons_liters, $cost_liter, $total_cost, $odometer, $note);

        if ($stmt->execute()) {
            echo '<script>alert("Customer Saved Successfully")</script>';
            echo "Data saved successfully.";
            header("Location: fleet_fuel.php");
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