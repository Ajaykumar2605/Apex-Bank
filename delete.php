<?php
// Connect to database
$connection = mysqli_connect("192.168.1.20", "apex_user", "redhat", "apexbank_db");
if (!$connection) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Get the account number to delete
$delete = $_GET['del'] ?? '';  // safer, avoids undefined index

if ($delete) {
    // Use prepared statement to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM account WHERE accno = ?");
    $stmt->bind_param("s", $delete);

    if ($stmt->execute()) {
        echo '<script>location.replace("home.php");</script>';
    } else {
        echo "Error deleting account: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "No account specified to delete.";
}

$connection->close();
?>
