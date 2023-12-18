<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    

    /* Style for the navigation bar */
    .navbar {
      background-color: #0a541e;
      color: white;
	  margin-bottom: 30px;
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
	
	


	body {
		font-family: Arial, sans-serif;
		background-color: #f5f5f5;
		margin: 0;
	}

	form {
		max-width: 400px;
		padding: 20px;
		background-color: #fff;
		box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
		border-radius: 8px;
		display: flex;
		flex-direction: column;
		align-items: center;
		margin: auto;
	}

	label {
		color: #555;
		margin-bottom: 8px;
	}

	input[type="text"],
	textarea {
		padding: 8px;
		
		border: 1px solid #ccc;
		border-radius: 5px;
		width: 100%;
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
          <a class="nav-link" href="../calendar/dynamic-full-calendar.html">Calendar</a>
        </li>
		
		<li class="nav-item">
          <a class="nav-link" href="../create_account/create_account.php">Create Account</a>
        </li>
		
		<li class="nav-item">
          <a class="nav-link" href="../register/register.php">Register Club</a>
        </li>
		
		<li class="nav-item">
          <a class="nav-link" href="../requests/requests.php">Requests</a>
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




<body>
    <form action="register.php" method="post">
        <label for="clubName">Club Name:</label>
        <input type="text" id="clubName" name="clubName" required><br><br>
        
        <label for="clubDesc">Club Description:</label><br>
        <textarea id="clubDesc" name="clubDesc" rows="4" cols="50" required></textarea><br><br>
        
        
		 <label for="facilitator">Select Facilitator:</label>
        <select style="padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: calc(100% - 22px);
            /* Additional styles for appearance */
            font-size: 16px;
            color: #555;
            cursor: pointer;
            background-color: #fff;" id="facilitator" name="facilitator">
            <?php
            // Fetch facilitators from the database and populate the dropdown
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "website_project";

            $conn = new mysqli($servername, $username, $password, $dbname);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT faculty_id, first_name , last_name FROM faculty";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['faculty_id'] . "'>" . $row['first_name'] . " " . $row['last_name'] . "</option>";
                }
            }
            $conn->close();
            ?>
			
			
        </select>
		
		
		<input type="submit" value="Submit" style="width: 100%;
		padding: 12px;
		border: none;
		border-radius: 5px;
		background-color: #0a541e;
		color: #fff;
		cursor: pointer;
		transition: background-color 0.3s;">
		
		
		
    </form>
</body>
  <p style="text-align: center;">
<?php
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

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $clubName = $_POST["clubName"];
    $clubDesc = $_POST["clubDesc"];
	$faculty = $_POST["facilitator"];

    // SQL query to insert data into the database
    $sql = "INSERT INTO club (club_name, club_description, facilitator) VALUES ('$clubName', '$clubDesc', '$faculty')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
</p>
  
  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
