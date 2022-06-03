<?php
    $servername='localhost';
    $username='gmorg';
    $password='gmorgpass';
    $dbname = "finance";
    $conn=mysqli_connect($servername,$username,$password,"$dbname");
      if(!$conn){
          die('Could not Connect MySql Server:' .mysql_error());
        } else {
            echo "Success";
        }
?>