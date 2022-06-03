<?php
session_start();
    include("database/connection.php");
    include("database/functions.php");
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
    <link rel="stylesheet" href="assets/css/style.css?v=2.17">

    <!-- Bootstrap Styles -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- CKEDITOR -->
    <script src="//cdn.ckeditor.com/4.19.0/standard/ckeditor.js"></script>
    <script src="ckeditor/ckeditor.js"></script>

    <title>Record Note - IRMS</title>
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
<form action="record-incident.php" class="note-form" method="post">
<?php include('errors.php'); ?>
<br>
<h2 class="text-center">Record Note</h2>
<br>

    <div class="d-flex justify-content-center">
    <div class="form-row">
        <div class="form-group input-group">
            <div class="input-group-prepend">
	            <span class="input-group-text"> <i class="fa-solid fa-hashtag"></i> </span>
	        </div>
                <input name="date" class="form-control" placeholder="Date" type="date">
            </div>
        </div>
    <!-- form-group// -->
        <div class="p-3"></div>
        <div class="d-flex justify-content-center">
            <div class="form-group input-group">
    	        <div class="input-group-prepend">
		            <span class="input-group-text"> <i class="fa-solid fa-arrow-up-wide-short"></i> </span>
		        </div>
            <input name="title" class="form-control" placeholder="Title" type="text">
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
                <input name="tag" class="form-control" placeholder="Tag" type="text">
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
                    <input name="note" class="form-control" placeholder="Note" type="text">
                    </div>
            </div>
        </div> 
        <!-- form-group// -->
    </div>
    <!-- end row // -->
    <div class="d-flex justify-content-center">                                
        <button id="button" type="submit" name="rec_note" class="btn btn-primary text-center reg-log">Submit Note</button>  
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