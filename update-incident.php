<?php
session_start();
    include("database/connection.php");
    //include("database/functions.php");
    $inc_id=$_GET['updateid'];
    if(isset($_POST['update'])) {
        //$inc_id=$row['inc_id'];
        $inc_num = $row['inc_num'];
        $priority = $row['priority'];
        $description = $row['description'];
        $assign_group = $row['assign_group'];
        $kb_article = $row['kb_article'];
        $date = $row['date'];
        $time = $row['time'];

        $sql = "UPDATE incidents SET inc_id=$inc_id, inc_num='$inc_num', priority='$priority', description='$description', assign_group='$assign_group', kb_article='$kb_article', date='$date', time='$time' WHERE inc_id=$inc_id";
        $result=mysqli_query($con,$sql);
        if($result) {
            echo "Updated Successfully";
            // header('location: all-incidents.php'); // returns back to same page
        } else {
            die(mysqli_error($con));
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
    <link rel="stylesheet" href="assets/css/style.css?v=2.14">

    <!-- Bootstrap Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <title>Record Incident - IRMS</title>
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
<form action="update-incident.php" class="reg-form" method="post">
<?php //include('errors.php'); ?>
<br>
<h2 class="text-center">Record Incident</h2>
<br>

    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
            <div class="input-group-prepend">
	            <span class="input-group-text"> <i class="fa-solid fa-hashtag"></i> </span>
	        </div>
            <input name="inc_num" class="form-control" placeholder="Incident Number" type="text">
        </div>
    </div> 
    <!-- form-group// -->
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa-solid fa-arrow-up-wide-short"></i> </span>
		    </div>
            <input name="priority" class="form-control" placeholder="Priority" type="text">
        </div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa-solid fa-pen-to-square"></i> </span>
		    </div>
            <input name="description" class="form-control" placeholder="Description" type="text">
        </div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa fa-users fa-xs"></i> </span>
		    </div>
            <input name="assign_group" class="form-control" placeholder="Assignment Group" type="text">
        </div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa fa-book"></i> </span>
		    </div>
            <input name="kb_article" class="form-control" placeholder="KB Artcile" type="text">
        </div>
    </div> <!-- form-group// -->    
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa fa-calendar-days"></i> </span>
		    </div>
            <input name="date" class="form-control" placeholder="Date" type="date">
        </div>
    </div> <!-- form-group// -->    
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa fa-clock"></i> </span>
		    </div>
            <input name="time" class="form-control" placeholder="Time" type="time">
        </div>
    </div> <!-- form-group// -->   
    <div class="d-flex justify-content-center">                                
        <button id="button" type="submit" name="update" class="btn btn-primary text-center reg-log">Update Incident</button>  
    </div>                                                               
</form>
</div>

</body>
</html>