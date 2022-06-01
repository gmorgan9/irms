<?php
session_start();
    include("database/connection.php");
    include("database/functions.php");

    if (isset($_POST['submit'])) {
        if (isset($_POST['name']) && isset($_POST['email']) && 
        isset($_POST['username']) && isset($_POST['password']) &&
        isset($_POST['confirm_password'])) {

        $name = $_POST['name'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        $Select = "SELECT username FROM users WHERE username = ? LIMIT 1";
        $Insert = "INSERT INTO users (name, email, username, password,) values(?, ?, ?, ?)";

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "Morgan22!";
        $dbName = "irms";
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {

        $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($resultUsername);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;

            if ($rnum == 0) {
                $stmt->close();
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("ssssii",$username, $password, $gender, $email, $phoneCode, $phone);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registers using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
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
<form action="register.php" class="reg-form" method="post">
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
            <input name="name" class="form-control" placeholder="Full name" type="text">
        </div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
		    </div>
            <input name="email" class="form-control" placeholder="Email address" type="email">
        </div>
    </div> <!-- form-group// -->
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