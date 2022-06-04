<?php
session_start();
    include("database/connection.php");
    //include("database/functions.php");


   // Define variables and initialize with empty values
   $date = $title = $note = $tag = "";
   $date_err = $title_err = $note_err = $tag_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["up-note"])){
    // Get hidden input value
    $id = $_POST["id"];
    //$status = isset($_POST['status']) ? 1 : 0;
    
    // Validate date address
    // $input_date = trim($_POST["date"]);
    // if(empty($input_date)){
    //     $date_err = "Please enter a Date.";     
    // } else{
    //     $date = $input_date;
    // }

    // Validate title address
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        $title_err = "Please enter an Incident Number.";     
    } else{
        $title = $input_title;
    }

    // Validate address address
    // $input_note = trim($_POST["note"]);
    // if(empty($input_note)){
    //     $note_err = "Please enter a description.";     
    // } else{
    //     $note = $input_note;
    // }

    // Validate address address
    // $input_tag = trim($_POST["tag"]);
    // if(empty($input_tag)){
    //     $tag_err = "Please enter an assignment group.";     
    // } else{
    //     $tag = $input_tag;
    // }
    
    // Check input errors before inserting in database
    if(empty($title_err)){
        // Prepare an update statement
        $sql = "UPDATE notes SET title=? WHERE id=?";
         
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", 
           # $param_date, 
            $param_title, 
           # $param_note, 
           # $param_tag, 
            $param_id);
            
            // Set parameters
            // $param_date = $date;
            $param_title = $title;
            // $param_note = $note;
            // $param_tag = $tag;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: incident-notes.php");
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
    if(isset($_GET["note-id"]) && !empty(trim($_GET["note-id"]))){
        // Get URL parameter
        $id =  trim($_GET["note-id"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM notes WHERE id = ?";
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
                    // $date = $row['date'];
                    $title = $row["title"];
                    // $note = $row["note"];
                    // $tag = $row["tag"];
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
    <link rel="stylesheet" href="assets/css/style.css?v=2.21">

    <!-- Bootstrap Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- CKEDITOR -->
    <script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
    <script src="ckeditor/ckeditor.js"></script>

    <title>Update Note - IRMS</title>
</head>
<body>
    <div class="header">
        <h2 class="logo">
            Incident Record Management System
            <a href="/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a>
        </h2>
    </div>


<br>
<div class="record_incident">
    <a href="javascript:history.back()"><button class="btn btn-primary rec">Back</button></a>
</div>
<br>

<div class="d-flex justify-content-center">

    <!-- form start -->
    <form action="update-note.php" class="note-form" method="post">
<?php //include('errors.php'); ?>
<br>
<h2 class="text-center">Update Note</h2>
<br>

    <div class="d-flex justify-content-center">
    <div class="form-row">
        <div class="form-group input-group">
            <div class="input-group-prepend">
	            <span class="input-group-text"> <i class="fa-solid fa-hashtag"></i> </span>
	        </div>
                <input name="date" class="form-control" placeholder="Date" type="date" value="<?php echo $date ?>">
            </div>
        </div>
    <!-- form-group// -->
        <div class="p-3"></div>
        <div class="d-flex justify-content-center">
            <div class="form-group input-group">
    	        <div class="input-group-prepend">
		            <span class="input-group-text"> <i class="fa-solid fa-arrow-up-wide-short"></i> </span>
		        </div>
            <input name="title" class="form-control" placeholder="Title" type="text" value="<?php echo $title ?>">
        </div>
        </div> 
    <!-- form-group// -->
    </div>
    <!-- end row // -->
    <div class="form-row">
        <div class="mx-auto" style="width: -1100px;">
            <div class="form-group input-group">
    	        <div class="input-group-prepend">
		            <span class="input-group-text"> <i class="fa fa-users fa-xs"></i> </span>
		        </div>
                <input name="tag" class="form-control" placeholder="Tag" type="text" value="<?php echo $tag ?>">
            </div>
        </div> 
        <!-- form-group// -->
    </div>
    <!-- end row // -->

    <div class="form-row">
    <div class="mx-auto" style="width: -1100px;">
            <div class="form-group input-group">
    	        <div class="input-group-prepend">
		            <span class="input-group-text"> <i class="fa-solid fa-pen-to-square"></i> </span>
                    <textarea name="note" class="form-control" placeholder="Note" type="text"><?php echo $note ?></textarea>
                    </div>
            </div>
        </div> 
        <!-- form-group// -->
    </div>
    <!-- end row // --> 
    <div class="d-flex justify-content-center">                                
        <button id="button" type="submit" name="up-note" class="btn btn-primary text-center reg-log">Update Incident</button>  
    </div>                                                               
</form>
</div>

<script>
    // Replace the <textarea id="editor1"> with a CKEditor 4
    // instance, using default configuration.
    CKEDITOR.replace( 'note' );
</script>


</body>
</html>
