<?php
header('Content-Type: application/json');

require 'config.php'; // Include your database connection settings

// Create a new connection
$conn = new mysqli($hostname, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch candidates from the database
$query = "SELECT name, position, bio, image_url FROM candidates";
$result = $conn->query($query);

$candidates = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $candidates[] = $row;
    }
}

echo json_encode($candidates);

$conn->close();
?>
