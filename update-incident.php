<?php
session_start();
    include("database/connection.php");

//     $id = intval($_GET['updateid']);
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
    
    // if (isset($_POST['update'])) {
    //     $inc_num = $_POST['inc_num'];
    //     $priority = $_POST['priority'];
    //     $description = $_POST['description'];
    //     $assign_group = $_POST['assign_group'];
    //     $kb_article = $_POST['kb_article'];
    //     $date = $_POST['date'];
    //     $time = $_POST['time'];

    //     $new = intval($id);
    //     $sql = "UPDATE incidents SET inc_num='$inc_num' WHERE id=$new";

           // check if form was submitted
           if (isset($_POST['update'])) {
            // receive all input values from the form
            $name = mysqli_real_escape_string($con, $_POST['name']);
            $username = mysqli_real_escape_string($con, $_POST['username']);
            $email = mysqli_real_escape_string($con, $_POST['email']);
            $password = mysqli_real_escape_string($con, $_POST['password']);
            $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
          
            // form validation: ensure that the form is correctly filled ...
            // by adding (array_push()) corresponding error unto $errors array
            if (empty($name)) { array_push($errors, "Name is required"); }
            if (empty($username)) { array_push($errors, "Username is required"); }
            if (empty($email)) { array_push($errors, "Email is required"); }
            if (empty($password)) { array_push($errors, "Password is required"); }
            if ($password != $confirm_password) {
              array_push($errors, "The two passwords do not match");
            }
          
            // first check the database to make sure 
            // a user does not already exist with the same username and/or email
            $incident_check_query = "SELECT * FROM incidents WHERE inc_num='$inc_num' LIMIT 1";
            $result = mysqli_query($con, $incident_check_query);
            $incident = mysqli_fetch_assoc($result);
            
            if ($incident) { // if user exists
              if ($incident['inc_num'] === $inc_num) {
                array_push($errors, "Incident already exists");
              }
            }
          
            // Finally, register user if there are no errors in the form
            if (count($errors) == 0) {
                //$password = md5($password);//encrypt the password before saving in the database
          
                $query = "UPDATE incidents SET inc_num='$inc_num' WHERE id=$id";
                mysqli_query($con, $query);
              //$_SESSION['name'] = $name;
                //$_SESSION['username'] = $username;
                $_SESSION['success'] = "Record was updated.";
                header('location: all-incidents.php');
            }
          }
        //         // header('location: all-incidents.php');
        //         echo "<div class='alert alert-success'>Record was updated.</div>";
        //     } else {
        //         echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>";
        //         }
        //     }
        // }

        // //Update Statement
        // $sql = "UPDATE incidents SET inc_num='$inc_num',priority='$priority',description='$description',assign_group='$assign_group',kb_article='$kb_article',date='$date',time='$time' WHERE id='$id'";
        // $result=mysqli_query($con,$sql);
        // if($row = mysqli_fetch_assoc($result)) {
        //             echo "inc_num: " . $row["inc_num"];
        //     } else {
        //         echo "No record exists";
        //     }
        // }


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




// $inc_num = $priority = $description = $assign_group = $kb_article = $date = $time = "";
// $inc_num_err = $priority_err = $description_err = $assign_group_err = $kb_article_err = $date_err = $time_err = "";

        


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
