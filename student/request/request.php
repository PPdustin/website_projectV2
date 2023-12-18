





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
      background-image: url('images/nddu.png'); /* Use your preferred background image */
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



<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="#">Clubs Information System</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="../club/club.php">Club</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../calendar/dynamic-full-calendar.html">Calendar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../request/request.php">Request Event</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
		  <form class="btn btn-logout" action="../logout.php" method="post">
		<input type="submit" name="submit_button" value="Logout">
		</form>
        </li>
      </ul>
    </div>
  </nav>

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
    <form action="request.php" method="post">
      <div class="form-group">
        <label for="eventName">Event Name:</label>
        <input type="text" id="eventName" name="eventName" class="form-control">
      </div>
      
      <div class="form-group">
        <label for="eventVenue">Event Venue:</label>
        <input type="text" id="eventVenue" name="eventVenue" class="form-control">
      </div>
      
      <div class="form-group">
        <label for="eventStartDay">Event Start Day:</label>
        <input type="date" id="eventStartDay" name="eventStartDay" class="form-control">
      </div>
      
      <div class="form-group">
        <label for="eventEndDay">Event End Day:</label>
        <input type="date" id="eventEndDay" name="eventEndDay" class="form-control">
      </div>

     
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
	
	

	<?php
    // Check if the form was submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $eventName = $_POST["eventName"];
        $eventVenue = $_POST["eventVenue"];
        $eventStartDay = $_POST["eventStartDay"];
        $eventEndDay = $_POST["eventEndDay"];
		$submitted_by = $_SESSION["first_name"] . " " . $_SESSION["last_name"];
		$is_approved = 0;
		$full_name = $_SESSION["first_name"]." ".$_SESSION["last_name"];
        // Database connection configuration
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

        // Prepare the SQL statement for insertion
        $sql = "INSERT INTO calendar_event_master (event_name, venue, event_start_date, event_end_date, is_approved, submitted_by) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters and execute the statement
        $stmt->bind_param("ssssss", $eventName, $eventVenue, $eventStartDay, $eventEndDay, $is_approved, $full_name);

        // Execute the prepared statement
        if ($stmt->execute()) {
            echo "Request submitted successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    }
?>

    
	
	
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
