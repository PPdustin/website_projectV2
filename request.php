<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Description</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Some basic styling */
    body {
      /* Add your background image here */
      /* Example: */
      background-image: url('images/nddu.png'); 
      background-color: #4B5320; /* Army green color placeholder */
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      color: white; /* Text color on the background */
    }

    .container {
      margin-top: 50px;
    }

    /* Style for form elements */
    label {
      font-weight: bold;
    }

    .form-group {
      margin-bottom: 20px;
    }

    /* Button style */
    .btn-primary {
      background-color: #16a085; /* Darker green for button */
      border-color: #16a085;
    }

    .btn-primary:hover {
      background-color: #496D45; /* Lighter green on hover */
      border-color: #12876f;
    }

    /* Form input style */
    input[type="date"],
    textarea {
      background-color: rgba(255, 255, 255, 0.1); /* Transparent white */
      color: white; /* Text color for input fields */
    }

    /* Additional styles can be added as needed */
  </style>
</head>
<body>
  <div class="container">
    <h1>Event Request</h1>
    <div class="form-group">
      <label for="eventDay">Event Day:</label>
      <input type="date" id="eventDay" class="form-control">
    </div>

    <div class="form-group">
      <label for="eventDescription">Event Description:</label>
      <textarea id="eventDescription" class="form-control" rows="5"></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
