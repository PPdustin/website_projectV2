<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Details</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Styles -->
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
            font-family: Arial, sans-serif; /* Font style */
        }
        .container {
            padding-top: 20px; /* Add some space at the top */
        }
        .event-details {
            background-color: #fff; /* White background for event details */
            padding: 20px; /* Add padding */
            border-radius: 10px; /* Rounded corners */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
        }
        h1, h2, h3 {
            color: #343a40; /* Dark gray for headings */
        }
        p {
            color: #6c757d; /* Medium gray for paragraphs */
        }
        ul {
            list-style-type: none; /* Remove bullet points */
            padding-left: 0; /* Remove default padding */
        }
        li {
            margin-bottom: 5px; /* Add space between list items */
        }
    </style>
</head>
<body>

<?php include '../navigation.html'; ?>

<div class="container">
    
    <div class="event-details">
        <?php
        
        // Check if event ID is provided in the URL
        if (isset($_GET['event_id'])) {
            // Get the event ID from the URL
            $event_id = $_GET['event_id'];
        
            // Database connection
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "website_project";
        
            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        
            // Fetch event details from the database based on the event ID
            $sql = "SELECT * FROM calendar_event_master
            INNER JOIN facility ON facility.facility_id = calendar_event_master.facility
            WHERE event_id = $event_id";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                // Display event details
                $row = $result->fetch_assoc();
                echo "<h2>" . $row['event_name'] . "</h2>";
                echo "<p><strong>Date:</strong> " . $row['event_start_date'] . "</p>";
                echo "<p><strong>Venue:</strong> " . $row['facility_name'] . "</p>";
                
        
                // Fetch time slots for the event from the database
                $sql_slots = "SELECT * FROM event_time_slot WHERE event_id = $event_id";
                $result_slots = $conn->query($sql_slots);
        
                if ($result_slots->num_rows > 0) {
                    echo "<h3>Time Slots:</h3>";
                    echo "<ul>";
                    while ($row_slot = $result_slots->fetch_assoc()) {
                        $start_time = date('h:i a', strtotime($row_slot['time_slot'])); // Convert start time to 12-hour format
                        $end_time = date('h:i a', strtotime('+1 hour', strtotime($row_slot['time_slot']))); // Calculate end time
                        echo "<li>$start_time - $end_time</li>";
                    }
                    echo "</ul>";
                } else {
                    echo "<p>No time slots found for this event.</p>";
                }
            } else {
                echo "<p>No event found with the provided ID.</p>";
            }
        
            // Close the database connection
            $conn->close();
        } else {
            echo "<p>No event ID provided.</p>";
        }
        ?>
    </div>
</div>

<!-- Bootstrap JS and jQuery -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
