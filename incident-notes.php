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
    <link rel="stylesheet" href="assets/css/style.css?v=2.23">

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

<?php 
$sql = "SELECT * FROM notes";
$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result) == 0 ) {
?>
<h3 class="text-center">No records found!</h3>
<?php 
    } else {
?>

<div class="col d-flex justify-content-center">
<table class="table table-hover table-light">
  <thead>
    <tr class="header-line">
      <th scope="col">#</th>
      <th scope="col">Date</th>
      <th scope="col">Title</th>
      <th scope="col">Note</th>
      <th scope="col">Tag</th>
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
            <td scope="row"><?php echo $date; ?></td>
            <td scope="row"><?php echo $title; ?></td>
            <td style="page-break-inside: avoid !important;"><?php echo $note; ?></td>
            <td scope="row"><?php echo $tag; ?></td>
            <td scope="row"><?php echo $time; ?></td>
            <td scope="row"><a href="view-note.php?viewid=<?php echo $id; ?>"><i class="fa-solid fa-eye" style="color:#1f7828;"></a></i></td>
            <td scope="row"><a href="update-note.php?updateid=<?php echo $id; ?>"><i class="fa-solid fa-pen-to-square" style="color:#005382;"></a></i></td>
            <td scope="row"><a href="incident-notes.php?id=<?php echo $id; ?>" class="delete"><i class="fa-solid fa-trash-can" style="color:#941515;"></i></a></td>
            </tr>
         <?php }
      }
?>
  </tbody>
</table>
</div>
<?php 
    }
?>


</body>
</html>
