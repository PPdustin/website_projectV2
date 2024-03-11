<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_project";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$venueId = $_GET['venueId'];
$eventDate = $_GET['eventDate'];

$sql = "SELECT time_slot FROM event_time_slot WHERE event_id IN (SELECT event_id FROM calendar_event_master WHERE facility = '$venueId' AND event_start_date = '$eventDate')";
$result = $conn->query($sql);

$availableTimeSlots_12 = [
    "6:00 am", "7:00 am", "8:00 am", "9:00 am", "10:00 am", "11:00 am",
    "12:00 pm", "1:00 pm", "2:00 pm", "3:00 pm", "4:00 pm", "5:00 pm", "6:00 pm"
];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $timeSlot = $row['time_slot'];
        // Check if the fetched time slot exists in the predefined array
        if (($key = array_search($timeSlot, $availableTimeSlots_12)) !== false) {
            unset($availableTimeSlots_12[$key]);
        }
    }
}

// Return JSON response with the remaining available time slots
echo json_encode(array('success' => true, 'timeSlots' => array_values($availableTimeSlots_12)));

$conn->close();
?>
