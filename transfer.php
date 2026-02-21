<?php
// Enable full error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database connection
$connection = new mysqli("192.168.1.20", "apex_user", "redhat", "apexbank_db");
if ($connection->connect_error) {
    die("Database connection failed: " . $connection->connect_error);
}

// Get sender account number from URL
$tf = $_GET['tf'] ?? '';

if (!$tf) {
    die("Sender account not specified.");
}

// Handle form submission
if (isset($_POST['submit'])) {
    $to  = $_POST['to'] ?? '';
    $amt = floatval($_POST['amt']);

    if (!$to || $amt <= 0) {
        echo "<script>alert('Please select a valid account and amount > 0');</script>";
    } else {
        // Start transaction
        $connection->begin_transaction();
        try {
            // Fetch sender
            $stmt = $connection->prepare("SELECT * FROM account WHERE accno = ?");
            if (!$stmt) throw new Exception("Prepare failed: " . $connection->error);
            $stmt->bind_param("s", $tf);
            $stmt->execute();
            $from_acc = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            if (!$from_acc) throw new Exception("Sender account not found");

            // Fetch receiver
            $stmt = $connection->prepare("SELECT * FROM account WHERE accno = ?");
            if (!$stmt) throw new Exception("Prepare failed: " . $connection->error);
            $stmt->bind_param("s", $to);
            $stmt->execute();
            $to_acc = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            if (!$to_acc) throw new Exception("Receiver account not found");

            // Check sufficient balance
            if ($amt > $from_acc['amt']) throw new Exception("Insufficient balance");

            // Deduct from sender
            $new_from_balance = $from_acc['amt'] - $amt;
            $stmt = $connection->prepare("UPDATE account SET amt = ? WHERE accno = ?");
            if (!$stmt) throw new Exception("Prepare failed: " . $connection->error);
            $stmt->bind_param("ds", $new_from_balance, $tf);
            $stmt->execute();
            $stmt->close();

            // Add to receiver
            $new_to_balance = $to_acc['amt'] + $amt;
            $stmt = $connection->prepare("UPDATE account SET amt = ? WHERE accno = ?");
            if (!$stmt) throw new Exception("Prepare failed: " . $connection->error);
            $stmt->bind_param("ds", $new_to_balance, $to);
            $stmt->execute();
            $stmt->close();

            // Record transaction
            $sender_name   = $from_acc['name'];
            $receiver_name = $to_acc['name'];
            $stmt = $connection->prepare("INSERT INTO transaction(sender, receiver, balance) VALUES (?, ?, ?)");
            if (!$stmt) throw new Exception("Prepare failed: " . $connection->error);
            $stmt->bind_param("ssd", $sender_name, $receiver_name, $amt);
            $stmt->execute();
            $stmt->close();

            // Commit transaction
            $connection->commit();
            echo "<script>alert('Transaction Successful'); window.location='tansferhistory.php';</script>";

        } catch (Exception $e) {
            $connection->rollback();
            echo "<script>alert('Transaction Failed: " . $e->getMessage() . "');</script>";
        }
    }
}

// Fetch sender info for display
$stmt = $connection->prepare("SELECT * FROM account WHERE accno = ?");
$stmt->bind_param("s", $tf);
$stmt->execute();
$sender_acc = $stmt->get_result()->fetch_assoc();
$stmt->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Transfer Money</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/Styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Apex Corp.Bank</a>
        <div class="collapse navbar-collapse">
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
    <h3 class="text-center mb-4">Transfer Money</h3>

    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>Account No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Balance (Rs.)</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td><?= htmlspecialchars($sender_acc['accno']); ?></td>
            <td><?= htmlspecialchars($sender_acc['name']); ?></td>
            <td><?= htmlspecialchars($sender_acc['mail']); ?></td>
            <td><?= htmlspecialchars($sender_acc['amt']); ?></td>
        </tr>
        </tbody>
    </table>

    <form method="post">
        <div class="form-group">
            <label><b>Transfer To:</b></label>
            <select name="to" class="form-control" required>
                <option value="" disabled selected>Choose account</option>
                <?php
                $stmt = $connection->prepare("SELECT * FROM account WHERE accno != ?");
                $stmt->bind_param("s", $tf);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='{$row['accno']}'>{$row['name']} (Balance: {$row['amt']})</option>";
                }
                $stmt->close();
                ?>
            </select>
        </div>

        <div class="form-group">
            <label><b>Amount:</b></label>
            <input type="number" class="form-control" name="amt" step="0.01" required>
        </div>

        <div class="text-center mt-3">
            <button type="submit" name="submit" class="btn btn-success">Transfer Money</button>
        </div>
    </form>
</div>

<footer class="text-center mt-5 py-4 bg-dark text-white">
    <p>© 2024 All rights reserved <b>Ajay Kumar</b><br>Chairman, Founder</p>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
