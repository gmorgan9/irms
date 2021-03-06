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

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="assets/img/bell-regular.svg">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="assets/css/style.css?v=2.14">

    <!-- Bootstrap Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Other Reports - IRMS</title>
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

<br>
    <h1 style="margin-left: 150px;" class="text-center"><strong>Other Reports</strong></h1>
<br>
<div class="col d-flex justify-content-center">
<div class="row row_one">
<div class="card" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="d-flex justify-content-center">
            <i class="fa-solid fa-file-lines fa-8x"></i> <br>
            </div>
            <div class="d-flex justify-content-center">
                <a href="#" class="btn stretched-link">Report 1</a>
            </div>
        </div>
    </div>
</div>
<div class="card" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="d-flex justify-content-center">
            <i class="fa-solid fa-file-lines fa-8x"></i> <br>
            </div>
            <div class="d-flex justify-content-center">
                <a href="#" class="btn stretched-link">Report 2</a>
            </div>
        </div>
    </div>
</div>
<div class="card" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="d-flex justify-content-center">
            <i class="fa-solid fa-file-lines fa-8x"></i> <br>
            </div>
            <div class="d-flex justify-content-center">
                <a href="#" class="btn stretched-link">Report 3</a>
            </div>
        </div>
    </div>
</div>
  </div>
  </div>
  <br>
<!-- Row 2 -->
<div class="col d-flex justify-content-center">
<div class="row">
<div class="card" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="d-flex justify-content-center">
            <i class="fa-solid fa-file-lines fa-8x"></i> <br>
            </div>
            <div class="d-flex justify-content-center">
                <a href="#" class="btn stretched-link" style="width: 200px;">Report 4</a>
            </div>
        </div>
    </div>
</div>
<div class="card" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <i class="fa-solid fa-file-lines fa-8x"></i> <br>
            </div>
            <div class="d-flex justify-content-center">
                <a href="#" class="btn stretched-link">Report 5</a>
            </div>
        </div>
    </div>
</div>
<div class="card" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="d-flex justify-content-center">
            <i class="fa-solid fa-file-lines fa-8x"></i> <br>
            </div>
            <div class="d-flex justify-content-center">
                <a href="#" class="btn stretched-link">Report 6</a>
            </div>
        </div>
    </div>
</div>
</div>
</div>

<br><br>

</body>
</html>
