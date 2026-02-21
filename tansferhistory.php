<!DOCTYPE html>
<html lang="en">
<head>
   <title>Transfer History</title>
   <meta charset="utf-8">
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
    <h2 class="text-center mb-4" style="color: white;">Transfer History</h2>

    <div class="table-responsive-sm">
        <table class="table table-hover table-striped table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th class="text-center">S.No.</th>
                    <th class="text-center">Sender</th>
                    <th class="text-center">Receiver</th>
                    <th class="text-center">Amount</th>
                    <th class="text-center">Date & Time</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $connection = mysqli_connect("192.168.1.20","apex_user","redhat","apexbank_db");
            if (!$connection) {
                die("Database connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM transaction ORDER BY datetime DESC";
            $run = mysqli_query($connection, $sql);

            if ($run && mysqli_num_rows($run) > 0) {
                while($rows = mysqli_fetch_assoc($run)) {
                    echo "<tr style='color: black;'>
                            <td class='py-2'>{$rows['sno']}</td>
                            <td class='py-2'>{$rows['sender']}</td>
                            <td class='py-2'>{$rows['receiver']}</td>
                            <td class='py-2'>{$rows['balance']}</td>
                            <td class='py-2'>{$rows['datetime']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='5' class='text-center'>No transactions found</td></tr>";
            }
            ?>
            </tbody>
        </table>
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
