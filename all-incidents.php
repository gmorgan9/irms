<?php 
session_start();
    include("database/connection.php");
    include("database/functions.php");

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
    $all_incidents = getAllInc();
    //$open_incidents = countOpenInc();
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
    <link rel="stylesheet" href="assets/css/style.css?v=2.15">

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
                <p class="text-center">Closed Incidents</p>
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
      <th scope="col">Incident Number</th>
      <th scope="col">Severity</th>
      <th scope="col">Description</th>
      <th scope="col">Assignment Group</th>
      <th scope="col">KB Article</th>
      <th scope="col">Date</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>
      <?php $i=1; ?>
    
    <?php foreach ($all_incidents as $key => $all_incident): ?>
        <tr>
            <td><?php echo $key + 1; ?></td>
            <td><?php echo $all_incident['inc_num'] ?></td>
            <td><?php echo $all_incident['priority'] ?></td>
            <td style="max-width: 30em;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:100px;"><?php echo $all_incident['description'] ?></td>
            <td><?php echo $all_incident['assign_group'] ?></td>
            <td><?php echo $all_incident['kb_article'] ?></td>
            <td><?php echo $all_incident['date'] ?></td>
            <td><?php echo $all_incident['time'] ?></td>
            <td><a href="update-incident.php?inc_id=<?php echo $all_incident['inc_id']; ?>"><i class="fa-solid fa-pen-to-square"></a></i></td>
            <td><a href="all-incidents.php?delete-inc=<?php echo $all_incident['inc_id']; ?>" class="delete"><i class="fa-solid fa-trash-can"></i></a></td>
        </tr>
    <?php endforeach ?>
    
  </tbody>
</table>
</div>


</body>
</html>