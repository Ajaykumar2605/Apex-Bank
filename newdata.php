<?php
// Enable error reporting for debugging (remove on production)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$connection = mysqli_connect("192.168.1.20", "apex_user", "redhat", "apexbank_db");

if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Handle form submission
if (isset($_POST['submit'])) {
    $accno = trim($_POST['accno']);
    $name  = trim($_POST['name']);
    $mail  = trim($_POST['mail']);
    $amt   = floatval($_POST['amt']);

    // Basic validation
    if (empty($accno) || empty($name) || empty($mail) || $amt <= 0) {
        echo "<script>alert('All fields are required & amount must be greater than 0');</script>";
    } else {
        // Prepare statement to avoid SQL injection
        $stmt = mysqli_prepare($connection, "INSERT INTO account (accno, name, mail, amt) VALUES (?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sssd", $accno, $name, $mail, $amt);

        if (mysqli_stmt_execute($stmt)) {
            echo "<script>location.replace('home.php');</script>";
        } else {
            echo "Error: " . mysqli_error($connection);
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add New Account - Apex Bank</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/Styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Apex Corp.Bank</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="home.php">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="data.php">Our Customers</a></li>
                <li class="nav-item"><a class="nav-link" href="tansferhistory.php">Transfer History</a></li>
                <li class="nav-item"><a class="nav-link" href="newdata.php">Add Account</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header text-center bg-primary text-white">
                    <h2>Register New Account</h2>
                </div>
                <div class="card-body">
                    <form method="post">
                        <div class="form-group">
                            <label>Account No</label>
                            <input type="text" name="accno" class="form-control" placeholder="Enter Account No" required>
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter Name" required>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="mail" class="form-control" placeholder="Enter Email" required>
                        </div>

                        <div class="form-group">
                            <label>Initial Amount</label>
                            <input type="number" name="amt" class="form-control" placeholder="Enter Amount" step="0.01" min="0.01" required>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" name="submit" class="btn btn-success">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center mt-5 py-4 bg-dark text-white">
    <p>© 2024 All rights reserved <b>Ajay Kumar</b><br>Chairman, Founder</p>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
