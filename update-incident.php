<?php
session_start();
    include("database/connection.php");

//     $id = intval(trim($_GET['id']));
//     if(isset($id) && is_numeric($id)) {
//     $sql = "SELECT * FROM incidents where id='$id' limit 1";
//     $result=mysqli_query($con,$sql);
//     $row=mysqli_fetch_assoc($result);
//    // $id=$row['id'];
//     $inc_num = $row['inc_num'];
//     $priority = $row['priority'];
//     $description = $row['description'];
//     $assign_group = $row['assign_group'];
//     $kb_article = $row['kb_article'];
//     $date = $row['date'];
//     $time = $row['time'];
    
//     if (isset($_POST['update'])) {
//         //$id = (int)$_POST['id'];
//         //$id=(INT)$_GET['id'];
//         $inc_num = $_POST['inc_num'];
//         $priority = $_POST['priority'];
//         $description = $_POST['description'];
//         $assign_group = $_POST['assign_group'];
//         $kb_article = $_POST['kb_article'];
//         $date = $_POST['date'];
//         $time = $_POST['time'];


//         $query = "UPDATE incidents SET inc_num='$inc_num',priority='$priority',description='$description',assign_group='$assign_group',kb_article='$kb_article',date='$date',time='$time' WHERE id='$id'";
//         echo "<br>";
// $query = "SELECT inc_num FROM incidents WHERE id = 1";
// $result = mysqli_query($con, $query);
// if (mysqli_num_rows($result) > 0) {
//     //print data of each row
//     while($row = mysqli_fetch_assoc($result)) {
//         echo "inc_num: " . $row["inc_num"];
//     }
// } else {
//     echo "No record exists";
// }




$inc_num = $priority = $description = $assign_group = $kb_article = $date = $time "";
$inc_num_err = $priority_err = $description_err = $assign_group_err = $kb_article_err = $date_err = $time_err "";

// Processing form data when form is submitted
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Get hidden input value
    $id = $_POST["id"];
    
   // Validate address address
   $input_inc_num = trim($_POST["inc_num"]);
   if(empty($input_inc_num)){
       $inc_num_err = "Please enter an address.";     
   } else{
       $inc_num = $input_inc_num;
   }
    
    // Validate address address
    $input_priority = trim($_POST["priority"]);
    if(empty($input_priority)){
        $priority_err = "Please enter an address.";     
    } else{
        $priority = $input_priority;
    }
    
    // Validate address address
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter an address.";     
    } else{
        $description = $input_description;
    }

    // Validate address address
    $input_assign_group = trim($_POST["assign_group"]);
    if(empty($input_assign_group)){
        $assign_group_err = "Please enter an address.";     
    } else{
        $assign_group = $input_assign_group;
    }

    // Validate address address
    $input_kb_article = trim($_POST["kb_article"]);
    if(empty($input_kb_article)){
        $kb_article_err = "Please enter an address.";     
    } else{
        $kb_article = $input_kb_article;
    }

    // Validate address address
    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "Please enter an address.";     
    } else{
        $date = $input_date;
    }
    $input_time = trim($_POST["time"]);
    if(empty($input_time)){
        $time_err = "Please enter an address.";     
    } else{
        $time = $input_time;
    }
    
    // Check input errors before inserting in database
    if(empty($inc_num_err) && empty($priority_err) && empty($description_err)
    && empty($assign_group_err) && empty($kb_article_err)
    && empty($date_err) && empty($time_err)){
        // Prepare an update statement
        $sql = "UPDATE incidents SET inc_num=?, priority=?, description=?, assign_group=?, kb_article=? , date=?, time=? WHERE id=?";
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "issssss", $param_id, $param_inc_num, $param_priority, $param_description, $param_assign_group, $param_kb_article, $param_date, $param_time);
            
            // Set parameters
            $param_id = $id;
            $param_inc_num = $inc_num;
            $param_priority = $priority;
            $param_description = $description;
            $param_assign_group = $assign_group;
            $param_kb_article = $kb_article;
            $param_date = $date;
            $param_time = $time;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM incidents WHERE id = ?";
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $inc_num = $row["inc_num"];
                    $priority = $row["priority"];
                    $description = $row["description"];
                    $assign_group = $row["assign_group"];
                    $kb_article = $row["kb_article"];
                    $date = $row["date"];
                    $time = $row["time"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: errors.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($con);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: errors.php");
        exit();
    }
}










        // Update Statement
        // $sql = "UPDATE incidents SET inc_num='$inc_num',priority='$priority',description='$description',assign_group='$assign_group',kb_article='$kb_article',date='$date',time='$time' WHERE id=$id";
        // $result=mysqli_query($con,$sql);
        // if(mysqli_affected_rows($con) == 1)
		// 	{
				
		// 		header('location: index.php');
		// 		exit();
		// 	}
		// 	else
		// 	{
		// 		echo 'Unable to save blog' ;
		// 	}


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


<br>
<div class="record_incident">
    <a href="javascript:history.back()"><button class="btn btn-primary rec">Back</button></a>
</div>
<br>

<div class="d-flex justify-content-center">

    <!-- form start -->
<form action="update-incident.php" class="reg-form" method="post">
<?php //include('errors.php'); ?>
<br>
<h2 class="text-center">Record Incident</h2>
<br>

    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-25">
            <div class="input-group-prepend">
	            <span class="input-group-text"> Identifer</span>
	        </div>
            <input name="id" class="form-control text-center" placeholder="Incident Number" type="text" value="<?php echo $id ?>" readonly>
        </div>
    </div> 
    <!-- form-group// -->
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
            <div class="input-group-prepend">
	            <span class="input-group-text"> <i class="fa-solid fa-hashtag"></i> </span>
	        </div>
            <input name="inc_num" class="form-control" placeholder="Incident Number" type="text" value="<?php echo $inc_num ?>">
        </div>
    </div> 
    <!-- form-group// -->
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa-solid fa-arrow-up-wide-short"></i> </span>
		    </div>
            <input name="priority" class="form-control" placeholder="Priority" type="text"value="<?php echo $priority ?>">
        </div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa-solid fa-pen-to-square"></i> </span>
		    </div>
            <input name="description" class="form-control" placeholder="Description" type="text" value="<?php echo $description ?>">
        </div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa fa-users fa-xs"></i> </span>
		    </div>
            <input name="assign_group" class="form-control" placeholder="Assignment Group" type="text" value="<?php echo $assign_group ?>">
        </div>
    </div> <!-- form-group// -->
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa fa-book"></i> </span>
		    </div>
            <input name="kb_article" class="form-control" placeholder="KB Artcile" type="text" value="<?php echo $kb_article ?>">
        </div>
    </div> <!-- form-group// -->    
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa fa-calendar-days"></i> </span>
		    </div>
            <input name="date" class="form-control" placeholder="Date" type="date" value="<?php echo $date ?>">
        </div>
    </div> <!-- form-group// -->    
    <div class="d-flex justify-content-center">
        <div class="form-group input-group w-75">
    	    <div class="input-group-prepend">
		        <span class="input-group-text"> <i class="fa fa-clock"></i> </span>
		    </div>
            <input name="time" class="form-control" placeholder="Time" type="time" value="<?php echo $time ?>">
        </div>
    </div> <!-- form-group// -->   
    <div class="d-flex justify-content-center">                                
        <button id="button" type="submit" name="update" class="btn btn-primary text-center reg-log">Update Incident</button>  
    </div>                                                               
</form>
</div>


</body>
</html>
