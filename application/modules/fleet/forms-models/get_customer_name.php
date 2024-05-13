<?php
require_once "config.php";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if a phone number was sent via POST
    if (isset($_POST['phonenumber'])) {
        $phonenumber = $_POST['phonenumber'];

        // Prepare and execute SQL query to fetch customer name and address based on the selected contact number
        $query = "SELECT customername, address FROM customers WHERE phonenumber = ?";
        $stmt = $link->prepare($query);
        $stmt->bind_param("s", $phonenumber);

        if ($stmt->execute()) {
            $stmt->bind_result($customerName, $customerAddress); // Bind customerAddress as well
            if ($stmt->fetch()) {
                $response = array(
                    'customerName' => $customerName,
                    'customerAddress' => $customerAddress
                );
             
                echo json_encode($response);
            } else {
                // No matching customer found
                echo "Customer Not Found";
            }
        } else {
            // Error fetching data
            echo "Error fetching data.";
        }

        // Close the database connection
        $stmt->close();
    } else {
        // No phone number provided in the POST data
        echo "Phone number not provided.";
    }
} else {
    // Unsupported request method
    http_response_code(405); // Set a 405 Method Not Allowed status code
    echo "Method Not Allowed";
}

?>
