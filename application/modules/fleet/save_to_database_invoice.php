
<?php
// Establish database connection
include 'layouts/config.php';  // Include your database connection file

// Get BL No and Shipper's name from AJAX request
$blNo = $_POST['blNo'];
$shipperName = $_POST['shipperName'];

// Prepare and execute SQL query to insert data
$query = "INSERT INTO invoice_commercial(bl_no, location) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $blNo, $shipperName);

if ($stmt->execute()) {
    echo "Data saved successfully.";
} else {
    echo "Error saving data.";
}

// Close the database connection
$stmt->close();
$conn->close();
?>
