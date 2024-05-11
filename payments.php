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

// Fetch payment data from the database
$sql = "SELECT id, name, price, type FROM contact_form"; // Assuming 'payments' is the correct table name
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if ($result) {
    $payments = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    $error = mysqli_error($conn);
    // Handle the error appropriately (display an error message, log the error, etc.)
    echo "Error retrieving payment data: $error";
}

// Handle payment deletion
$deleteMessage = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $paymentId = $_POST['delete'];

    // Perform deletion from the database (adjust table name if needed)
    $deleteQuery = "DELETE FROM contact_form WHERE id = '$paymentId'"; // Assuming 'payments' is the correct table name
    if ($conn->query($deleteQuery) === TRUE) {
        $deleteMessage = "<p style='color: green;'>Payment successfully happend </p>";
    } else {
        $deleteMessage = "<p style='color: red;'>Error deleting payment: " . $conn->error . "</p>";
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payments</title>
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
            width: 800px; /* Adjusted width for better readability */
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        h3 {
            color: #333;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #00b8b8; /* Blue background color for header cells */
            color: #fff; /* White text color for header cells */
        }

        tr:first-child {
            background-color: #00b8b8; /* Blue background color for the first row cells */
            color: #fff; /* White text color for the first row cells */
        }

        p {
            margin-top: 20px;
        }

        a.button-link {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 20px;
            background-color: #00b8b8; /* Updated to use the provided blue color */
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        a.button-link:hover {
            background-color: #008080; /* Darker blue color on hover (adjust if needed) */
        }

        .delete-button {
            background-color: #e74c3c; /* Red button color for delete */
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 5px;
        }

        .delete-button:hover {
            background-color: #c0392b; /* Darker red color on hover */
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2>Welcome, <?php echo $_SESSION['admin']; ?>!</h2>

        <!-- Display delete message at the top -->
        <div class="delete-message"><?php echo $deleteMessage; ?></div>

        <h3>Payments:</h3>
        <?php
        // Check if payments data is available
        if (isset($payments) && !empty($payments)) {
            echo '<table>';
            echo '<tr><th>Name</th><th>Type</th><th>Payment</th><th>Action</th></tr>';
            foreach ($payments as $index => $payment) {
                $rowClass = ($index === 0) ? 'first-row' : '';
                echo '<tr class="' . $rowClass . '">';
                echo '<td>' . $payment['name'] . '</td>';
                echo '<td>' . $payment['type'] . '</td>';
                echo '<td>' . $payment['price'] . '</td>';
                echo '<td>';
                echo '<form action="" method="POST">';
                echo '<button type="submit" class="delete-button" name="delete" value="' . $payment['id'] . '">Delete</button>';
                echo '</form>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo '<p>No payment data available.</p>';
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
