<?php
// Check if theform is submitted
if (isset($_POST['submit'])) {
    // Retrieve username and password from the form
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Connect to your database (replace these variables with your actual database credentials)
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $database = "website_project";

    // Create a connection
    $conn = new mysqli($servername, $db_username, $db_password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL query to check credentials
    $sql = "SELECT * FROM account WHERE user_name='$username' AND password='$password'";
    $result = $conn->query($sql);
	
    // Check if there's a matching row in the database
    if ($result->num_rows > 0) {
        $login = $result->fetch_assoc();
        echo "Login successful!";
        session_start();
		$_SESSION['user_type'] = $login['user_type'];
		
		
		if($_SESSION['user_type'] == 'student'){
			
			$user = $conn->query("SELECT account.first_name, account.last_name, account.user_type, club.club_name FROM account 
	INNER JOIN student ON student.first_name = account.first_name AND student.last_name = account.last_name 
	INNER JOIN club ON student.club = club.club_id
	WHERE account.user_name='$username' AND account.password='$password'");
	$row = $user->fetch_assoc();
			
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['last_name'] = $row['last_name'];
			$_SESSION['club'] = $row['club_name'];
		
			header("Location: ../student/calendar/dynamic-full-calendar.html");
			exit;
		}
		else if($_SESSION['user_type'] == 'osa'){
			echo "asdf";
			header("Location: ../osa/calendar/dynamic-full-calendar.html");
			exit;
		}
		else{
			$user = $conn->query("SELECT * FROM account WHERE user_name = '$username' AND password = '$password'");
			$row = $user->fetch_assoc();
			$_SESSION['first_name'] = $row['first_name'];
			$_SESSION['last_name'] = $row['last_name'];
			$_SESSION['clubs'] = array();
			$first = $row['first_name'];
			$last = $row['last_name'];
			$clubQ = $conn->query("SELECT club.club_name from club
			INNER JOIN faculty ON faculty.faculty_id = club.facilitator
			WHERE faculty.first_name = '$first' AND faculty.last_name = '$last'");
			if ($clubQ->num_rows > 0) {
				// Output data of each row
				while ($row = $clubQ->fetch_assoc()) {
					$_SESSION['clubs'][] = $row['club_name'];
				}
			} else {
				echo "0 results";
			}
			header("Location: ../faculty/calendar/dynamic-full-calendar.html");
			exit;
		}
		
    } else {
        // No matching user found
        echo "Invalid username or password";
    }

    // Close the database connection
    $conn->close();
}
?>
