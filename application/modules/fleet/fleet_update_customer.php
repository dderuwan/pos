<?php
require_once "layouts/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if all expected POST data is available
    if (isset($_POST['edit_name'], $_POST['edit_email'], $_POST['edit_mobile'], $_POST['edit_address'])) {
        $name = $_POST['edit_name'];
        $email = $_POST['edit_email'];
        $mobile = $_POST['edit_mobile'];
        $address = $_POST['edit_address'];

        // Prepare and execute SQL query to update data
        $query = "UPDATE fleet_customer SET name=?, email=?, address=? WHERE mobile=?";
        $stmt = $link->prepare($query);
        $stmt->bind_param("ssss", $name, $email, $address, $mobile);

        if ($stmt->execute()) {
            echo '<script>alert("Customer Updated Successfully")</script>';
            header("Location: fleet_customer.php");
            exit();  // Ensure no further processing after a redirect
        } else {
            echo '<script>alert("Customer Update Error")</script>';
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