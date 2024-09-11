<?php
require 'config.php'; // Include the configuration and database connection

// Fetch candidates from the database for display
$candidates = [];
$conn = new mysqli($hostname, $username, $password, $database);
$candidateQuery = "SELECT * FROM candidates";
$result = $conn->query($candidateQuery);

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $candidates[] = $row;
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control Panel</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Ubuntu|Raleway|Oswald|Roboto+Condensed' rel='stylesheet'>
    <style>
        .headerFont{ font-family: 'Ubuntu', sans-serif; font-size: 24px; }
        .subFont{ font-family: 'Raleway', sans-serif; font-size: 14px; }
        .specialHead{ font-family: 'Oswald', sans-serif; }
        .normalFont{ font-family: 'Roboto Condensed', sans-serif; }
        .card img { height: 250px; object-fit: cover; } /* Ensures images fit well */
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top navbar-inverse" role="navigation">
            <div class="container">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#example-nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="navbar-header">
                    <a href="index.html" class="navbar-brand headerFont text-lg"><strong>eVoting</strong></a>
                </div>
                <div class="collapse navbar-collapse" id="example-nav-collapse">
                    <ul class="nav navbar-nav">
                        <li><a href="nomination.html"><span class="subFont"><strong>Nomination's List</strong></span></a></li>
                        <li><a href="changePassword.php"><span class="subFont"><strong>Admin's Password</strong></span></a></li>
                        <li><a href=""><span class="subFont"><strong>Feedback Report</strong></span></a></li> 
                    </ul>
                    <span class="normalFont"><a href="index.html" class="btn btn-success navbar-right navbar-btn"><strong>Sign Out</strong></a></span>
                </div>
            </div>
        </nav>

        <div class="container" style="padding:100px;">
            <div class="row">
                <div class="col-sm-12" style="border:2px solid gray;">
                    <div class="page-header">
                        <h2 class="specialHead">CONTROL PANEL</h2>
                        <p class="normalFont">This is the Administration Panel.</p>
                    </div>
                    <div class="col-sm-12">
                        <!-- Add and Remove Candidate Buttons -->
                        <a href="addCandidate.php" class="btn btn-primary btn-lg"><strong>Add Candidate</strong></a>
                        <a href="removeCandidate.php" class="btn btn-danger btn-lg"><strong>Remove Candidate</strong></a>
                        <hr>
                        <!-- Display Candidates -->
                        <div class="container">
                            <h3 class="specialHead">Current Candidates</h3>
                            <div class="row">
                                <?php if (count($candidates) > 0): ?>
                                    <?php foreach ($candidates as $candidate): ?>
                                        <div class="col-md-4">
                                            <div class="card">
                                                <img src="<?php echo htmlspecialchars($candidate['image_url']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($candidate['name']); ?>">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo htmlspecialchars($candidate['name']); ?></h5>
                                                    <p class="card-text"><?php echo htmlspecialchars($candidate['bio']); ?></p>
                                                    <p class="card-text"><strong>Position:</strong> <?php echo htmlspecialchars($candidate['position']); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>No candidates available.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
