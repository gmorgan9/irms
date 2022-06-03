<?php include('functions.php'); ?>

<?php
if (isLoggedIN()) {
	header('location: /');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Account</title>
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
	<link rel="icon" type="image/x-icon" href="fav.png">
</head>
<body>
<?php include("app/includes/header.php") ?>

<!-- test account -->
<script src="assets/js/tabs.js"></script>
<div class="all_tabs">
<!-- Tab links -->
<div class="tab">
  <button class="tablinks" onclick="accountTabs(event, 'Login')" id="defaultOpen">Login</button>
  <button class="tablinks" onclick="accountTabs(event, 'Register')">Register</button>
</div>

<!-- Tab content -->
<div id="Login" class="tabcontent">
<form method="post" action="account.php">

<?php echo display_error(); ?>

<div class="input-group">
	<label>Username</label>
	<input type="text" name="username" >
</div>
<div class="input-group">
	<label>Password</label>
	<input type="password" name="password">
</div>
<div class="input-group">
	<button type="submit" class="log-btn" name="login_btn">Login</button>
	<a href="javascript:history.back()" name="btn" class="log-btn" >Back</a>
</div>
<p>
	Not yet a member? <a href="register.php">Sign up</a>
</p>
</form>
</div>

<div id="Register" class="tabcontent">
<form method="post" action="account.php">
<?php echo display_error(); ?>
	<div class="input-group">
		<label>Username</label>
		<input type="text" name="username" value="<?php echo $username; ?>">
	</div>
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" value="<?php echo $email; ?>">
	</div>
	<div class="input-group">
		<label>Password</label>
		<input type="password" name="password_1">
	</div>
	<div class="input-group">
		<label>Confirm password</label>
		<input type="password" name="password_2">
	</div>
	<div class="input-group">
		<button type="submit" class="log-btn" name="register_btn">Register</button>
		<a href="javascript:history.back()" name="btn" class="log-btn">Back</a>
	</div>
	<p>
		Already a member? <a href="login.php">Sign in</a>
	</p>
</form>
</div>

</div>
<script>
// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>

</body>
</html>