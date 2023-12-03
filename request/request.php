<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Event Description</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-image: url('images/nddu.png'); /* Use your preferred background image */
      background-color: #f5f5f5; /* Fallback background color */
      background-size: cover;
      background-repeat: no-repeat;
      background-attachment: fixed;
      font-family: 'Verdana', sans-serif; /* Change the font family */
      color: #333; /* Text color on the background */
      padding-top: 50px;
    }

    .container {
      max-width: 500px;
      margin: 0 auto;
      background-color: rgba(255, 255, 255, 0.9); /* Semi-transparent white background for form */
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow for a slight depth effect */
    }

    h1 {
      text-align: center;
      margin-bottom: 30px;
      color: #0a541e; /* Title color */
    }

    label {
      font-weight: bold;
    }

    .form-control {
      background-color: #f8f9fa; /* Light gray background for input fields */
      border-color: #ced4da; /* Border color */
    }

    .btn-primary {
      background-color: #0a541e; /* Dark green for button */
      border-color: #0a541e;
      width: 100%;
    }

    .btn-primary:hover {
      background-color: #08391b; /* Darker green on hover */
      border-color: #08391b;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Event Request</h1>
    <form action="request.php" method="post">
      <div class="form-group">
        <label for="eventName">Event Name:</label>
        <input type="text" id="eventName" class="form-control">
      </div>
      
      <div class="form-group">
        <label for="eventVenue">Event Venue:</label>
        <input type="text" id="eventVenue" class="form-control">
      </div>
      
      <div class="form-group">
        <label for="eventStartDay">Event Start Day:</label>
        <input type="date" id="eventStartDay" class="form-control">
      </div>
      
      <div class="form-group">
        <label for="eventEndDay">Event End Day:</label>
        <input type="date" id="eventEndDay" class="form-control">
      </div>

      <div class="form-group">
        <label for="eventDescription">Event Description:</label>
        <textarea id="eventDescription" class="form-control" rows="5"></textarea>
      </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
