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
<br>
<div class="record_incident">
    <a href="record-incident.php"><button class="btn btn-primary rec">Record Incident</button></a>
</div>

<br>
<?php  if (isset($_SESSION['username'])) : ?>
    	<h1 style="margin-left: 150px;" class="text-center">Welcome <strong><?php echo $_SESSION['username']; ?></strong></h1>
    <?php endif ?>
    <br>


<div class="row row_one">
    <div class="card" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <h1>
            <?php
            $sql="select count('1') from incidents where status=1";
            $result=mysqli_query($con,$sql);
            $rowtotal=mysqli_fetch_array($result); 
            echo "$rowtotal[0]";
        ?>
        </h1>
            </div>
            <div class="d-flex justify-content-center">
                <a href="/open-incidents.php" class="btn stretched-link">Open Incidents</a>
            </div>
        </div>
    </div>
</div>
<div class="card" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <h1>
            <?php
            $sql="select count('1') from incidents where status=1";
            $result=mysqli_query($con,$sql);
            $rowtotal=mysqli_fetch_array($result); 
            echo "$rowtotal[0]";
        ?>
        </h1>
            </div>
            <div class="d-flex justify-content-center">
                <a href="/open-incidents.php" class="btn stretched-link">Open Incidents</a>
            </div>
        </div>
    </div>
</div>
<div class="card" style="width: 18rem;">
    <div class="card-body d-flex flex-column align-items-center">
        <div class="card-body">
            <div class="d-flex justify-content-center">
                <h1>
            <?php
            $sql="select count('1') from incidents where status=1";
            $result=mysqli_query($con,$sql);
            $rowtotal=mysqli_fetch_array($result); 
            echo "$rowtotal[0]";
        ?>
        </h1>
            </div>
            <div class="d-flex justify-content-center">
                <a href="/open-incidents.php" class="btn stretched-link">Open Incidents</a>
            </div>
        </div>
    </div>
</div>

</div>



</body>
</html>
