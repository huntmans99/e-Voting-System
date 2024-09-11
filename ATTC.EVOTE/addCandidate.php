<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Candidate</title>
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
                        <h2 class="headerFont">Add New Candidate</h2>
                    </div>
                    <form action="saveCandidate.php" method="POST">
                        <div class="form-group">
                            <label>Candidate Name:</label>
                            <input type="text" name="candidateName" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Position:</label>
                            <input type="text" name="position" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Short Bio:</label>
                            <textarea name="bio" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label>Image URL:</label>
                            <input type="text" name="imageURL" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Add Candidate</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
s