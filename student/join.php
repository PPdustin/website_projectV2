<?php
session_start();
$first = $_SESSION["first_name"];
$last = $_SESSION["last_name"];
// Establish a database connection (replace with your credentials)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "website_project";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the selected club ID from the form
    $selectedClubID = $_POST["club"];
	
    // Validate and sanitize the input if needed

    // Insert the user's club selection into the database
    $insertSQL = "UPDATE student SET club = $selectedClubID WHERE first_name = '$first' AND last_name = '$last'"; // Assuming user_id is 1 for this example

    if ($conn->query($insertSQL) === TRUE) {
        echo "Joined the club successfully!";
    } else {
        echo "Error: " . $insertSQL . "<br>" . $conn->error;
    }
	
	
	$clubQ = "SELECT club_name FROM club WHERE club_id = $selectedClubID";
	$clubN = $conn->query($clubQ);
	$clubName = $clubN->fetch_assoc();
	$_SESSION['club'] = $clubName['club_name'];
	header("Location: club/club.php");
	exit();
}

// Query to retrieve available clubs
$sql = "SELECT club_id, club_name FROM club";
$result = $conn->query($sql);

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
    }
	h2{
		text-align: center;
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
          <a class="nav-link" href="./club/club.php">Club</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./calendar/dynamic-full-calendar.html">Calendar</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./request/request.php">Request Event</a>
        </li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item">
		  <form class="btn btn-logout" action="./logout.php" method="post">
		<input type="submit" name="submit_button" value="Logout">
		</form>
        </li>
      </ul>
    </div>
  </nav>
  
  
     <h2>Select Your Club</h2>
    <form style="max-width: 400px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
			margin: auto;" action="" method="post"> <!-- Submit the form to the same file -->
        <label for="club">Select a club:</label>
        <select name="club" id="club">
            <?php
            // Populate dropdown list with available clubs
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['club_id'] . "'>" . $row['club_name'] . "</option>";
            }
            ?>
        </select>
        <br><br>
        <input style="width: 100%;
            padding: 12px;
            border: none;
            border-radius: 5px;
            background-color: #0a541e;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;" type="submit" value="Join Club">
    </form>
	


  <!-- Bootstrap JS and dependencies -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
