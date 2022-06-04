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

    <!-- CKEDITOR -->
    <script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
    <script src="ckeditor/ckeditor.js"></script>

    <title>View Note - IRMS</title>
</head>
<body>
    <div class="header">
        <h2 class="logo">
            Incident Record Management System
        </h2>
    </div>

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
          }
          $newDate = date("MMM-d-Y", strtotime($date));
        }
            ?>

<br><br>

            <h1 class="text-center"><?php echo $title; ?></h1>
            <p class="text-center text-muted"><?php echo $newDate; ?></p>
            <div class="mx-auto" style="width:1200px;">
            <p><?php echo html_entity_decode($note); ?></p>
            </div>



</body>
</html>