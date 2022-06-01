<?php 
session_start();
    include("database/connection.php");
    include("database/functions.php");

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
    <link rel="stylesheet" href="assets/css/style.css?v=2.12">

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
                <h1 class="text-center" style="font-size: 100px;">2</h1>
                <p class="text-center">Open Incidents</p>
            </div>
        </div>
    </div>
</div>
<br><br><br>





<table>
            <tr>
                <th>Inc</th>
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS-->
            <?php   // LOOP TILL END OF DATA
                while($rows=$result->fetch_assoc())
                {
             ?>
            <tr>
                <!--FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN-->
                <td><?php echo $rows['inc_num'];?></td>
            </tr>
            <?php
                }
             ?>
        </table>




<?php



$sql = "SELECT inc_num, priority, description FROM incidents";
$result = $con->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  foreach($row = $result->fetch_assoc()) { ?>
  <table class="table table-hover table-light">
  <thead>
    <tr class="header-line">
      <th scope="col">#</th>
      <!-- <th scope="col">Number</th>
      <th scope="col">Severity</th>
      <th scope="col">Description</th>
      <th scope="col">Assignment Group</th>
      <th scope="col">KB Article</th>
      <th scope="col">Date</th> -->
    </tr>
  </thead>
  <tbody>
    <tr>
        <?php 

    echo "<td scope='row'>" . $row["inc_num"] . "</td>";
    //id: " . $row["inc_num"]. " - Name: " . $row["priority"]. " " . $row["description"]. "<br>";
  }
} else {
  echo "0 results";
}
$con->close();
?>




<br><br><br>




<div class="col d-flex justify-content-center">
<table class="table table-hover table-light">
  <thead>
    <tr class="header-line">
      <th scope="col">#</th>
      <th scope="col">Number</th>
      <th scope="col">Severity</th>
      <th scope="col">Description</th>
      <th scope="col">Assignment Group</th>
      <th scope="col">KB Article</th>
      <th scope="col">Date</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>INC06909359</td>
      <td>P3</td>
      <td style="max-width: 30em;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;width:100px; ">Calgary Alberta  Temple High Ping on Host: CALGAHV001---Result: PING CRITICAL - Packet loss = 25%, RTA = 1012.25</td>
      <td>CHQ-OPS</td>
      <td>N/A</td>
      <td>06/01/2022</td>
    </tr>
  </tbody>
</table>
</div>


</body>
</html>