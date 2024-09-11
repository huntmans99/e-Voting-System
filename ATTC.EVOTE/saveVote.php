<?php
require 'config.php';
// Database connection (adjust the details based on your setup)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "voting_system"; // Ensure this matches your DB name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    // Get form data and sanitize inputs to prevent SQL injection
    $voterName = $conn->real_escape_string($_POST['voterName']);
    $voterEmail = $conn->real_escape_string($_POST['voterEmail']);
    $voterID = $conn->real_escape_string($_POST['voterID']);
    $selectedCandidate = $conn->real_escape_string($_POST['selectedCandidate']);

    // Check if the combination of voterName and voterEmail already exists
    $checkQuery = "SELECT * FROM votes WHERE voter_name = ? AND voter_email = ? AND voter_id = ?";
    $stmt = $conn->prepare($checkQuery);
    if ($stmt === false) {
        die('Error preparing the statement: ' . $conn->error);
    }

    // Bind parameters and execute
    $stmt->bind_param("sss", $voterName, $voterEmail, $voterID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if voter has already voted
    if ($result->num_rows > 0) {
        // Voter has already voted with this name, email, and ID
        echo "<script>alert('You have already voted with this name, email, and ID. You cannot vote again.'); window.location.href='index.html';</script>";
    } else {
        // Insert new vote into the database
        $insertQuery = "INSERT INTO votes (voter_name, voter_email, voter_id, selected_candidate) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);

        if ($stmt === false) {
            die('Error preparing the insert statement: ' . $conn->error);
        }

        $stmt->bind_param("ssss", $voterName, $voterEmail, $voterID, $selectedCandidate);

        if ($stmt->execute()) {
            // Success message
            echo "<script>alert('Vote recorded successfully. Thank you for voting!'); window.location.href='index.html';</script>";
        } else {
            // Error message
            echo "<script>alert('Error recording your vote. Please try again.'); window.location.href='index.html';</script>";
        }
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
