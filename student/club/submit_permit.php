


<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Clubs Information System</title>
  <!-- Bootstrap CSS link (replace this with your own Bootstrap link if necessary) -->
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
	  text-align: center;
    }



    h2 {
      font-size: 24px;
      margin-bottom: 15px; /* Increased spacing */
      color: #0a541e; /* Club-related color */
    }

    p {
      font-size: 16px;
      line-height: 1.6;
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
	  
	      .submit-btn {
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Hide input type="file" */
    input[type="file"] {
        display: none;
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
  
<form action="insert_permit.php" method="post" enctype="multipart/form-data">  
<div class="drop-box" id="dropArea" style="width: 300px;
        height: 200px;
        border: 2px dashed #ccc;
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
        text-align: center;
        margin-bottom: 20px;
        cursor: pointer;
		margin: auto;
		margin-top: 30px;
		margin-bottom: 30px;">
    <input type="file" name="fileToExecute" id="fileInput">
    <label for="fileInput">Drag & Drop files here or click to select</label>
</div>
<button class="submit-btn" type="submit" name="submit">Submit</button>
</form>
  
  
  
  
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
$_SESSION['event_id'] = $_GET['eventId'];

// Update the event in the database to mark it as approved


// Close the database connection
$conn->close();
?>





<script>
    // Prevent default behavior for the drop area
    var dropArea = document.getElementById('dropArea');

    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    // Highlight drop area when a file is being dragged over it
    ['dragenter', 'dragover'].forEach(eventName => {
        dropArea.addEventListener(eventName, highlight, false);
    });

    ['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unhighlight, false);
    });

    function highlight(e) {
        dropArea.classList.add('highlight');
    }

    function unhighlight(e) {
        dropArea.classList.remove('highlight');
    }

    // Handle file drop
    dropArea.addEventListener('drop', handleDrop, false);

    function handleDrop(e) {
        var dt = e.dataTransfer;
        var files = dt.files;

        handleFiles(files);
    }

    function handleFiles(files) {
        // Handle file selection here if needed
        // For example: display file names or perform validation
    }
</script>




  <!-- Bootstrap JS and dependencies -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>









