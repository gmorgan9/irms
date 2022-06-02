<?php
// Include config file
require_once "connection.php";
 
// Define variables and initialize with empty values
$inc_num = $priority = $description = $assign_group = $kb_article = $date = $time = "";
$inc_num_err = $priority_err = $description_err = $assign_group_err = $kb_article_err = $date_err = $time_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["submit"]) && !empty($_POST["inc_id"])){
    // Get hidden input value
    $inc_id = $_POST["inc_id"];
    
    // Validate Incident number
    $input_inc_num = trim($_POST["inc_num"]);
    if(empty($input_inc_num)){
        $inc_num_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_inc_num)){
        $inc_num_err = "Please enter a positive integer value.";
    } else{
        $inc_num = $input_inc_num;
    }

    // Validate priority
    $input_priority = trim($_POST["priority"]);
    if(empty($input_priority)){
        $priority_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_priority)){
        $priority_err = "Please enter a positive integer value.";
    } else{
        $priority = $input_priority;
    }

    // Validate description
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_description)){
        $description_err = "Please enter a positive integer value.";
    } else{
        $description = $input_description;
    }

    // Validate assignment group
    $input_assign_group = trim($_POST["assign_group"]);
    if(empty($input_assign_group)){
        $assign_group_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_assign_group)){
        $assign_group_err = "Please enter a positive integer value.";
    } else{
        $assign_group = $input_assign_group;
    }

    // Validate KB Article
    $input_kb_article = trim($_POST["kb_article"]);
    if(empty($input_kb_article)){
        $kb_article_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_kb_article)){
        $kb_article_err = "Please enter a positive integer value.";
    } else{
        $kb_article = $input_kb_article;
    }

    // Validate Date
    $input_date = trim($_POST["date"]);
    if(empty($input_date)){
        $date_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_date)){
        $date_err = "Please enter a positive integer value.";
    } else{
        $date = $input_date;
    }

    // Validate Time
    $input_time = trim($_POST["time"]);
    if(empty($input_time)){
        $time_err = "Please enter the salary amount.";     
    } elseif(!ctype_digit($input_time)){
        $time_err = "Please enter a positive integer value.";
    } else{
        $time = $input_time;
    }


    
    // Check input errors before inserting in database
    if(empty($inc_num_err) && empty($priority_err) && empty($description_err)
    && empty($assign_group_err) && empty($kb_article_err) && empty($date_err) 
    && empty($time_err)){
        // Prepare an update statement
        $sql = "UPDATE incidents SET inc_num=?, priority=?, description=?, assign_group=?, kb_article=?, date=?, time=? WHERE inc_id=?";
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssssss", $param_inc_num, $param_priority, $param_description, $param_assign_group, $param_kb_article, $param_date, $param_time);
            
            // Set parameters
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
                header("location: /");
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
    if(isset($_GET["inc_id"]) && !empty(trim($_GET["inc_id"]))){
        // Get URL parameter
        $inc_id =  trim($_GET["inc_id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM incidencts WHERE inc_id = ?";
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_inc_id);
            
            // Set parameters
            $param_inc_id = $inc_id;
            
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
                    header("location: error.php");
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
        header("location: error.php");
        exit();
    }

}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the employee record.</p>
                    


                    <?php while ($row = mysqli_fetch_array($results)) { ?>
<div class="d-flex justify-content-center">
    <!-- form start -->
<form action="record-incident.php" class="reg-form" method="post">
<?php include('errors.php'); ?>
<br>
<h2 class="text-center">Record Incident</h2>
<br>

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
            <input name="priority" class="form-control" placeholder="Priority" type="text" value="<?php echo $priority ?>">
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
        <button id="button" type="submit" name="edit-inc" class="btn btn-primary text-center reg-log">Update Incident</button>  
    </div>                                                               
</form>
</div>
<?php } ?>
                    




                </div>
            </div>        
        </div>
    </div>
</body>
</html>
