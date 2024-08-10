<?php
   $connection = mysqli_connect("sql104.infinityfree.com","if0_37077474","Apex2024");
   $db = mysqli_select_db($connection,"if0_37077474_banking_db");

    if(isset($_POST['submit']))
        { 
            $accno = $_POST['accno'];
            $name = $_POST['name'];
            $mail = $_POST['mail'];
            $amt = $_POST['amt'];
            $sql = "insert into account(accno,name,mail,amt)values('$accno',' $name',' $mail',' $amt')";
           if(mysqli_query($connection,$sql))
           {
                  echo '<script> location.replace("home.php")</script>';  
           }
           else
           {
           echo "Some thing Error" . $connection->error;
           }
        }
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <title>Add Acccount</title>
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
</nav>

        <div class="container" >
            <div class="row">
                 <div class="col-md-9">
                    <div class="card">
                    <div class="card-header">
                        <h1>  Application </h1>
                    </div>
                    <div class="card-body" >

                    <form action="newdata.php" method="post">
                    <div class="form-group" >
                            <label>Account no</label>
                            <input type="text" name="accno" class="form-control"  placeholder="Enter Account no"> 
                        </div>

                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control"  placeholder="Enter Name"> 
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="mail" class="form-control"  placeholder="Enter Email"> 
                        </div>

                        <div class="form-group">
                            <label>amount</label>
                            <input type="text" name ="amt" class="form-control"  placeholder="Enter amount"> 
                        </div>
                        <br/>
                        <input type="submit" class="btn btn-primary" name="submit" value="Register">
                        </form>
                   
                    </div>
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