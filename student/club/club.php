<?php
	session_start();
	$club = $_SESSION['club'];
	if($club == "None")
	{
		header("Location: ../join.php");
		exit();
	}
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

        .approve-btn {
            padding: 5px 10px;
            border: none;
            background-color: #0a541e;
            color: white;
            cursor: pointer;
            border-radius: 3px;
        }

        
        
.unapproved-events-list {
    list-style-type: none;
    padding: 0;
}

.unapproved-events-list li {
    margin-bottom: 10px;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.unapproved-events-list li .comment {
    color: #666;
    font-style: italic;
}


	  
  </style>
</head>
<body>



<?php include '../navigation.html'; ?>




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
		$club_act = $conn->query("SELECT calendar_event_master.event_id, calendar_event_master.parents_permit, calendar_event_master.is_approved, club.club_name, calendar_event_master.event_name, calendar_event_master.event_start_date, calendar_event_master.event_end_date, calendar_event_master.submitted_by FROM calendar_event_master
		INNER JOIN student ON calendar_event_master.submitted_by = CONCAT(student.first_name, ' ' , student.last_name)
		INNER JOIN club ON club_id = student.club
		WHERE club.club_name = '$club' AND calendar_event_master.is_approved = 2 AND calendar_event_master.event_start_date > CURDATE()");
		if($club_act->num_rows > 0)
		{
			while ($row = $club_act->fetch_assoc()) {
				if($row['parents_permit'] == NULL)
				{
					echo "<li style='margin: 10px;'>" . $row['event_name'] . ' - ' . $row['event_start_date'] . '</li>';
				}
				else if($row['parents_permit'] == "required")
				{
					echo "<li style='margin: 10px;'>" . $row['event_name'] . ' - ' . $row['event_start_date'] . "<button style='padding: 5px 10px;
            border: none;
            background-color: #0a541e;
            color: white;
            cursor: pointer;
            border-radius: 3px;
			margin-left: 10px' class='approve-btn' onclick='requirePermit(" . $row["event_id"] . ")'>Submit Permit</button>".'</li>';
				}
				else if($row['parents_permit'] == "submitted")
				{
					$event = $row["event_id"];
					$permit = $conn->query("SELECT * from permit WHERE event_id = '$event'");
					while($per = $permit->fetch_assoc())
					{
						
						$submitted_by = $per["submitted_by"];
						$fileTitle = $per["file_title"];
						$filePath = $per["file_path"];
						echo "<li style='margin: 10px;'>" . $row['event_name'] . ' - ' . "<p><a href='$filePath' download>Download File</a></p>. </li>";	
					}
				}
			}
        }
		else{
			echo "None";
		}
		?>
	  </p>
    </div>
    <div class="box">
    <h2>Declined Events</h2>
<ul class="unapproved-events-list">
    <?php
    $conn = new mysqli("localhost", "root", "", "website_project");
    $firstName = $_SESSION['first_name'];
    $lastName = $_SESSION['last_name'];
    $club = $_SESSION['club'];
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $club_act = $conn->query("SELECT calendar_event_master.is_approved, calendar_event_master.comment, club.club_name, calendar_event_master.event_name, calendar_event_master.event_start_date, calendar_event_master.event_end_date, calendar_event_master.submitted_by FROM calendar_event_master
    INNER JOIN student ON calendar_event_master.submitted_by = CONCAT(student.first_name, ' ' , student.last_name)
    INNER JOIN club ON club_id = student.club
    WHERE club.club_name = '$club' AND calendar_event_master.is_approved = -1");
    if($club_act->num_rows > 0) {
        while ($row = $club_act->fetch_assoc()) {
            echo '<li><strong>' . $row['event_name'] . '</strong> - ' . $row['event_start_date'] . '<br><span class="comment">Comment: ' . $row['comment'] . '</span></li>';
        }
    } else {
        echo "<li>None</li>";
    }
    ?>
</ul>
  
      <script>
       function requirePermit(eventId) {
			// Send an AJAX request to update the event status
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
				if (this.readyState === 4 && this.status === 200) {
					// Request completed and successful, navigate to submit_permit.php with parameters
					var url = 'submit_permit.php?eventId=' + eventId;
					window.location.href = url;
				}
			};
			xhttp.open("GET", "submit_permit.php?eventId=" + eventId, true);
			xhttp.send();
		}
    </script>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
