<?php include("../path.php"); ?>
<?php 
include(ROOT_PATH . "/app/controllers/posts.php"); 
session_start();
adminOnly();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Section - Dashboard</title>
    <meta name="viewport" content="width=device-width">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" type="image/x-icon" href="../assets/images/fav.png?v=<?php echo time(); ?>">

    <!-- Custom Styling -->
    <link rel="stylesheet" href="../assets/css/style.css?v=<?php echo time(); ?>">  

    <!-- Admin Styling -->
    <link rel="stylesheet" href="../assets/css/admin.css?v=<?php echo time(); ?>">

    <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">
</head>
<body>

<?php include(ROOT_PATH . "/app/includes/adminHeader.php"); ?>

<!-- Admin Page Wrapper -->
<div class="admin-wrapper">

<?php include(ROOT_PATH . "/app/includes/adminSidebar.php") ?>
        
<!-- Admin Content -->
<div class="admin-content">

<div class="content">

    <h2 class="page-title">Dashboard</h2>

    <?php include(ROOT_PATH . '/app/includes/messages.php'); ?>






    <div class="row1">
  <div class="column1">
    <div class="card1">
      <p><i id="img" class="fa fa-calendar"></i></p>
      <h3 style="color:white;">
        <?php 
          $servername = "localhost";
          $username = "gmorg";
          $password = "gmorgpass";
          $dbname = "finance";
          $conn = new mysqli($servername, $username, $password, $dbname);
          $sql = "SELECT  ROUND(SUM(amount), 2) from expenses WHERE MONTH(date) = MONTH(now())";
          $result = $conn->query($sql);
          while($row = mysqli_fetch_array($result)){
            echo "$" . $row['ROUND(SUM(amount), 2)'];
          }
        ?>
      </h3>
      <p>Current Expenses for <?php echo date('F'); ?></p>
    </div>
  </div>

  <div class="column1">
    <div class="card1">
      <p><i id="img" class="fa fa-calendar"></i></p>
      <h3 style="color:white;">
        <?php 
          $servername = "localhost";
          $username = "gmorg";
          $password = "gmorgpass";
          $dbname = "finance";
          $conn = new mysqli($servername, $username, $password, $dbname);
          $sql = "SELECT  ROUND(SUM(amount), 2) from income WHERE MONTH(date) = MONTH(now())";
          $result = $conn->query($sql);
          while($row = mysqli_fetch_array($result)){
            echo "$" . $row['ROUND(SUM(amount), 2)'];
          }
        ?>
      </h3>
      <p>Current Income for <?php echo date('F'); ?></p>
    </div>
  </div>

  <div class="column1">
    <div class="card1">
      <p><i id="img" class="fas fa-exchange-alt"></i></p>
      <h3 style="color:white;">
        <?php 
          $servername = "localhost";
          $username = "gmorg";
          $password = "gmorgpass";
          $dbname = "finance";
          $conn = new mysqli($servername, $username, $password, $dbname);
          $sql = "SELECT  ROUND(SUM(amount), 2) from expenses WHERE YEAR(date) = YEAR(now())";
          $result = $conn->query($sql);
          while($row = mysqli_fetch_array($result)){
            echo "$" . $row['ROUND(SUM(amount), 2)'];
          }
        ?>
      </h3>
      <p>Your Total Expenses for <?php echo date('Y'); ?></p>
    </div>
  </div>

  <div class="column1">
    <div class="card1">
      <p><i id="img" class="fa fa-money-bill"></i></p>
      <h3 style="color:white;">
        <?php 
          $servername = "localhost";
          $username = "gmorg";
          $password = "gmorgpass";
          $dbname = "finance";
          $conn = new mysqli($servername, $username, $password, $dbname);
          $sql = "SELECT  ROUND(SUM(amount), 2) from income WHERE YEAR(date) = YEAR(now())";
          $result = $conn->query($sql);
          while($row = mysqli_fetch_array($result)){
            echo "$" . $row['ROUND(SUM(amount), 2)'];
          }
        ?>
      </h3>
      <p>Your Total Income for <?php echo date('Y'); ?></p>
    </div>
  </div>
</div>





</div>


</div>
<!-- // Admin Content -->


<style>
  .column1 {
  float: left;
  width: 25%;
  padding: 0 5px;
}

.row1 {
  margin: 0 -5px;
}

/* Clear floats after the columns */
.row1:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive columns */
@media screen and (max-width: 600px) {
  .column1 {
    width: 100%;
    display: block;
    margin-bottom: 10px;
  }
}

/* Style the counter cards */
.card1 {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  padding: 16px;
  text-align: center;
  background-color: #444;
  color: white;
}

#img {font-size:50px;}
</style>





</div>
<!-- // Page Wrapper -->

<!-- Custom Script -->
<script src="../assets/js/scripts.js"></script>

</body>
</html>