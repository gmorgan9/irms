<?php
    include("database/connection.php");
    include("database/functions.php");

    // check to see if there is a user already logged in, if so redirect them 
    session_start(); 
    if (isset($_SESSION['user_name']) && isset($_SESSION['id'])) 
        header("Location: index.php");  // redirect the user to the home page

        if (isset($_POST['registerBtn'])){ 
            // get all of the form data 
            $full_name = $_POST['full_name'];
            $email_address = $_POST['email_address']; 
            $user_name = $_POST['user_name'];
            $password = $_POST['password']; 
            $confirm_password = $_POST['confirm_password']; 

            if ($user_name != "" && $password != "" && $confirm_password != ""){
                // make sure the two passwords match
                if ($password === $confirm_password){
                    // make sure the password meets the min strength requirements
                    if ( strlen($password) >= 5 && strpbrk($password, "!#$.,:;()") != false ){
                        // next code block
                    }
                    else
                        $error_msg = 'Your password is not strong enough. Please use another.';
                }
                else
                    $error_msg = 'Your passwords did not match.';
            }
            else
                $error_msg = 'Please fill out all required fields.';

                // query the database to see if the username is taken
$query = mysqli_query($cnn, "SELECT * FROM users WHERE user_name='{$user_name}'");
if (mysqli_num_rows($query) == 0){
    // create and format some variables for the database
    $id = '';
    $password = md5($password);
    $date_created = time();
    $last_login = 0;
    $status = 1;
    
    // next code block
}
else
    $error_msg = 'The username <i>'.$user_name.'</i> is already taken. Please use another.';

    // insert the user into the database
mysqli_query($con, "INSERT INTO users VALUES (
    '{$id}', '{$user_name}', '{$email_address}', '{$password}', '{$date_created}', '{$last_login}', '{$status}'
)");

// verify the user's account was created
$query = mysqli_query($con, "SELECT * FROM users WHERE user_name='{$user_name}'");
if (mysqli_num_rows($query) == 1){
    
    /* IF WE ARE HERE THEN THE ACCOUNT WAS CREATED! YAY! */
    /* WE WILL SEND EMAIL ACTIVATION CODE HERE LATER */

    $success = true;
}
else
    $error_msg = 'An error occurred and your account was not created.';
   
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
    <link rel="stylesheet" href="assets/css/style.css?v=1.98">

    <!-- Bootstrap Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Home</title>
</head>
<body>
    <div class="header">
        <h2 class="logo">
            Incident Record Management System
        </h2>
    </div>


<br><br>
<div class="d-flex justify-content-center">
    <!-- form start -->
<form action="register.php" class="reg-form" method="post">

<?php
		// check to see if the user successfully created an account
		if (isset($success) && $success == true){
			echo '<p color="green">Yay!! Your account has been created. <a href="./login.php">Click here</a> to login!<p>';
		}
		// check to see if the error message is set, if so display it
		else if (isset($error_msg))
			echo '<p color="red">'.$error_msg.'</p>';
		
	?>


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
<h2 class="text-center">Registration</h2>
    <br>


    <div class="d-flex justify-content-center">
	<div class="form-group input-group w-75">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="full_name" class="form-control" placeholder="Full name" type="text">
</div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
    <div class="form-group input-group w-75">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="email_address" class="form-control" placeholder="Email address" type="email">
</div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
    <div class="form-group input-group w-75">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-at"></i> </span>
		 </div>
        <input name="user_name" class="form-control" placeholder="User Name" type="text">
</div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
    <div class="form-group input-group w-75">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="password" class="form-control" placeholder="Create password" type="password">
</div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
    <div class="form-group input-group w-75">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		</div>
        <input name="confirm_password" class="form-control" placeholder="Repeat password" type="password">
</div>
    </div> <!-- form-group// -->      
    <div class="d-flex justify-content-center">                                
    <button id="button" type="submit" name="registerBtn" class="btn btn-primary text-center reg-log">Create Account</button>  
</div> 
    <p class="text-center">Have an account? <a href="/login.php" style="color: black;">Log In</a> </p>                                                                 
</form>
</div>
<a href="/">back</a>

</body>
</html>