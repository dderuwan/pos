<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['content']) && isset($_POST['filename'])) {
    $content = $_POST['content'];
    $filename = $_POST['filename']; // Retrieve the filename

    // Sanitize the filename to remove any potential harmful characters
    $sanitizedFilename = preg_replace("/[^a-zA-Z0-9_-]/", "", $filename);

    // Generate the file name
    $fileName = $sanitizedFilename . '.html';

    // Specify the file path in your project
    $filePath = 'assets/BILL OF DELIVERY ORDER/' . $fileName;

    // Save the content to the file
    file_put_contents($filePath, $content);

    // Return a response to the client
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}

?>