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
	#container{
		height: 200px;
		background-image: url("./nddu.png");
		margin: auto;
		width: 600px;
		border-radius: 10px;
		text-align: center;
		align-items: center;
		justify-content: center;
		display: flex;
		margin-bottom: 20px;
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


<ul style="list-style-type: none;
            padding: 0;
            margin: 20px
			;">
 
		<?php
		
			if($_SESSION['clubs'] == [])
			{
				echo "No assigned clubs";
			}
			else {
				
				foreach ($_SESSION['clubs'] as $club) {
					
					echo "<div id='container'>";
					
					echo "<li style='margin-bottom: 10px;'><a style='text-decoration: none;
						color: #f5f5f5;
						font-weight: bold; font-size: 50px; ' href='club_details.php?club_name=" . urlencode($club) . "'>" . $club . "</a></li>";
						echo "</div>"; 
				}
				
			}



		?>
</ul>

 

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
