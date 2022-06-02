<?php

include 'database/connection.php';

if(isset($_GET['deleteid'])) {
    $inc_id = $_GET['deleteid'];

    $sql = "DELETE FROM incidents WHERE inc_id=$inc_id";
    $result = mysqli_query($con, $sql);
    if($result) {
        echo "Deleted Successfully";
    } else {
        die(mysqli_error($con));
    }
}


?>