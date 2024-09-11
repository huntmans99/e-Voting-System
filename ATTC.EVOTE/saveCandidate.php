<?php
require 'config.php'; // Include your database connection settings

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $candidateName = $_POST['candidateName'];
    $position = $_POST['position'];
    $bio = $_POST['bio'];
    $imageURL = $_POST['imageURL'];

    $conn = new mysqli($hostname, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and execute the insert statement
    $stmt = $conn->prepare("INSERT INTO candidates (name, position, bio, image_url) VALUES (?, ?, ?, ?)");

    // Check if prepare failed
    if ($stmt === false) {
        die("Error preparing the statement: " . $conn->error);
    }

    $stmt->bind_param("ssss", $candidateName, $position, $bio, $imageURL);

    if ($stmt->execute()) {
        // Success
        echo "<script>
            alert('Candidate added successfully.');
            setTimeout(function() {
                window.location.href = 'liveUpdates.php'; // Redirect to live updates page after 5 seconds
            }, 5000); // 5000 milliseconds = 5 seconds
        </script>";
    } else {
        // Error
        echo "<script>
            alert('Error adding candidate: " . $stmt->error . "');
            setTimeout(function() {
                window.location.href = 'addCandidate.php'; // Redirect to the add candidate page after 5 seconds
            }, 5000); // 5000 milliseconds = 5 seconds
        </script>";
    }

    $stmt->close();
    $conn->close();
}
?>
