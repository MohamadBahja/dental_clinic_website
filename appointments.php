<?php
// Start session
session_start();

// Include the database connection file
require_once('db.php');

// Check if the user is authenticated
if (!isset($_SESSION['admin'])) {
    // Redirect to the login page if not authenticated
    header("Location: login.php");
    exit();
}

// Fetch appointment data from the database
$sql = "SELECT id, name, email, number, date, type FROM contact_form";
$result = $conn->query($sql);

// Check if the query was successful
if ($result) {
    $appointments = $result->fetch_all(MYSQLI_ASSOC);
} else {
    $error = $conn->error;
    // Handle the error appropriately (display an error message, log the error, etc.)
    echo "Error retrieving appointment data: $error";
}



// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background-color: #f4f4f4; /* Light background color */
        }

        .dashboard-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 80%; /* Adjusted width for better responsiveness */
            text-align: center;
            overflow-x: auto; /* Allow horizontal scrolling on small screens */
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            overflow: auto; /* Enable table scrolling on small screens */
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #00b8b8; /* Updated blue header color */
            color: #fff;
        }

        a.button-link {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #00b8b8; /* Updated blue button color */
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        a.button-link:hover {
            background-color: #008c8c; /* Darker blue color on hover */
        }

        .no-appointments {
            color: #555;
            margin-top: 20px;
        }

       
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>

        <h3>Appointments:</h3>
        <?php
        // Check if appointments data is available
        if (isset($appointments) && !empty($appointments)) {
            echo '<table>';
            echo '<tr><th>Name</th><th>Email</th><th>Number</th><th>Date</th><th>Type</th></tr>';
            foreach ($appointments as $index => $appointment) {
                $rowClass = ($index === 0) ? 'first-row' : '';
                echo '<tr class="' . $rowClass . '">';
                echo '<td>' . $appointment['name'] . '</td>';
                echo '<td>' . $appointment['email'] . '</td>';
                echo '<td>' . $appointment['number'] . '</td>';
                echo '<td>' . $appointment['date'] . '</td>';
                echo '<td>' . $appointment['type'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p class="no-appointments">No appointments found.</p>';
        }
        ?>

        <a href="admin_dashboard.php" class="button-link">Back to Dashboard</a>
    </div>

    <script>
        // Set timeout to trigger logout after 5 minutes of inactivity
        const logoutTimeout = 300000; // 5 minutes in milliseconds
        let logoutTimer;

        function resetLogoutTimer() {
            clearTimeout(logoutTimer);
            logoutTimer = setTimeout(logout, logoutTimeout);
        }

        function logout() {
            // Redirect to logout.php to perform the logout
            window.location.href = 'admin_login.php';
        }

        // Set up event listeners to reset the timer on user activity
        document.addEventListener('mousemove', resetLogoutTimer);
        document.addEventListener('keydown', resetLogoutTimer);

        // Initial setup of the timer
        resetLogoutTimer();
    </script>
</body>
</html>
