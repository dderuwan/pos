<?php
require_once "layouts/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all expected POST data is available
    if (isset($_POST['provider_name'], $_POST['vehicle_name'], $_POST['edit_start_date'], $_POST['edit_end_date'], $_POST['edit_recurring_date'], $_POST['edit_recurring_period'], $_POST['edit_insurance_deductible'], $_POST['edit_charge_payble'], $_POST['edit_policy_number'], $_POST['edit_policy_document'], $_POST['edit_note'])) {
        $provider_name = $_POST['provider_name'];
        $vehicle_name = $_POST['vehicle_name'];
        $start_date = $_POST['edit_start_date'];
        $end_date = $_POST['edit_end_date'];
        $recurring_date = $_POST['edit_recurring_date'];
        $recurring_period = $_POST['edit_recurring_period'];
        $insurance_deductible = $_POST['edit_insurance_deductible'];
        $charge_payble = $_POST['edit_charge_payble'];
        $policy_number = $_POST['edit_policy_number'];
        $policy_document = $_POST['edit_policy_document'];
        $note = $_POST['edit_note'];

        // Prepare and execute SQL query to update data
        $query = "UPDATE fleet_insurance SET provider_name=?, vehicle_name=?, start_date=?, end_date=?, recurring_date=?, recurring_period=?, insurance_deductible=?, charge_payble=?,policy_document=?, note=? WHERE policy_number=?";
        $stmt = $link->prepare($query);
        $stmt->bind_param("sssssssssss", $provider_name, $vehicle_name, $start_date, $end_date, $recurring_date, $recurring_period, $insurance_deductible, $charge_payble, $policy_document, $note, $policy_number);

        if ($stmt->execute()) {
            echo '<script>alert("Insurance Updated Successfully")</script>';
            header("Location: fleet_insurance.php");
            exit();  // Ensure no further processing after a redirect
        } else {
            echo '<script>alert("Insurance Update Error")</script>';
            echo "Error updating data: " . $stmt->error;
        }

        // Close the database connection
        $stmt->close();
    } else {
        echo '<script>alert("Please fill all required fields.")</script>';
    }
    $link->close();
}
?>