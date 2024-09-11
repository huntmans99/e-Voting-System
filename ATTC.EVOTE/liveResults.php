<?php
header('Content-Type: application/json');

// Include the existing config.php
require 'config.php'; 

// Define database connection parameters for the new database
$hostname = "localhost";
$username = "root";
$password = "";
$database = "voting_system";

try {
    // Establish a new connection using PDO for voting_system
    $conn_voting = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    
    // Set PDO error mode to Exception
    $conn_voting->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Query to fetch live vote counts for each candidate
    $query = "
        SELECT c.name, COUNT(v.id) AS vote_count
        FROM candidates c
        LEFT JOIN votes v ON c.id = v.candidate_id
        GROUP BY c.id
        ORDER BY vote_count DESC
    ";
    $stmt = $conn_voting->query($query);

    $liveResults = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $liveResults[] = $row;
    }

    echo json_encode($liveResults);

} catch (PDOException $e) {
    // Log error to file
    error_log("Connection failed: " . $e->getMessage(), 3, 'error.log');
    
    // Display a user-friendly message
    die("Database connection failed. Please try again later.");
}
?>
