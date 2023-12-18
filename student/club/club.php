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
    }

    .container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center; /* Centering the boxes */
      margin-top: 20px;
    }

    .box {
      background-color: #ffffff; /* White background for boxes */
      color: #333; /* Dark text color */
      width: 600px;
      padding: 20px;
      margin: 10px;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Slight shadow */
      transition: transform 0.3s ease-in-out; /* Smooth hover effect */
    }

    .box:hover {
      transform: translateY(-5px); /* Lift the box on hover */
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
	  
	  
	  
	  
	  .members-list {
  list-style-type: none;
  padding: 0;
}

.members-list li {
  margin-bottom: 8px;
  font-size: 16px;
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

  <div class="container">
    <div class="box">
      <h2>Club Name</h2>
      <p>
		<?php
		
		$conn = new mysqli("localhost", "root", "", "website_project");
		$firstName = $_SESSION['first_name'];
		$lastName = $_SESSION['last_name'];
		if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
		$club_name = $conn->query("SELECT club_name FROM club WHERE club_id = (SELECT club FROM student WHERE first_name = '$firstName' AND last_name = '$lastName')");
		if($club_name->num_rows > 0)
		{
			$row = $club_name->fetch_assoc();
			$_SESSION['club_name'] = $row['club_name'];
			echo $_SESSION['club_name'];
		}
	?>
	  </p>
    </div>
    <div class="box">
      <h2>Facilitator</h2>
      <p>
		<?php
		
		$conn = new mysqli("localhost", "root", "", "website_project");
		$firstName = $_SESSION['first_name'];
		$lastName = $_SESSION['last_name'];
		if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
		$club_name = $conn->query("SELECT first_name, last_name FROM faculty WHERE faculty_id = (SELECT facilitator FROM club WHERE club_id = (SELECT club FROM student WHERE first_name = '$firstName' AND last_name = '$lastName'))");
		if($club_name->num_rows > 0)
		{
			$row = $club_name->fetch_assoc();
			echo $row["first_name"]." ".$row['last_name'];
		}
		else{
			echo "None";
		}
	?>
	  </p>
    </div>
    <div class="box">
      <h2>Members</h2>
      <p class="members">
		<?php
		$club = $_SESSION['club_name'];
		$conn = new mysqli("localhost", "root", "", "website_project");
		$firstName = $_SESSION['first_name'];
		$lastName = $_SESSION['last_name'];
		if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
		$club_name = $conn->query("SELECT student.first_name, student.last_name, position.position_name FROM student
		INNER JOIN position on student.position = position.position_id
		WHERE student.club = (SELECT club_id FROM club WHERE club_name = '$club')");
		if($club_name->num_rows > 0)
		{
			while ($row = $club_name->fetch_assoc()) {
            echo '<li>' . $row['first_name'] . ' ' . $row['last_name'] . ' - ' . $row['position_name'] . '</li>';
        }
		}
		else{
			echo "None";
		}
	?>
	  </p>
    </div>
    <div class="box">
      <h2>Upcoming Events</h2>
      <p>
		<?php
			$conn = new mysqli("localhost", "root", "", "website_project");
		$firstName = $_SESSION['first_name'];
		$lastName = $_SESSION['last_name'];
		$club = $_SESSION['club'];
		if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
		$club_act = $conn->query("SELECT calendar_event_master.is_approved, club.club_name, calendar_event_master.event_name, calendar_event_master.event_start_date, calendar_event_master.event_end_date, calendar_event_master.submitted_by FROM calendar_event_master
		INNER JOIN student ON calendar_event_master.submitted_by = CONCAT(student.first_name, ' ' , student.last_name)
		INNER JOIN club ON club_id = student.club
		WHERE club.club_name = '$club' AND calendar_event_master.is_approved = 2");
		if($club_act->num_rows > 0)
		{
			while ($row = $club_act->fetch_assoc()) {
            echo '<li>' . $row['event_name'] . ' - ' . $row['event_start_date'] . '</li>';
			}
        }
		else{
			echo "None";
		}
		?>
	  </p>
    </div>
    <div class="box">
      <h2>Unapproved Events</h2>
      <p><p>
		<?php
			$conn = new mysqli("localhost", "root", "", "website_project");
		$firstName = $_SESSION['first_name'];
		$lastName = $_SESSION['last_name'];
		$club = $_SESSION['club'];
		if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
		$club_act = $conn->query("SELECT calendar_event_master.is_approved, club.club_name, calendar_event_master.event_name, calendar_event_master.event_start_date, calendar_event_master.event_end_date, calendar_event_master.submitted_by FROM calendar_event_master
		INNER JOIN student ON calendar_event_master.submitted_by = CONCAT(student.first_name, ' ' , student.last_name)
		INNER JOIN club ON club_id = student.club
		WHERE club.club_name = '$club' AND calendar_event_master.is_approved = 0");
		if($club_act->num_rows > 0)
		{
			while ($row = $club_act->fetch_assoc()) {
            echo '<li>' . $row['event_name'] . ' - ' . $row['event_start_date'] . '</li>';
			}
        }
		else{
			echo "None";
		}
		?></p>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
