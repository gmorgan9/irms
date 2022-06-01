<?php
session_start();
    include("database/connection.php");
    include("database/functions.php");
    

    // Define variables and initialize with empty values
$user_name = $password = $confirm_password = "";
$user_name_err = $password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate username
    if(empty(trim($_POST["user_name"]))){
        $user_name_err = "Please enter a username.";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["user_name"]))){
        $user_name_err = "Username can only contain letters, numbers, and underscores.";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE user_name = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_user_name);
            
            // Set parameters
            $param_user_name = trim($_POST["user_name"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $user_name_err = "This username is already taken.";
                } else{
                    $user_name = trim($_POST["user_name"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
    
    // Check input errors before inserting in database
    if(empty($user_name_err) && empty($password_err) && empty($confirm_password_err)){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (user_name, password) VALUES (?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ss", $param_user_name, $param_password);
            
            // Set parameters
            $param_user_name = $user_name;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($con);
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
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="reg-form" method="post">


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


    <!-- <div class="d-flex justify-content-center">
	<div class="form-group input-group w-75">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
        <input name="full_name" class="form-control" placeholder="Full name" type="text">
        </div>
    </div>  -->
    <!-- form-group// -->
    <!-- <div class="d-flex justify-content-center">
    <div class="form-group input-group w-75">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="email" class="form-control" placeholder="Email address" type="email">
</div>
    </div>  -->
    <!-- form-group// -->
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
    <button id="button" type="submit" name="submit" class="btn btn-primary text-center reg-log">Create Account</button>  
</div> 
    <p class="text-center">Have an account? <a href="/login.php" style="color: black;">Log In</a> </p>                                                                 
</form>
</div>
<a href="/">back</a>

</body>
</html>