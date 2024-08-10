<!DOCTYPE html>
<html lang="en">
<head>
   <title>Our Customers</title>
   <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet"   href="CSS/Styles.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Apex corp.Bank </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="home.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="data.php">Our Customers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="tansferhistory.php">Transfer History</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="newdata.php">Add Account</a>
        </li>
        </div>
      </ul>
      </div>
  </div>
</nav><br>
<div class="container" >
            <div class="row">
                 <div class="col-md-9">
                    <div class="card">
                    <div class="card-header">
                        <h1 > <center>Our Customers Details</center></h1>
                    </div>
                    <div class="card-body" >
                 <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Account no</th>
                            <th scope="col">Name</th>
                            <th scope="col">E-mail</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Option</th>
                            </tr>
                        </thead>
                        <tbody>
                                <?php
                                $connection = mysqli_connect("sql104.infinityfree.com","if0_37077474","Apex2024");
                                $db = mysqli_select_db($connection,"if0_37077474_banking_db");

                                $sql = "select * from Account";
                                $run = mysqli_query($connection, $sql);

                                while($row = mysqli_fetch_array($run))
                                {
                                    $accno = $row['accno'];
                                    $name = $row['name'];
                                    $mail = $row['mail'];
                                    $amt = $row['amt'];
                                ?>

                                   <tr>
                                        <td><?php echo $accno ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $mail ?></td>
                                        <td><?php echo $amt ?></td>

                                        <td>
                                       <button class="btn btn-danger"><a href='delete.php?del=<?php echo $accno ?>' class="text-light"> Delete </a> </button>
                                       <button class="btn btn-success"><a href='transfer.php?tf=<?php echo $accno ?>' class="text-light"> transfer </a> </button>    
                                    </td>
                                   </tr>
                                    <?php $accno++; } ?>
                        </tbody>
                        </table>
                    </div>
                    </div>
                </div>
            </div>
<footer class="text-center mt-2 py-5">
        <p>© 2024 All rights reserved<b>Ajay Kumar</b> </br>Chairman,Founder</p>
      </footer>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
</body>
</html>