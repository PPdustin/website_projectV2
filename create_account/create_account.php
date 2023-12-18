<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Account Registration</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Updated theme color */
    body {
      background-image: url('images/nddu.png');
      background-color: #f5f5f5;
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      font-family: 'Verdana', sans-serif;
      color: #333;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }

    .container {
      width: 300px;
      background-color: rgba(255, 255, 255, 0.9);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #0a541e; /* Updated title color */
    }

    .form-control {
      background-color: #f8f9fa;
      border-color: #ced4da;
    }

    .btn-primary {
      background-color: #0a541e; /* Updated button color */
      border-color: #0a541e;
      width: 100%;
    }

    .btn-primary:hover {
      background-color: #08391b;
      border-color: #08391b;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Account Registration</h1>
    <form action="registration.php" method="post">
      <div class="form-group">
        <input type="text" id="username" class="form-control" name="username" placeholder="Username" required>
      </div>
      <div class="form-group">
        <input type="password" id="password" class="form-control" name="password" placeholder="Password" required>
      </div>
      <div class="form-group">
        <input type="text" id="firstName" class="form-control" name="firstName" placeholder="First Name" required>
      </div>
      <div class="form-group">
        <input type="text" id="lastName" class="form-control" name="lastName" placeholder="Last Name" required>
      </div>
      <div class="form-group">
        <label>Account Type:</label><br>
        <label for="student">
          <input type="radio" id="student" name="accountType" value="student" required> Student
        </label>
        <br>
        <label for="facilitator">
          <input type="radio" id="facilitator" name="accountType" value="facilitator" required> Facilitator
        </label>
      </div>
      <button type="submit" class="btn btn-primary">Create Account</button>
    </form>
  </div>

  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
