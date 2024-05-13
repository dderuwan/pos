<?php
require_once "layouts/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $required_fields = array('provider_name', 'vehicle_name', 'start_date', 'end_date', 'recurring_date', 'recurring_period', 'insurance_deductible', 'charge_payble', 'policy_number', 'note'); {
        $provider_name = $_POST['provider_name'];
        $vehicle_name = $_POST['vehicle_name'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $recurring_date = $_POST['recurring_date'];
        $recurring_period = $_POST['recurring_period'];
        $insurance_deductible = $_POST['insurance_deductible'];
        $charge_payble = $_POST['charge_payble'];
        $policy_number = $_POST['policy_number'];
        // Handle file upload for policy document
        $policy_document = $_FILES['policy_document']['name'];
        $note = $_POST['note'];

        // Check if policy document is uploaded
        if (empty($policy_document)) {
            echo '<script>alert("Please upload Policy Document")</script>';
        } else {
            // Move uploaded file to desired location
            $policy_document_tmp = $_FILES['policy_document']['tmp_name'];
            $policy_document_path = "uploads/" . basename($policy_document);
            move_uploaded_file($policy_document_tmp, $policy_document_path);

            // Prepare and execute SQL query to insert data
            $query = "INSERT INTO fleet_insurance (provider_name, vehicle_name,start_date, end_date,recurring_date,recurring_period,insurance_deductible,charge_payble,policy_number,policy_document, note ) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
            $stmt = $link->prepare($query);
            $stmt->bind_param("sssssssssss", $provider_name, $vehicle_name, $start_date, $end_date, $recurring_date, $recurring_period, $insurance_deductible, $charge_payble, $policy_number, $policy_document_path, $note);

            if ($stmt->execute()) {
                echo '<script>alert("Customer Saved Successfully")</script>';
                echo "Data saved successfully.";
                header("Location: fleet_insurance.php");
                exit(); // Ensure no further processing after a redirect
            } else {
                echo '<script>alert("Customer Save Error")</script>';
                echo "Error saving data: " . $stmt->error;
            }

            // Close the database connection
            $stmt->close();
        }
    }
    $link->close();
}
?>