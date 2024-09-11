<?php

// Database connection variables
$hostname = "localhost";
$username = "root";
$password = "";
$database = "db_evoting";

try {
    // Establishing connection using PDO (more secure)
    $conn = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    
    // Set PDO error mode to Exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Success message for testing purposes (remove/comment out in production)
    // echo "Connected successfully"; 

} catch (PDOException $e) {
    // Log error to file (make sure error.log is writable by the web server)
    error_log("Connection failed: " . $e->getMessage(), 3, 'error.log');
    
    // Display a user-friendly message (never expose technical details to the user)
    die("Database connection failed. Please try again later.");
}

// Function to sanitize user input (extended)
function sanitize_input($data, $conn) {
    // Trim white space, remove slashes, and convert special characters
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    
    // For added security, escape SQL input using PDO's quote method
    $data = $conn->quote($data);
    
    return $data;
}

?>
