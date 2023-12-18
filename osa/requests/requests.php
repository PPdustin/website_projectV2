<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Requests</title>
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
        /* Basic styles for better readability */
       

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .approve-btn {
            padding: 5px 10px;
            border: none;
            background-color: #0a541e;
            color: white;
            cursor: pointer;
            border-radius: 3px;
        }

        .approve-btn:hover {
            background-color: #08391b;
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

        // Fetch events that need approval from the database
        $sql = "SELECT CONCAT(faculty.first_name, ' ', faculty.last_name) AS fac, permit.file_title, permit.file_path, calendar_event_master.is_approved, calendar_event_master.parents_permit, club.club_name, student.first_name, student.last_name, calendar_event_master.event_id, calendar_event_master.event_name, calendar_event_master.event_start_date FROM calendar_event_master
		INNER JOIN student ON CONCAT(student.first_name, ' ', student.last_name) = calendar_event_master.submitted_by
		INNER JOIN club ON club.club_id = student.club
		INNER JOIN faculty ON faculty.faculty_id = club.facilitator
		LEFT JOIN permit ON calendar_event_master.event_id = permit.event_id
		WHERE (calendar_event_master.is_approved = 1 OR calendar_event_master.is_approved = 2) AND calendar_event_master.event_start_date > CURDATE()"; // Adjust your query accordingly
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
			echo "<p style='margin: 20px; font-size: 30px;'>Upcoming events</p>";
            echo "<table>";
            echo "<tr><th>Event Name</th><th>Event Date</th><th>Club</th><th>Facilitator</th><th>Action</th></tr>";

            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["event_name"] . "</td>";
                echo "<td>" . $row["event_start_date"] . "</td>";
				echo "<td>" . $row["club_name"] . "</td>";
				echo "<td>" . $row["fac"] . "</td>";
				if($row["is_approved"] == 1)
				{
					echo "<td><button class='approve-btn' onclick='approveEvent(" . $row["event_id"] . ")'>Approve</button></td>";
				}
				else if($row["is_approved"] == 2 and $row["parents_permit"] == NULL)
				{
					echo "<td><button class='approve-btn' onclick='requirePermit(" . $row["event_id"] . ")'>Require Permit</button></td>";
				}
				else if($row["is_approved"] == 2 and $row["parents_permit"] == "required")
				{
					echo "<td>Request sent</td>";
				}
				else if($row["is_approved"] == 2 and $row["parents_permit"] == "submitted")
				{
					$fileTitle = $row["file_title"];
					$filePath = $row["file_path"];
					echo "<td><p><a href='$filePath' download>Download File</a></p></td>";
				}
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "<p style='margin: 20px; font-size: 30px;'>No events pending approval.</p>";
        }

        // Close the database connection
        $conn->close();
    ?>

    <script>
        // Function to handle event approval
        function approveEvent(eventId) {
            // Send an AJAX request to update the event status
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Reload the page after approval
                    location.reload();
                }
            };
            xhttp.open("GET", "approve_event.php?eventId=" + eventId, true);
            xhttp.send();
        }
		function requirePermit(eventId) {
            // Send an AJAX request to update the event status
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Reload the page after approval
                    location.reload();
                }
            };
            xhttp.open("GET", "require_permit.php?eventId=" + eventId, true);
            xhttp.send();
        }
    </script>



    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
