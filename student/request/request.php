





<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	session_start();
?>






<!DOCTYPE html>
<html lang="en">
<head>





  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Description</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      
      background-color: #f5f5f5; /* Fallback background color */
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      
      color: #333; /* Text color on the background */
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 500px;
      margin: 20px auto;
      background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background for form */
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow for a slight depth effect */
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #0a541e; /* Title color */
    }
	

    label {
      font-weight: bold;
    }

    .form-control {
      background-color: #f8f9fa; /* Light gray background for input fields */
      border-color: #ced4da; /* Border color */
    }

    .btn-primary {
      background-color: #0a541e; /* Dark green for button */
      border-color: #0a541e;
      width: 100%;
    }

    .btn-primary:hover {
      background-color: #08391b; /* Darker green on hover */
      border-color: #08391b;
    }
	
	
	
	
	/* Style for the navigation bar */
    .navbar {
      background-color: #0a541e;
      color: white;
    }

    .navbar-brand {
      color: white !important;
      font-weight: bold;
	  margin-right: 50px;
    }

    .navbar-nav .nav-item .nav-link {
      color: white !important;
      padding: 15px 25px;
      transition: background-color 0.3s;
      border-radius: 8px;
    }

    .navbar-nav .nav-item .nav-link:hover {
      background-color: #08391b;
    }

    .navbar-nav .nav-item:last-child {
      margin-right: 15px; /* Adjust the spacing between tabs and the logout button */
    }

    .btn-logout {
      color: white;
      background-color: #0a541e;
      border-color: #0a541e;
      transition: background-color 0.3s;
      border-radius: 8px;
      padding: 8px 20px;
    }

    .btn-logout:hover {
      background-color: #08391b;
      border-color: #08391b;
    }
  </style>
</head>
<body>



<?php include '../navigation.html'; ?>

<h5>
<?php

	$club = $_SESSION['club'];
	echo $club == "None" ;
?>

</h5>


  <!-- Bootstrap JS and dependencies -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>







  <div class="container">
  
    <h1>Event Request</h1>
    <form action="request.php" method="post" enctype="multipart/form-data">
      <div class="form-group">
        <label for="eventName">Event Name:</label>
        <input type="text" id="eventName" name="eventName" class="form-control">
      </div>
      

      <div class="form-group">
    <label for="eventVenue">Event Venue:</label>
    <select id="eventVenue" name="eventVenue" class="form-control">
        <option value="">Select Venue</option> <!-- Default option -->
        <?php
        // Connect to your database (replace with your database credentials)
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

        // Query to fetch event venues
        $sql = "SELECT facility_id, facility_name FROM facility";
        $result = $conn->query($sql);

        // Check if query returned any rows
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row["facility_id"] . "'>" . $row["facility_name"] . "</option>";
            }
        } else {
            echo "<option disabled>No venues found</option>";
        }

        // Close database connection
        $conn->close();
        ?>
    </select>
</div>

      
      <div class="form-group">
        <label for="eventStartDay">Event Day:</label>
        <input type="date" id="eventStartDay" name="eventStartDay" class="form-control">
      </div>






    <!-- Available time slots display -->
    <div class="form-group" id="availableTimeSlots">
        <!-- Available time slots will be displayed here -->
    </div>

      <div class="form-group">
        <label for="file">Upload Image:</label>
        <input type="file" name="file" id="file">
        <p>Scanned document of approval for event request is required.</p>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
	
	

    <?php
// Assuming you have a function to connect to your database
// Replace these with your actual database credentials
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

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  $file = $_FILES['file'];
  $fileTmpName = $file['tmp_name'];
  $fileExt = explode('.', $file['name']);
  $fileActualExt = strtolower(end($fileExt));
  $fileNameNew = uniqid('', true).".".$fileActualExt;

  $fileDestination = '../../uploads/'.$fileNameNew;
  move_uploaded_file($fileTmpName, $fileDestination);





    // Retrieve form data
    $eventName = $_POST["eventName"];
    $eventVenue = $_POST["eventVenue"];
    $eventStartDay = $_POST["eventStartDay"];
    
    $submitted_by = $_SESSION["first_name"] . " " . $_SESSION["last_name"];
    $is_approved = 0;
    $full_name = $_SESSION["first_name"]." ".$_SESSION["last_name"];

    // Check if at least one time slot is selected
    if (!empty($_POST['timeSlot'])) {
        $unique_id = crc32(uniqid('', true));
        $sql_cem = "INSERT INTO calendar_event_master (event_id, event_name, facility, event_start_date, is_approved, submitted_by, imagePath) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql_cem);
        $stmt->bind_param("sssssss", $unique_id, $eventName, $eventVenue, $eventStartDay, $is_approved, $full_name, $fileDestination);
        if ($stmt->execute()) {
          //echo "Request submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        foreach ($_POST['timeSlot'] as $selectedTimeSlot) {
            // Prepare the SQL statement for insertion
            //$sql = "INSERT INTO calendar_event_master (event_name, facility, event_start_date, is_approved, submitted_by, time_slot) VALUES (?, ?, ?, ?, ?, ?)";
            $sql = "INSERT INTO event_time_slot (event_id,  time_slot) VALUES (?, ?)";
            $stmt = $conn->prepare($sql);

            // Bind parameters and execute the statement
            $stmt->bind_param("ss", $unique_id, $selectedTimeSlot);

            // Execute the prepared statement
            if ($stmt->execute()) {
                //echo "Request submitted successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Close the statement
            $stmt->close();
        }
    } else {
        // Handle case when no time slot is selected
        echo "Please select at least one time slot.";
    }
}

// Close the database connection
$conn->close();
?>


    
	
	
  </div>

  <script>
  document.addEventListener('DOMContentLoaded', function() {
    const eventVenueSelect = document.getElementById('eventVenue');
    const eventStartDayInput = document.getElementById('eventStartDay');
    const availableTimeSlotsDiv = document.getElementById('availableTimeSlots');

    // Function to fetch available time slots
    async function fetchAvailableTimeSlots() {
        const venueId = eventVenueSelect.value;
        const eventDate = eventStartDayInput.value;
        
        // Check if both venue and event date are selected
        if (venueId && eventDate) {
            try {
                // Make AJAX request to get available time slots
                const response = await fetch(`get_available_timeslots.php?venueId=${venueId}&eventDate=${eventDate}`);
                const data = await response.json();

                // Check if request was successful
                if (data.success) {
                    // Extract time slots from data
                    const timeSlots = data.timeSlots;
                    // Update UI to display the fetched time slots as checkboxes
                    const timeSlotsHtml = timeSlots.map(slot => `<input type="checkbox" name="timeSlot[]" value="${slot}"> ${slot}<br>`).join('');
                    availableTimeSlotsDiv.innerHTML = `<p>Available Time Slots:</p>${timeSlotsHtml}`;
                } else {
                    // Handle failure case
                    availableTimeSlotsDiv.innerHTML = '<p>No available time slots found.</p>';
                }
            } catch (error) {
                // Handle error case
                console.error('Error fetching available time slots:', error);
                availableTimeSlotsDiv.innerHTML = '<p>Error fetching available time slots.</p>';
            }
        } else {
            // Clear time slots display if either venue or event date is not selected
            availableTimeSlotsDiv.innerHTML = '';
        }
    }

    // Event listeners for venue and date selection
    eventVenueSelect.addEventListener('change', fetchAvailableTimeSlots);
    eventStartDayInput.addEventListener('change', fetchAvailableTimeSlots);
});


  </script>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>