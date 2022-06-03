<?php include('path.php'); ?>
<?php 
//include(ROOT_PATH . "/app/controllers/users.php"); 
//guestsOnly();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
    integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="/assets/images/fav.png?v=<?php echo time(); ?>">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Candal|Lora" rel="stylesheet">

  <!-- Custom Styling -->
  <link rel="stylesheet" href="assets/css/style.css?v=<?php echo time(); ?>">

  <title>Login</title>
</head>

<body>

<?php include(ROOT_PATH . "/app/includes/header.php"); ?>


<div class="d-flex justify-content-center">
<form action="login.php" class="log-form" method="post">
<?php //include('errors.php'); ?>

<div class="form-header d-flex justify-content-center">
    <div class="bg-circle">
        <div class="sm-circle">
        <div class="d-flex justify-content-center">
        <i class="user-header fa-solid fa-user fa-3x"></i>
</div>
        </div>
    </div>
</div>
<br>
<h2 class="text-center">Member Login</h2>
    <br>
    
    <div class="d-flex justify-content-center">
    <div class="form-group input-group w-75">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-at"></i> </span>
		 </div>
        <input name="username" class="form-control" placeholder="User Name" type="text">
</div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
    <div class="form-group input-group w-75">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="password" class="form-control" placeholder="Enter password" type="password">
</div>
    </div> <!-- form-group// -->   
    <div class="d-flex justify-content-center">                                
    <button type="submit" name="login-btn" class="btn btn-primary text-center reg-log">Log In</button>  
</div> 
    <p class="text-center">Don't have an account? <a href="/register.php" style="color: black;">Register</a> </p>                                                                 
</form>
</div>


  <div class="auth-content">

    <form action="login.php" method="post">
      <h2 class="form-title">Login</h2>

      <?php include(ROOT_PATH . "/app/helpers/formErrors.php"); ?>

      <div>
        <label>Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>" class="text-input">
      </div>
      <div>
        <label>Password</label>
        <input type="password" name="password" value="<?php echo $password; ?>" class="text-input">
      </div>
      <div>
        <button type="submit" name="login-btn" class="btn btn-big">Login</button>
      </div>
      <p>Or <a href="<?php echo BASE_URL . '/register.php' ?>">Sign Up</a></p>
    </form>

  </div>


  <!-- JQuery -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <!-- Custom Script -->
  <script src="assets/js/scripts.js"></script>

</body>

</html>