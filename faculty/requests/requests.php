<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Requests</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Styles for the navigation bar */
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

        .decline-btn {
            padding: 5px 10px;
            border: none;
            background-color: #dc3545;
            color: white;
            cursor: pointer;
            border-radius: 3px;
            margin: 5px;
        }

        .decline-btn:hover {
            background-color: #c82333; /* Darker red on hover */
        }

        /* Styles for the comment box */
        .comment-box {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #fff;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            z-index: 9999;
        }

        .comment-content {
            position: relative;
        }

        .closeBtn {
            position: absolute;
            top: 5px;
            right: 10px;
            cursor: pointer;
        }

        .closeBtn:hover {
            color: #ff0000;
        }

        textarea {
            width: 100%;
            height: 100px;
            margin-bottom: 10px;
        }

        button {
            padding: 8px 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<?php include '../navigation.html'; ?>

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

    $first = $_SESSION['first_name'];
    $last = $_SESSION['last_name'];
    // Fetch events that need approval from the database
    $sql = "SELECT * FROM calendar_event_master
        INNER JOIN student ON CONCAT(student.first_name, ' ', student.last_name) = calendar_event_master.submitted_by
        INNER JOIN club ON club.club_id = student.club
        INNER JOIN faculty ON faculty.faculty_id = club.facilitator
        INNER JOIN facility ON calendar_event_master.facility = facility.facility_id
        WHERE faculty.first_name = '$first' AND faculty.last_name = '$last' AND calendar_event_master.is_approved = 0"; // Adjust your query accordingly
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Event Name</th><th>Event Date</th><th>Event Venue</th><th>Submitted by</th><th>Action</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["event_name"] . "</td>";
            echo "<td>" . $row["event_start_date"] . "</td>";
            echo "<td>" . $row["facility_name"] . "</td>";
            echo "<td>" . $row["submitted_by"] . "</td>";
            echo "<td>";
            echo "<button class='approve-btn' onclick=\"approveEvent('" . $row["event_id"] . "')\">Approve</button>";
            echo "<button class='decline-btn' onclick=\"openCommentBox('" . $row["event_id"] . "')\">Decline</button>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p style='margin: 20px; font-size: 30px;'>No events pending approval.</p>";
    }

    // Close the database connection
    $conn->close();
?>

<div id="commentBox" class="comment-box">
    <div class="comment-content">
        <span class="closeBtn" id="closeBtn">&times;</span>
        <h2>Leave a Comment</h2>
        <form>
            <textarea id="commentText" placeholder="Write your comment here..."></textarea>
            <input type="hidden" id="eventId">
            <button style="padding: 8px 16px;
        background-color: #0a541e; /* Change the background color to #0a541e */
        color: #fff; /* Text color */
        border: none;
        border-radius: 4px;
        cursor: pointer;    " type="button" onclick="submitComment()">Submit</button>
        </form>
    </div>
</div>

<script>
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
    // Function to open the comment box
    function openCommentBox(eventId) {
        // Pass the event ID to track which event is being declined
        // You can use this ID to send an AJAX request to the server if needed
        document.getElementById('commentBox').style.display = 'block';
        document.getElementById('eventId').value = eventId; // Set the event ID in a hidden input field
    }

    // Function to close the comment box
    document.getElementById('closeBtn').addEventListener('click', () => {
        document.getElementById('commentBox').style.display = 'none';
    });

    // Function to submit the comment
    function submitComment() {
        var eventId = document.getElementById('eventId').value; // Get the event ID
        var commentText = document.getElementById('commentText').value; // Get the comment text
        // Send a GET request to decline_event.php with the event ID and comment data
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                // Reload the page after handling the comment submission
                location.reload();
            }
        };
        xhttp.open("GET", "decline_event.php?eventId=" + eventId + "&comment=" + commentText, true);
        xhttp.send();
    }
</script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</body>
</html>
