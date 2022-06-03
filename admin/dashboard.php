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
        <!-- Custom Styling -->
        <link rel="stylesheet" href="../../assets/css/style.css?v=<?php echo time(); ?>">

        <!-- Admin Styling -->
        <link rel="stylesheet" href="../../assets/css/admin.css?v=<?php echo time(); ?>">

        <!-- Favicon -->
        <link rel="icon" type="image/x-icon" href="/assets/images/fav.png?v=<?php echo time(); ?>">

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

</div>

</div>
<!-- // Admin Content -->

</div>
<!-- // Page Wrapper -->

<!-- Custom Script -->
<script src="../assets/js/scripts.js"></script>

</body>
</html>