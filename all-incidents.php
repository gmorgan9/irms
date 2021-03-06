<?php 
session_start();
    include("database/connection.php");
    include("database/functions.php");

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }

    // DELETE
    if(isset($_GET['id'])) {
        $id = $_GET['id'];
    
        $sql = "DELETE FROM incidents WHERE id=$id";
        $result = mysqli_query($con, $sql);
        if($result) {
            // echo "Deleted Successfully";
            header('location: all-incidents.php'); // returns back to same page
        } else {
            die(mysqli_error($con));
        }
    }

    // UPDATE

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link href="assets/fontawesome/css/all.css" rel="stylesheet">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/bell-regular.svg">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/style.css?v=2.18">

    <!-- Bootstrap Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Home</title>
</head>
<body>
    <div class="header">
        <h2 class="logo">
            Incident Record Management System
            <a href="/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        </h2>
    </div>
<br>
<div class="record_incident">
    <a href="/"><button class="btn btn-primary rec">Back</button></a>
</div>

<br><br><br>

<div class="col d-flex justify-content-center">
    <div class="row">
        <div class="card open-count" style="width: 15rem;">
            <div class="card-body">
                <h1 class="text-center" style="font-size: 100px;">

                <?php
                    $sql="select count('1') from incidents";
                    $result=mysqli_query($con,$sql);
                    $rowtotal=mysqli_fetch_array($result); 
                    echo "$rowtotal[0]";

                ?>

                </h1>
                <p class="text-center">All Incidents</p>
            </div>
        </div>
    </div>
</div>
<br><br><br>

<br><br><br>

<div class="col d-flex justify-content-center">
<table class="table table-hover table-light">
  <thead>
    <tr class="header-line">
      <th scope="col">#</th>
      <th scope="col">Status</th>
      <th scope="col">Incident Number</th>
      <th scope="col">Severity</th>
      <th scope="col">Description</th>
      <!-- <th scope="col">Assignment Group</th> -->
      <!-- <th scope="col">KB Article</th> -->
      <th scope="col">Date</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>

      <?php

      $sql = "SELECT * FROM incidents";
      $result = mysqli_query($con, $sql);
      if($result) {
          while ($row = mysqli_fetch_assoc($result)) {
            $id=$row['id'];
            $status=$row['status'];
            $inc_num = $row['inc_num'];
            $priority = $row['priority'];
            $description = $row['description'];
            //$assign_group = $row['assign_group'];
            //$kb_article = $row['kb_article'];
            $date = $row['date'];
            $time = $row['time'];
            ?>
            <tr>
            <th scope="row"><?php echo $id; ?></th>
            <?php if($status == 0) { ?>
                <td>open</td>
            <?php } else { ?>
            <td>closed</td>
            <?php } ?>
            <td><?php echo $inc_num; ?></td>
            <td><?php echo $priority; ?></td>
            <td style="max-width: 40em;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:100px;"><?php echo $description ?></td>
            <!-- <td><?php #echo $assign_group; ?></td> -->
            <!-- <td><?php #echo $kb_article; ?></td> -->
            <td><?php echo $date; ?></td>
            <td><?php echo $time; ?></td>
            <td><a href="update-incident.php?updateid=<?php echo $id; ?>"><i class="fa-solid fa-pen-to-square" style="color:#005382;"></a></i></td>
            <td><a href="all-incidents.php?id=<?php echo $id; ?>" class="delete"><i class="fa-solid fa-trash-can" style="color:#941515;"></i></a></td>
            </tr>
         <?php }
      }

?>
  </tbody>
</table>
</div>


</body>
</html>
