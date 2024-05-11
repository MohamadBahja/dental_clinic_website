<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Choice</title>
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

        .container {
            text-align: center;
            border: 2px solid #00b8b8; /* Border color using the provided blue color */
            border-radius: 15px; /* Rounded border for the container */
            overflow: hidden; /* Hide overflow from the gradient */
            background: linear-gradient(45deg, #ffffff, #f0f0f0); /* Gradient background */
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 400px; /* Adjusted width for better visibility */
        }

        .login-buttons {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            margin-top: 20px;
        }

        .login-button {
            background-color: #00b8b8;
            color: #fff;
            cursor: pointer;
            border: none;
            border-radius: 8px;
            padding: 15px;
            text-decoration: none;
            font-size: 18px;
            margin-bottom: 15px;
            transition: background-color 0.3s;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .login-button:hover {
            background-color: #008c8c;
        }

        .icon {
            font-size: 24px;
            margin-right: 10px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        p {
            color: #555;
            margin-bottom: 40px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Login Choice</h1>
        <p>Choose your login option below:</p>

        <div class="login-buttons">
            <a href="admin_login.php" class="login-button">
                <span class="icon">&#128100;</span> Admin Login
            </a>
            <a href="user_login.php" class="login-button">
                <span class="icon">&#128100;</span> User Login
            </a>
        </div>
    </div>
</body>

</html>
