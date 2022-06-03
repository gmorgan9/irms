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
    
        $sql = "DELETE FROM notes WHERE id=$id";
        $result = mysqli_query($con, $sql);
        if($result) {
            // echo "Deleted Successfully";
            header('location: incident-notes.php'); // returns back to same page
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

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/style.css?v=2.19">

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
    <a href="record-note.php"><button class="btn btn-primary rec">Record Note</button></a>
</div>

<br><br><br>

<div class="col d-flex justify-content-center">
    <div class="row">
        <div class="card open-count" style="width: 15rem;">
            <div class="card-body">
                <h1 class="text-center" style="font-size: 100px;">

                <?php
                    $sql="select count('1') from notes";
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
<table class="table table-hover table-light notes-table">
  <thead>
    <tr class="header-line">
      <th class="w-5" scope="col">#</th>
      <th class="w-15" scope="col">Date</th>
      <th class="w-25" scope="col">Title</th>
      <th class="w-75" scope="col">Note</th>
      <th class="w-25" scope="col">Tag</th>
    </tr>
  </thead>
  <tbody>

      <?php

      $sql = "SELECT * FROM notes";
      $result = mysqli_query($con, $sql);
      if($result) {
          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $date = $row['date'];
            $title = $row['title'];
            $note = $row['note'];
            $tag = $row['tag'];
            ?>
            <tr>
            <th scope="row"><?php echo $id; ?></th>
            <td><?php echo $date; ?></td>
            <td><?php echo $title; ?></td>
            <td style="max-width: 15em;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:50px;"><?php echo $note; ?></td>
            <td><?php echo $tag; ?></td>
            <td><?php echo $time; ?></td>
            <td><a href="update-note.php?updateid=<?php echo $id; ?>"><i class="fa-solid fa-pen-to-square"></a></i></td>
            <td><a href="incident-notes.php?id=<?php echo $id; ?>" class="delete"><i class="fa-solid fa-trash-can"></i></a></td>
            </tr>
         <?php }
      }

?>
  </tbody>
</table>
</div>


</body>
</html>
