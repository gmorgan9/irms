<?php include('functions.php'); ?>

<?php 
if (!isAdmin() && !isSuperAdmin()) {
	header('location: /');
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Create Post - Documentation</title>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
  <link rel="icon" type="image/x-icon" href="fav.png">

<script src="https://cdn.tiny.cloud/1/2sddc400jjfw2d2yznqcgv72n3r6b6dalq0dmscmz79t1ysl/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  
</head>
<body>

  <div class="createpost-header">
        <h2>Create Post</h2>
        
    </div>


   <form class="createpostform" method="post" action="register.php">
<?php echo display_error(); ?>
	<div class="input-group">
		<label>KB Title</label>
		<input type="text" name="username" value="<?php echo $username; ?>">
	</div>
	<div class="input-group">
		<label>Email</label>
		<input type="email" name="email" value="<?php echo $email; ?>">
	</div>
	<div class="input-group">
		<label>KB Content</label>
    <textarea name="kb_post" id="" cols="30" rows="50"></textarea>
	</div>
	<div class="input-group">
		<button type="submit" class="log-btn" name="register_btn">Publish</button>
		<a href="javascript:history.back()" name="btn" class="log-btn">Back</a>
	</div>
</form>

<br><br>
   



    </div>


    <script>
    tinymce.init({ selector: 'textarea',
     plugins: 'a11ychecker advcode casechange export formatpainter linkchecker autolink lists checklist media mediaembed pageembed permanentpen powerpaste table advtable tinycomments tinymcespellchecker',
     toolbar: 'a11ycheck addcomment showcomments casechange checklist code export formatpainter pageembed permanentpen table',
     toolbar_mode: 'floating',
     tinycomments_mode: 'embedded',
     tinycomments_author: 'Author name',
   });
  </script>

    
</body>
</html>