<?php
// Include the database connection file
require_once('db.php');
if (!isset($_SESSION['admin'])) {
    // Redirect to the login page if not authenticated
    header("Location: login.php");
    exit();
}

// Hardcoded values
$usernameValue = 'Mhamad';
$passwordValue = 'Bahja';

// Hash the password
$hashedPassword = password_hash($passwordValue, PASSWORD_DEFAULT);

// Insert the values into the 'admin' table
$insertQuery = "INSERT INTO admin (username, password) VALUES ('$usernameValue', '$hashedPassword')";

if ($conn->query($insertQuery)) {
    echo "Insertion successful!";
} else {
    echo "Insertion failed. Error: " . $conn->error;
}

// Close the database connection
$conn->close();
?>
