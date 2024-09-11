<?php
$hostname = "localhost";
$username = "root";
$password = "";
$database = "voting_system";

try {
    $conn_voting = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
    $conn_voting->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected to the voting_system database successfully!";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
