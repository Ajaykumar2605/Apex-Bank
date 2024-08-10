<?php
$connection = mysqli_connect("sql104.infinityfree.com","if0_37077474","Apex2024");
$db = mysqli_select_db($connection,"if0_37077474_banking_db");
$delete = $_GET['del'];


$sql = "delete from account where accno = '$delete'";


if(mysqli_query($connection,$sql))
           {

            echo '<script> location.replace("home.php")</script>';  
           }
           else
           {
           echo "Some thing Error" . $connection->error;

           }

?>