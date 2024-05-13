<?php
if (isset($_GET['id'])) {
    $blNumber = $_GET['id'];
    
    // Fetch the location (URL) of the HTML document from the database based on the ID
    $query = "SELECT location FROM invoice_commercial WHERE bl_no = '$blNumber'";
    $result = mysqli_query($link, $query);
    
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        echo $row['location'];
    } else {
        echo "Location not found.";
    }
}
?>