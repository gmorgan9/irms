<?php
session_start();
    include("database/connection.php");
    include("database/functions.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        //something was posted
        $fullName = $_POST['fullName'];
        $emailAddress = $_POST['emailAddress'];
        $userName = $_POST['userName'];
        $password = $_POST['password'];
        // $confirmPassword = $_POST['confirmPassword'];

        if(!empty($fullName) && !empty($emailAddress) && !empty($userName) && !empty($password) && !empty($confirmPassword) && !is_numeric($userName))
        {
            //save to database
            $user_id = random_num(20);
            $query = "insert into users (user_id,fullName,emailAddress,userName,password) values ('$user_id','$fullName','$emailAddress','$userName','$password')";
            
            mysqli_query($query);

            header("Location: login.php");
            die;
        } else 
        {
            echo "Please enter a valid username!";
        }
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
<form class="reg-form" method="post">
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
        <input name="fullName" class="form-control" placeholder="Full name" type="text">
</div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
    <div class="form-group input-group w-75">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		 </div>
        <input name="emailAddress" class="form-control" placeholder="Email address" type="email">
</div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
    <div class="form-group input-group w-75">
    	<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-at"></i> </span>
		 </div>
        <input name="userName" class="form-control" placeholder="User Name" type="text">
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
        <input name="confirmPassword" class="form-control" placeholder="Repeat password" type="password">
</div>
    </div> <!-- form-group// -->      
    <div class="d-flex justify-content-center">                                
    <button type="submit" class="btn btn-primary text-center reg-log">Create Account</button>  
</div> 
    <p class="text-center">Have an account? <a href="/login.php" style="color: black;">Log In</a> </p>                                                                 
</form>
</div>
<a href="/">back</a>

</body>
</html>