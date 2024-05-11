<?php
// Start the session
session_start();
require_once('db.php');
// Check if the user is not logged in, redirect to admin_login.php
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit();
}

// Handle logout
if (isset($_POST['logout'])) {
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session
    session_destroy();

    // Redirect to the index.php page
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            background-color: #f4f4f4; /* Light background color */
        }

        .dashboard-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%; /* Adjusted width for better responsiveness */
            max-width: 800px; /* Set a maximum width */
            text-align: center;
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 8px; /* Reduced gap for less spacing between buttons */
        }

        .button-link,
        .logout-button,
        .add-admin-button {
            display: inline-block;
            margin-top: 8px; /* Reduced margin for less spacing between buttons */
            padding: 15px 20px;
            border-radius: 4px;
            transition: background-color 0.3s;
            text-decoration: none; /* Added text-decoration */
        }

        .button-link {
            background-color: #00b8b8; /* Updated blue button color */
            color: #fff;
        }

        .button-link:hover {
            background-color: #008c8c; /* Darker blue color on hover */
        }

        .logout-button {
            background-color: #e74c3c; /* Red button color for logout */
            color: #fff;
            cursor: pointer;
            border: none; /* Remove border */
        }

        .logout-button:hover {
            background-color: #c0392b; /* Darker red color on hover */
        }

        .add-admin-button {
            background-color: #00b8b8; /* Updated blue button color */
            color: #fff;
            cursor: pointer;
            border: none; /* Remove border */
        }

        .add-admin-button:hover {
            background-color: #008c8c; /* Darker blue color on hover */
        }

        @media screen and (max-width: 600px) {
            .button-link,
            .logout-button,
            .add-admin-button {
                width: 100%; /* Make buttons full width on smaller screens */
            }
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <h2>Welcome <?php echo isset($_SESSION['admin']) ? $_SESSION['admin'] : ''; ?>!</h2>
        <form action="" method="POST">
            <a href="appointments.php" class="button-link">
                <span class="icon">&#128197;</span> Appointments
            </a>
            <a href="payments.php" class="button-link">
                <span class="icon">&#128181;</span> Payments
            </a>
            <button type="submit" formaction="add_admin.php" class="add-admin-button">
                <span class="icon">&#x1F464;</span> Add Admin
            </button>

            <button type="submit" name="logout" class="logout-button">
                <span class="icon">&#128682;</span> Logout
            </button>

        </form>
    </div>

    <?php
    // Check if the user is logged in as admin
    if (isset($_SESSION['admin'])) {
    ?>
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
    <?php
    }
    ?>
</body>

</html>
