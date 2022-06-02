<?php
session_start();
    include("database/connection.php");
    //include("database/functions.php");

    $results = mysqli_query($con, "SELECT * FROM incidents where inc_id='$inc_id'");
    // if (isset($_GET['edit-incident'])) {
	// 	$incident = $results;
	// }

    if(isset($_POST['update_incident']))
{
    $inc_num = $_POST['inc_num'];
    $priority = $_POST['priority'];
    $description = $_POST['description'];
    $assign_group = $_POST['assign_group'];
    $kb_article = $_POST['kb_article'];
    $date = $_POST['date'];
    $time = $_POST['time'];	
    $result = mysqli_query($mysqli, "UPDATE incidents SET inc_num='$inc_num', priority='$priority', description='$description', assign_group='$assign_group', kb_article='$kb_article', date='$date', time='$time'");
    header("Location: /"); 
}

    $inc_id = $_GET['inc_id'];
    $result = mysqli_query($mysqli, "SELECT * FROM incidents WHERE inc_id=$inc_id");
    while($res = mysqli_fetch_array($result))
{
    $inc_num = $res['inc_num'];
    $priority = $res['priority'];
    $description = $res['description'];
    $assign_group = $res['assign_group'];
    $kb_article = $res['kb_article'];
    $date = $res['date'];
    $time = $res['time'];	
}


    //$all_incidents = getAllInc();
    
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

    <title>Update Incident - IRMS</title>
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
    <?php while ($incident = mysqli_fetch_assoc($results)) { ?>
<form action="edit-incident.php" class="reg-form" method="post">
<?php //include('errors.php'); ?>
<br>
<h2 class="text-center">Update Incident</h2>
<br>

    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
            <div class="input-group-prepend">
	            <span class="input-group-text"> <i class="fa-solid fa-hashtag"></i> </span>
	        </div>
            <input name="inc_num" class="form-control" placeholder="Incident Number" type="text" value="<?php echo $inc_num; ?>">
        </div>
    </div> 
    <!-- form-group// -->
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa-solid fa-arrow-up-wide-short"></i> </span>
		    </div>
            <input name="priority" class="form-control" placeholder="Priority" type="text" value="<?php echo $priority; ?>">
        </div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa-solid fa-pen-to-square"></i> </span>
		    </div>
            <input name="description" class="form-control" placeholder="Description" type="text" value="<?php echo $description; ?>">
        </div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa fa-users fa-xs"></i> </span>
		    </div>
            <input name="assign_group" class="form-control" placeholder="Assignment Group" type="text" value="<?php echo $assign_group; ?>">
        </div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa fa-book"></i> </span>
		    </div>
            <input name="kb_article" class="form-control" placeholder="KB Artcile" type="text" value="<?php echo $kb_article; ?>">
        </div>
    </div> <!-- form-group// -->    
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa fa-calendar-days"></i> </span>
		    </div>
            <input name="date" class="form-control" placeholder="Date" type="date" value="<?php echo $date;?>">
        </div>
    </div> <!-- form-group// -->    
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa fa-clock"></i> </span>
		    </div>
            <input name="time" class="form-control" placeholder="Time" type="time" value="<?php echo $time; ?>">
        </div>
    </div> <!-- form-group// -->   
    <div class="d-flex justify-content-center">                                
        <button id="button" type="submit" name="update_incident" class="btn btn-primary text-center reg-log">Update Incident</button>  
    </div>                                                               
</form>
</div>
<?php } ?>

</body>
</html>