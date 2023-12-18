<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_project";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get eventId from the AJAX request
$eventId = $_GET['eventId'];

// Update the event in the database to mark it as approved
$sql = "UPDATE calendar_event_master SET is_approved = 2 WHERE event_id = $eventId"; // Adjust your query accordingly
if ($conn->query($sql) === TRUE) {
    echo "Event approved successfully!";
} else {
    echo "Error updating record: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
