<?php
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Club</title>
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
		text-align: center;
		margin: 0;
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
	$club_name = $_GET['club_name'];
	echo "<h2>".$club_name."</h2>";
?>


 <table border="1" style="margin: auto; width: 500px;">
        <tr>
            <th>Name</th>
            <th>Position</th>
        </tr>
<?php
        // Your database connection code goes here
		$club_name = $_GET['club_name'];
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

        $sql = "SELECT student.first_name, student.last_name, position.position_id, position.position_name FROM student
		INNER JOIN club ON club.club_id = student.club 
		INNER JOIN position ON position.position_id = student.position
		WHERE club.club_name = '$club_name'";
		
		
		$position = $conn->query("SELECT * FROM position");
		$positions = array();
		while($pos = $position->fetch_assoc()){
			$positions[] = $pos['position_name'];
		}
		
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['first_name'] . " " . $row['last_name'] . "</td>";
                echo "<td>";
                echo "<form method='post' action='club_details.php?club_name=".$club_name."'>";
                echo "<input type='hidden' name='member_name' value='" . $row['first_name'] . " " . $row['last_name']. "'>";
                echo "<select name='new_position'>";
                echo "<option value=".$row['position_name'].">". $row['position_name']."</option>"; // Example options
				foreach($positions as $posit)
				{
					if($posit == $row['position_name'])
					{
						continue;
					}
					echo "<option value=".$posit.">".$posit."</option>";
				}
                echo "</select>";
                echo "<input style='margin-left: 50px;margin: 5px;'type='submit' value='Change'>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "No students";
        }
		
		
		
		
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$memberName = $_POST["member_name"];
			$newPosition = $_POST["new_position"];

			// Update the position in the database
			$sql = "UPDATE student SET position = (SELECT position_id FROM position WHERE position_name = '$newPosition') WHERE CONCAT(first_name, ' ', last_name )='$memberName'";
			if ($conn->query($sql) === TRUE) {
				$getParams = http_build_query($_GET);
			// Refresh the page with the GET parameters
			header("Location: ".$_SERVER['PHP_SELF'].'?'.$getParams, true, 302);
			//echo "<script>location.href = '".$_SERVER['PHP_SELF'].'?'.$getParams;
			exit;
			
			} else {
				echo "Error updating position: " . $conn->error;
			}
		}
		
		
		

        $conn->close();
?>
    </table>






    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
