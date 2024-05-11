<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: #333333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555555;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            border: 1px solid #cccccc;
            border-radius: 4px;
            outline: none;
        }

        input[type="submit"] {
            background-color: #00b8b8;
            color: #ffffff;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            padding: 10px;
        }

        input[type="submit"]:hover {
            background-color: #008c8c;
        }

        .register-link {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: black;
        }
    </style>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <h2>User Login</h2>

        <?php
        session_start();

        $conn = mysqli_connect('localhost', 'root', '', 'dentalclinic') or die('connection failed');

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['username']) && isset($_POST['password'])) {
                $username = mysqli_real_escape_string($conn, $_POST['username']);
                $password = $_POST['password'];

                $query = "SELECT * FROM users WHERE username='$username'";
                $result = mysqli_query($conn, $query);

                if ($result) {
                    // Check if there is at least one user with the given username
                    if (mysqli_num_rows($result) > 0) {
                        $passwordMatched = false;
                        while ($row = mysqli_fetch_assoc($result)) {
                            if (password_verify($password, $row['password'])) {
                                $passwordMatched = true;
                                $_SESSION['message'] = 'Login successful. Welcome!';
                                header('Location: index.php');
                                exit();
                            }
                        }

                        // If none of the passwords matched
                        if (!$passwordMatched) {
                            echo '<p style="color: red;">Incorrect password</p>';
                        }
                    } else {
                        // No user found with the given username
                        echo '<p style="color: red;">User not found</p>';
                    }
                } else {
                    // Query execution failed
                    echo '<p style="color: red;">Error executing query</p>';
                }
            }
        }
        ?>

        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <input type="submit" value="Login">

        <a href="register.php" class="register-link">Don't have an account? Register here.</a>
    </form>
</body>
</html>
