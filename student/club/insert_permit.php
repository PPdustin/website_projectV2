<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Check if a file is selected
    if (isset($_FILES["fileToExecute"])) {
        $file = $_FILES["fileToExecute"];

        // Check for errors in the uploaded file
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Directory where the file will be saved
            $targetDirectory = "C:/xampp/htdocs/website_projectV2/permits/"; 
            // Generate a unique name for the file to avoid overwriting
            $targetFile = $targetDirectory . uniqid() . '_' . basename($file['name']);

            // Move the uploaded file to the desired directory
            if (move_uploaded_file($file['tmp_name'], $targetFile)) {
                // File was uploaded successfully

                // Database connection details
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "website_project";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Insert file details into the database
                $submitterName = $_SESSION['first_name']. " " .$_SESSION['last_name']; // Replace with the actual submitter's name
                $fileTitle = basename($file['name']); // You can also add a field for title/name of the file
				$club = $_SESSION['club'];
				$event = $_SESSION['event_id'];
                $sql = "INSERT INTO permit (event_id, submitted_by, file_title, file_path, club) VALUES ('$event', '$submitterName', '$fileTitle', '$targetFile', '$club');
				UPDATE calendar_event_master SET parents_permit = 'submitted' WHERE event_id = '$event';";

                if ($conn->multi_query($sql) === TRUE) {
                    echo "File uploaded and record inserted successfully.";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }

                $conn->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Error: " . $file['error'];
        }
    } else {
        echo "Please select a file to upload.";
    }
}
?>
