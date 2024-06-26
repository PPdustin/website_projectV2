<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Account</title>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
	  
      
    }

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


    form {
      max-width: 450px;
      padding: 30px;
      background-color: #fff;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
	  margin: auto;
	 

	  
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 20px;
    }

    label {
      color: #555;
      display: block;
      margin: 8px;
    }

    input[type="text"],
    input[type="password"] {
      width: calc(100% - 12px);
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .radio-group {
      display: flex;
      align-items: center;
      margin: 15px;
    }

    input[type="radio"] {
      margin-right: 5px;
    }




  </style>
</head>
<body>



<?php include '../navigation.html'; ?>




  <form action="create_account.php" method="post">
    <h1>Create Account</h1>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br>
    
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br>
    
    <label for="firstname">First Name:</label>
    <input type="text" id="firstname" name="firstname" required><br>
    
    <label for="lastname">Last Name:</label>
    <input type="text" id="lastname" name="lastname" required><br>
    
    <div class="radio-group">
      <label>User Type:</label>
      <input type="radio" id="student" name="usertype" value="student" checked>
      <label for="student">Student</label>
      
      <input type="radio" id="faculty" name="usertype" value="faculty">
      <label for="faculty">Faculty</label>
    </div>
    
    <input type="submit" value="Submit" style="width: 100%;
      padding: 12px;
      border: none;
      border-radius: 5px;
      background-color: #0a541e;
      color: #fff;
      cursor: pointer;
      transition: background-color 0.3s;">
  </form>
  
  
  
  <p style="font-family: Arial, sans-serif;margin: auto;text-align: center;">
  <?php
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

	// Check if form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		// Get form data
		$username = $_POST['username'];
		$password = $_POST['password'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$usertype = $_POST['usertype'];

		// Prepare SQL statement to insert data into your table
		$sql = "INSERT INTO account (user_name, password, first_name, last_name, user_type)
				VALUES ('$username', '$password', '$firstname', '$lastname', '$usertype')";

		// Execute the SQL query
		if ($conn->query($sql) === TRUE) {
			//echo "New record created successfully";
		} else {
			echo "Error 1: " . $sql . "<br>" . $conn->error;
		}
		
		if($usertype == "student")
		{
			if ($conn->query("INSERT INTO student (first_name, last_name, course, club, position)
				VALUES ('$firstname', '$lastname', 1, 3, 7)") === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error 2: " . $sql . "<br>" . $conn->error;
		}
		}
		else if($usertype == "faculty")
		{
			if ($conn->query("INSERT INTO faculty (first_name, last_name)
				VALUES ('$firstname', '$lastname')") === TRUE) {
			echo "New record created successfully";
		} else {
			echo "Error 2: " . $sql . "<br>" . $conn->error;
		}
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
