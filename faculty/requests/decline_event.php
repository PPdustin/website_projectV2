<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_project";

// Get eventId and comment from the AJAX request
$eventId = $_GET['eventId'];
$comment = $_GET['comment'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare and bind the SQL statement with a parameter for comment
$sql = "UPDATE calendar_event_master SET is_approved = -1, comment = ? WHERE event_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $comment, $eventId); // "si" indicates that the first parameter is a string (comment), and the second parameter is an integer (eventId)

// Execute the statement
if ($stmt->execute()) {
    echo "Event declined successfully!";
} else {
    echo "Error updating record: " . $conn->error;
}

// Close the prepared statement and the database connection
$stmt->close();
$conn->close();
?>
