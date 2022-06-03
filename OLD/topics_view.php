<?php include('functions.php'); ?>

<?php 
if (!isAdmin() && !isSuperAdmin()) {
	header('location: /');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Topics - Documentation</title>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
  <link rel="icon" type="image/x-icon" href="fav.png">
  
</head>
<body>

  <div class="createpost-header">
        <h2>Manage Topics</h2>
        
    </div>


   <form class="createpostform" method="post" action="register.php">
<?php echo display_error(); ?>
	<div class="input-group">
		<label>Topic</label>
		<input type="text" name="username" value="<?php echo $username; ?>">
	</div>
	<div class="input-group">
		<label>Descriptions</label>
		<input type="email" name="email" value="<?php echo $email; ?>">
	</div>
	<div class="input-group">
		<button type="submit" class="log-btn" name="register_btn">Publish</button>
		<a href="javascript:history.back()" name="btn" class="log-btn">Back</a>
	</div>
</form>

<br><br>
   



    </div>

    
</body>
</html>