<?php
require_once "layouts/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Establish database connection
    // Include your database connection file

    // Check if all expected POST data is available
    if (isset($_POST['name'], $_POST['email'], $_POST['mobile'], $_POST['address'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];

        // Prepare and execute SQL query to insert data
        $query = "INSERT INTO fleet_customer (name, email, mobile, address) VALUES (?, ?, ?, ?)";
        $stmt = $link->prepare($query);
        $stmt->bind_param("ssss", $name, $email, $mobile, $address);

        if ($stmt->execute()) {
            echo '<script>alert("Customer Saved Successfully")</script>';
            echo "Data saved successfully.";
            header("Location: fleet_customer.php");
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