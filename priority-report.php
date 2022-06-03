<?php 
session_start();
    include("database/connection.php");
    include("database/functions.php");

    $_SESSION['name'] = $name;

    if (!isset($_SESSION['username'])) {
        $_SESSION['msg'] = "You must log in first";
        header('location: login.php');
    }
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
    <link rel="stylesheet" href="assets/css/style.css?v=2.14">

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
    <div class="record_incident">
    <a href="/"><button class="btn btn-primary rec">Back</button></a>
</div>
<br>
<!-- <div class="record_incident">
    <a href="record-incident.php"><button class="btn btn-primary rec">Record Incident</button></a>
</div> -->

<br>
<?php  if (isset($_SESSION['username'])) : ?>
    	<h1 class="text-center">Welcome <strong><?php echo $_SESSION['username']; ?></strong></h1>
    <?php endif ?>
    <br>

<div class="col d-flex justify-content-center">
<div class="row row_one">
    <div class="card open-count" style="width: 15rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <h1 class="text-center" style="font-size: 100px;">
            <?php
            $sql="select count('1') from incidents where priority=2";
            $result=mysqli_query($con,$sql);
            $rowtotal=mysqli_fetch_array($result); 
            echo "$rowtotal[0]";
        ?>
        </h1>
            </div>
            <div class="d-flex justify-content-center">
            <p class="text-center">Priority 2</p>
            </div>
        </div>
    </div>
</div>
<div class="card open-count" style="width: 15rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <h1 class="text-center" style="font-size: 100px;">
            <?php
            $sql="select count('1') from incidents where priority=3";
            $result=mysqli_query($con,$sql);
            $rowtotal=mysqli_fetch_array($result); 
            echo "$rowtotal[0]";
        ?>
        </h1>
            </div>
            <div class="d-flex justify-content-center">
                <p class="text-center">Priority 3</p>
            </div>
        </div>
    </div>
</div>
<div class="card open-count" style="width: 15rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="d-flex justify-content-center">
            
            <h1 class="text-center" style="font-size: 100px;">
            <?php
            $sql="select count('1') from incidents where priority=4";
            $result=mysqli_query($con,$sql);
            $rowtotal=mysqli_fetch_array($result); 
            echo "$rowtotal[0]";
        ?>
        </h1>
            </div>
            <div class="d-flex justify-content-center">
            <p class="text-center">Priority 4</p>
            </div>
        </div>
    </div>
</div>

</div>
</div>
<br><br><br>
<div class="col d-flex justify-content-center">
    <h2>Priority 2</h2>
</div>
<div class="col d-flex justify-content-center">
<table class="table table-hover table-light">
  <thead>
    <tr class="header-line">
      <th scope="col">#</th>
      <th scope="col">Status</th>
      <th scope="col">Incident Number</th>
      <th scope="col">Priority</th>
      <th scope="col">Description</th>
      <!-- <th scope="col">Assignment Group</th> -->
      <!-- <th scope="col">KB Article</th> -->
      <th scope="col">Date</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>

      <?php

      $sql = "SELECT * FROM incidents where priority=2";
      $result = mysqli_query($con, $sql);
      if(mysqli_num_rows($result) > 0) {
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
            </tr>
         <?php } 
    }else { ?> 
       
  </tbody>
</table>
<h5 class="text-center"> No Records Found!</h5> <br>
<?php
    } 
?>

</div>


<br>
<br>

<div class="col d-flex justify-content-center">
    <h2>Priority 3</h2>
</div>
<div class="col d-flex justify-content-center">
<table class="table table-hover table-light">
  <thead>
    <tr class="header-line">
      <th scope="col">#</th>
      <th scope="col">Status</th>
      <th scope="col">Incident Number</th>
      <th scope="col">Priority</th>
      <th scope="col">Description</th>
      <!-- <th scope="col">Assignment Group</th> -->
      <!-- <th scope="col">KB Article</th> -->
      <th scope="col">Date</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>

      <?php

      $sql = "SELECT * FROM incidents where priority=3";
      $result = mysqli_query($con, $sql);
      if(mysqli_num_rows($result) > 0) {
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
            </tr>
            <?php } 
    }else { ?> 

  </tbody>
</table>
<h5 class="text-center"> No Records Found!</h5> <br>
<?php
    } 
?>
</div>

<br>
<br>

<div class="col d-flex justify-content-center">
    <h2>Priority 4</h2>
</div>
<div class="col d-flex justify-content-center">
<table class="table table-hover table-light">
  <thead>
    <tr class="header-line">
      <th scope="col">#</th>
      <th scope="col">Status</th>
      <th scope="col">Incident Number</th>
      <th scope="col">Priority</th>
      <th scope="col">Description</th>
      <!-- <th scope="col">Assignment Group</th> -->
      <!-- <th scope="col">KB Article</th> -->
      <th scope="col">Date</th>
      <th scope="col">Time</th>
    </tr>
  </thead>
  <tbody>

      <?php

      $sql = "SELECT * FROM incidents where priority=4";
      $result = mysqli_query($con, $sql);
      if(mysqli_num_rows($result) > 0) {
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
            </tr>
            <?php } 
    }else { ?>

  </tbody>
</table>
</div>
<h5 class="text-center"> No Records Found!</h5> <br>
<?php
    } 
?>

</body>
</html>
