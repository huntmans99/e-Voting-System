<?php
require 'config.php'; // Include the configuration and database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the candidate ID from the POST request
    if (isset($_POST['candidateName'])) {
        $candidateId = intval($_POST['candidateName']); // Sanitize input

        // Create a connection
        $conn = new mysqli($hostname, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare and execute the delete query
        $stmt = $conn->prepare("DELETE FROM candidates WHERE id = ?");
        $stmt->bind_param("i", $candidateId);
        
        if ($stmt->execute()) {
            // Redirect back to control panel with success message
            header('Location: removeCandidate.php?status=success');
        } else {
            // Redirect back with error message
            header('Location: removeCandidate.php?status=error');
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "No candidate ID provided.";
    }
} else {
    echo "Invalid request method.";
}
?>

