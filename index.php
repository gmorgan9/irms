<?php 
include("path.php");
include(ROOT_PATH . "/app/controllers/users.php");
usersOnly();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" type="image/x-icon" href="/assets/images/fav.png?v=<?php echo time(); ?>">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">

  <!-- Custome Styles -->
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">

  <title>MorganFinances</title>
</head>
<body>

<?php include(ROOT_PATH . "/app/includes/header.php") ?>
<?php include(ROOT_PATH . "/app/includes/messages.php"); ?>



  <!-- Page Wrapper -->
  <div class="page-wrapper">

   
    <div class="content clearfix">

      <!-- Main Content -->
      <div class="main-content">
        

<button><a href="admin/dashboard.php">Head to the Dashboard</a></button>

      </div>
      <!-- // Main Content -->


  </div>
  <!-- // Page Wrapper -->