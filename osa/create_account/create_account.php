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




  <form action="/submit_registration.php" method="post">
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
  
  
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
