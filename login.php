<?php
// Database connection parameters
$host = "localhost";
$username = "your_username";
$password = "your_password";
$database = "login";

// Create a database connection
$mysqli = new mysqli($host, $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Perform a simple login check (You should use password hashing in a real application)
    $query = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        // Successful login
        echo "Login successful!";
    } else {
        // Failed login
        echo "Login failed!";
    }

    // Close the database connection
    $stmt->close();
    $mysqli->close();
}
?>
