<?php
session_start();
require_once('db.php');

if (!isset($_SESSION['admin'])) {
    // Redirect to the login page if not authenticated
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Validate input
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = "Username and password are required.";
    } else {
        // Check if the username already exists
        $checkQuery = "SELECT * FROM admin WHERE username = '$username'";
        $result = $conn->query($checkQuery);

        if ($result->num_rows > 0) {
            // Username already exists, set error message
            $_SESSION['error'] = "Username '$username' already exists. Choose a different username.";
        } else {
            // Insert the provided username and hashed password into the 'admin' table
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $insertQuery = "INSERT INTO admin (username, password) VALUES ('$username', '$hashedPassword')";

            if ($conn->query($insertQuery)) {
                // Admin addition successful, redirect or show a success message
                $_SESSION['success'] = "Admin added successfully.";
            } else {
                // Admin addition failed, set error message
                $_SESSION['error'] = "Admin addition failed. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admin</title>
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

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 90%; /* Adjusted width for better responsiveness */
            max-width: 400px; /* Set a maximum width */
            text-align: center;
        }

        h2 {
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        label {
            font-size: 14px;
            color: #555;
        }

        input {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #00b8b8; /* Updated blue button color */
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #008c8c; /* Darker blue color on hover */
        }

        .message {
            color: #27ae60; /* Green color for success */
            margin-top: 10px;
            text-align: center;
        }

        .error {
            color: #e74c3c;
            margin-top: 10px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Add Admin</h2>

        <?php
        if (isset($_SESSION['success'])) {
            echo '<p class="message">' . $_SESSION['success'] . '</p>';
            unset($_SESSION['success']);
        } elseif (isset($_SESSION['error'])) {
            echo '<p class="error">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Add Admin</button>
        </form>
    </div>
</body>

</html>
