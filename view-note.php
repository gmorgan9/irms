<?php
session_start();
    include("database/connection.php");
    include("database/functions.php");
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
    <link rel="stylesheet" href="assets/css/style.css?v=2.17">

    <!-- Bootstrap Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>View Note - IRMS</title>
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
    <a href="javascript:history.back()"><button class="btn btn-primary rec">Back</button></a>
</div>
<br>

    <?php
      $viewid = $_GET['viewid'];
      $sql = "SELECT * FROM notes where id=$viewid";
      $result = mysqli_query($con, $sql);
      if($result) {
          while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['id'];
            $date = $row['date'];
            $title = $row['title'];
            $note = $row['note'];
            $tag = $row['tag'];
          }
          $fullDate = date("M d, Y", strtotime($date));
        }
            ?>


<br>
<div class="record_incident">
    <a href="incident-notes.php"><button class="btn btn-primary rec">Back</button></a>
</div>

<br><br>

            <h1 class="text-center"><?php echo $title; ?></h1>
            <p class="text-center text-muted"><?php echo $fullDate; ?></p>
            <div class="mx-auto" style="width:1200px;">
            <p><?php echo html_entity_decode($note); ?></p>
            </div>



</body>
</html>