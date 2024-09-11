<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Remove Candidate</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        .headerFont{ font-family: 'Ubuntu', sans-serif; font-size: 24px; }
        .normalFont{ font-family: 'Roboto Condensed', sans-serif; }
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
            <div class="container">
                <a href="cpanel.php" class="navbar-brand headerFont text-lg"><strong>Back to Control Panel</strong></a>
            </div>
        </nav>

        <div class="container" style="padding:100px;">
            <div class="row">
                <div class="col-sm-12" style="border:2px solid gray;">
                    <div class="page-header">
                        <h2 class="headerFont">Remove Candidate</h2>
                    </div>

                    <?php
                    if (isset($_GET['status'])) {
                        if ($_GET['status'] == 'success') {
                            echo '<div class="alert alert-success">Candidate removed successfully.</div>';
                        } elseif ($_GET['status'] == 'error') {
                            echo '<div class="alert alert-danger">Error removing candidate. Please try again.</div>';
                        }
                    }
                    ?>

                    <!-- Form to delete candidate -->
                    <form action="deleteCandidate.php" method="POST">
                        <div class="form-group">
                            <label>Candidate Name:</label>
                            <select name="candidateName" class="form-control" required>
                                <?php
                                    // Database connection settings
                                    require 'config.php'; // Include your database connection settings
                                    $conn = new mysqli($hostname, $username, $password, $database);

                                    // Check connection
                                    if ($conn->connect_error) {
                                        die("Connection failed: " . $conn->connect_error);
                                    }

                                    // Fetch candidates from the database
                                    $query = "SELECT id, name FROM candidates";
                                    $result = $conn->query($query);

                                    // Check if any candidates are found
                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
                                        }
                                    } else {
                                        echo "<option disabled>No candidates available</option>";
                                    }

                                    // Close connection
                                    $conn->close();
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-danger">Remove Candidate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
