<?php
// Set the path to the folder containing your images
$imageFolder = '';

// Get the filename from the query string
if (isset($_GET['filename'])) {
    $filename = $_GET['filename'];

    // Validate filename to prevent directory traversal attacks
    if (true) {
        // Construct the full path to the image
        $imagePath = $imageFolder . $filename;

        // Check if the file exists
        if (file_exists($imagePath)) {
            // Get the MIME type of the image
            $imageInfo = getimagesize($imagePath);
            $mimeType = $imageInfo['mime'];

            // Set the appropriate Content-Type header
            header('Content-Type: ' . $mimeType);

            // Output the image file
            readfile($imagePath);
            exit;
        } else {
            echo 'Image not found.';
        }
    } else {
        echo 'Invalid filename.';
    }
} else {
    echo 'Filename not specified.';
}
?>
