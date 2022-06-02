<?php

include 'database/connection.php';

if(isset($_GET['deleteid'])) {
    $inc_id = $_GET['deleteid'];

    $sql = "DELETE FROM incidents WHERE inc_id=$inc_id";
    $result = mysqli_query($con, $sql);
    if($result) {
        // echo "Deleted Successfully";
        header('location: all-incidents.php'); // returns back to same page
    } else {
        die(mysqli_error($con));
    }
}


?>