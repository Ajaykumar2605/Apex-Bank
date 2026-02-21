<?php
$connection = mysqli_connect("192.168.1.20","apex_user","redhat","apexbank_db");
$db = mysqli_select_db($connection,"apexbank_db")
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
