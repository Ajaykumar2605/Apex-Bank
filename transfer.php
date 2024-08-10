
<!DOCTYPE html>
<html lang="en">
<head>
   <title>Transfer</title>
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
<?php
             $connection = mysqli_connect("sql104.infinityfree.com","if0_37077474","Apex2024");
             $db = mysqli_select_db($connection,"if0_37077474_banking_db");
            
             $sql = "select * from Account";
             $run = mysqli_query($connection, $sql);
             if(isset($_POST['submit']))
            {
                $from = $_GET['tf'];
                $to = $_POST['to'];
                $amt = $_POST['amt'];
            
                $sql = "SELECT * from account where accno=$from";
                $query = mysqli_query($connection,$sql);
                $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.
            
                $sql = "SELECT * from account where accno=$to";
                $query = mysqli_query($connection,$sql);
                $sql2 = mysqli_fetch_array($query);
            
             // constraint to check input of negative value by user
                if (($amt)<0)
               {
                    echo '<script type="text/javascript">';
                    echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
                    echo '</script>';
                }
                 // constraint to check insufficient balance.
                else if($amt > $sql1['amt']) 
                {
                    
                    echo '<script type="text/javascript">';
                    echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
                    echo '</script>';
                }
                // constraint to check zero values
                else if($amt == 0){
            
                     echo "<script type='text/javascript'>";
                     echo "alert('Oops! Zero value cannot be transferred')";
                     echo "</script>";
                 }
                 if(isset($_POST['submit']))
                 {
                     $from = $_GET['tf'];
                     $to = $_POST['to'];
                     $amount = $_POST['amt'];
                 
                     $sql = "SELECT * from account where accno=$from";
                     $query = mysqli_query($connection,$sql);
                     $sql1 = mysqli_fetch_array($query); // returns array or output of user from which the amount is to be transferred.
                 
                     $sql = "SELECT * from account where accno=$to";
                     $query = mysqli_query($connection,$sql);
                     $sql2 = mysqli_fetch_array($query);
                    // constraint to check input of negative value by user
                     if (($amt)<0)
                    {
                         echo '<script type="text/javascript">';
                         echo ' alert("Oops! Negative values cannot be transferred")';  // showing an alert box.
                         echo '</script>';
                     }
                    // constraint to check insufficient balance.
                     else if($amt > $sql1['amt']) 
                     {
                         
                         echo '<script type="text/javascript">';
                         echo ' alert("Bad Luck! Insufficient Balance")';  // showing an alert box.
                         echo '</script>';
                     }
                      // constraint to check zero values
                     else if($amt == 0){
                 
                          echo "<script type='text/javascript'>";
                          echo "alert('Oops! Zero value cannot be transferred')";
                          echo "</script>";
                     
                        }
                       
                        else {
        
                            // deducting amount from sender's account
                            $newbalance = $sql1['amt'] - $amt;
                            $sql = "UPDATE account set amt=$newbalance where accno=$from";
                            mysqli_query($connection,$sql);
                         
            
                            // adding amount to reciever's account
                            $newbalance = $sql2['amt'] + $amt;
                            $sql = "UPDATE account set amt=$newbalance where accno=$to";
                            mysqli_query($connection,$sql);
                            
                            $sender = $sql1['name'];
                            $receiver = $sql2['name'];
                            $sql = "INSERT INTO transaction(`sender`, `receiver`, `balance`) VALUES ('$sender','$receiver','$amt')";
                            $run = mysqli_query($connection,$sql);
            
                        if($run){
                                 echo "<script> alert('Hurray! Transaction is Successful');
                                                 window.location='tansferhistory.php';
                                       </script>";
                                
                            }
            
                            $newbalance= 0;
                            $amt =0;
                    }
                
            }
                    


                    $db = mysqli_select_db($connection,"banking_db");
                    $tf = $_GET['tf'];
                    
                    $sql = "select * from accunt where accno= '$tf'";
                    
                    $run = mysqli_query($connection,$sql);
                }
            ?>
            <form method="post" name="tcredit" class="tabletext" ><br>
        <div>
            <table class="table table-striped table-condensed table-bordered">
            <tr style="color : black;">
                    <th class="text-center">Account No.</th>
                    <th class="text-center">Account Name</th>
                    <th class="text-center">E-mail</th>
                    <th class="text-center">Account Balane(in Rs.)</th>
                </tr>
               <?php
                 $db = mysqli_select_db($connection,"banking_db");
                 $tf = $_GET['tf'];
                 
                 $sql = "select * from account where accno = '$tf'";
                 
                 $run = mysqli_query($connection,$sql);
                  while($row = mysqli_fetch_array($run))
                                {
                                    $accno = $row['accno'];
                                    $name = $row['name'];
                                    $mail = $row['mail'];
                                    $amt = $row['amt'];
                                ?>
                                    
                                        <td><?php echo $accno ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $mail ?></td>
                                        <td><?php echo $amt ?></td>
                                
                                <?php $accno++; } ?>
            </table>
        </div>
        <br><br><br>
        <label style="color : black;"><b>Transfer To:</b></label>
        <select name="to" class="form-control" required>
            <option value="" disabled selected>Choose account</option>
            <?php
                $sql = "select * from Account";
                $run = mysqli_query($connection, $sql);
                $sid=$_GET['accno'];
                $sql = "SELECT * FROM account where accno!=$sid";
                if(!$run)
                {
                    echo "Error ".$sql."<br>".mysqli_error($conn);
                }

                while($rows = mysqli_fetch_assoc($run)) {
            ?>
                <option class="table" value="<?php echo $rows['accno'];?>" >
                
                    <?php echo $rows['name'] ;?> (Balance: 
                    <?php echo $rows['amt'] ;?> ) 
               
                </option>
            <?php 
                } 
            ?>
            <div>
        </select>
        <br>
            <label style="color : black;"><b>Amount:</b></label>
            <input type="number" class="form-control" name="amt" required>   
            <br><br>
                <div class="text-center" >
            <button  class="btn btn-success" name="submit" type="submit" id="myBtn" >Transfer Money</button>
            </div>
        </form>
    </div>





<footer class="text-center mt-2 py-5">
        <p>© 2024 All rights reserved<b>Ajay Kumar</b> </br>Chairman,Founder</p>
      </footer>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>  
</body>
</html>