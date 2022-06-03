<?php
session_start();
    include("database/connection.php");
    //include("database/functions.php");


   // Define variables and initialize with empty values
   $status = $inc_num = $priority = $description = $assign_group = $kb_article = $date = $time = "";
   $inc_num_err = $priority_err = $description_err = $assign_group_err = $kb_article_err = $date_err = $time_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["update"])){
    // Get hidden input value
    $id = $_POST["id"];
    $status = isset($_POST['status']) ? 0 : 1;
    
    // Validate address address
    $input_inc_num = trim($_POST["inc_num"]);
    if(empty($input_inc_num)){
        $inc_num_err = "Please enter an Incident Number.";     
    } else{
        $inc_num = $input_inc_num;
    }

    // Validate address address
    $input_priority = trim($_POST["priority"]);
    if(empty($input_priority)){
        $priority_err = "Please enter an Incident Number.";     
    } else{
        $priority = $input_priority;
    }

    // Validate address address
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter a description.";     
    } else{
        $description = $input_description;
    }

    // Validate address address
    $input_assign_group = trim($_POST["assign_group"]);
    if(empty($input_assign_group)){
        $assign_group_err = "Please enter an assignment group.";     
    } else{
        $assign_group = $input_assign_group;
    }
    
    // Validate address address
    $input_kb_article = trim($_POST["kb_article"]);
    if(empty($input_kb_article)){
        $kb_article_err = "Please enter an KB Article.";     
    } else{
        $kb_article = $input_kb_article;
    }

    // Validate address address
    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "Please enter an date.";     
    } else{
        $date = $input_date;
    }

    // Validate address address
    $input_time = trim($_POST["time"]);
    if(empty($input_time)){
        $time_err = "Please enter an time.";     
    } else{
        $time = $input_time;
    }
    
    
    // Check input errors before inserting in database
    if(empty($inc_num_err) && empty($priority_err) && empty($description_err) && empty($assign_group_err)
    && empty($kb_article_err) && empty($date_err) && empty($time_err)){
        // Prepare an update statement
        $sql = "UPDATE incidents SET status=?, inc_num=?, priority=?, description=?, assign_group=?, kb_article=?, date=?, time=? WHERE id=?";
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "isssssssi", $param_status, $param_inc_num, $param_priority, $param_description, $param_assign_group, $param_kb_article, $param_date, $param_time, $param_id);
            
            // Set parameters
            $param_status = $status;
            $param_inc_num = $inc_num;
            $param_priority = $priority;
            $param_description = $description;
            $param_assign_group = $assign_group;
            $param_kb_article = $kb_article;
            $param_date = $date;
            $param_time = $time;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: all-incidents.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($con);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["updateid"]) && !empty(trim($_GET["updateid"]))){
        // Get URL parameter
        $id =  trim($_GET["updateid"]);
        
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
                    $status = $row['status'];
                    $inc_num = $row["inc_num"];
                    $priority = $row["priority"];
                    $description = $row["description"];
                    $assign_group = $row["assign_group"];
                    $kb_article = $row["kb_article"];
                    $date = $row["date"];
                    $time = $row["time"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: die-page.php");
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
        header("location: die-page2.php");
        exit();
    }
}
    


        
// $id = intval($_GET['updateid']);
//     $sql = "SELECT * FROM incidents where id=$id";
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
    <?php if($status == 1) { ?>
        <div class="d-flex justify-content-center">
        <div class="form-group input-group w-25">
            <div class="input-group-prepend">
	            <span class="input-group-text">Status</span>
	        </div>
            <input name="id" class="form-control text-center" placeholder="Incident Number" type="checkbox" checked>
        </div>
    </div> 
    <!-- form-group// -->
    <?php } else { ?>
        <div class="d-flex justify-content-center">
        <div class="form-group input-group w-25">
            <div class="input-group-prepend">
	            <span class="input-group-text">Status</span>
	        </div>
            <input name="id" class="form-control text-center" placeholder="Incident Number" type="checkbox">
        </div>
    </div> 
    <!-- form-group// -->
    <?php } ?>

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
