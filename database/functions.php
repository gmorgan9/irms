<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// connect to the database
require_once('connection.php');

// REGISTER USER
if (isset($_POST['reg_user'])) {
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
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($con, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (name, username, email, password) 
  			  VALUES('$name', '$username', '$email', '$password')";
  	mysqli_query($con, $query);
    $_SESSION['name'] = $name;
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: /');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($con, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['name'] = $name;
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          header('location: /');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }

// RECORD AN INCIDENT
if (isset($_POST['rec_inc'])) {
    // receive all input values from the form
    $inc_num = mysqli_real_escape_string($con, $_POST['inc_num']);
    $priority = mysqli_real_escape_string($con, $_POST['priority']);
    $description = mysqli_real_escape_string($con, $_POST['description']);
    $assign_group = mysqli_real_escape_string($con, $_POST['assign_group']);
    $kb_article = mysqli_real_escape_string($con, $_POST['kb_article']);
    $date = mysqli_real_escape_string($con, $_POST['date']);
    $time = mysqli_real_escape_string($con, $_POST['time']);
  
    // form validation: ensure that the form is correctly filled ...
    // by adding (array_push()) corresponding error unto $errors array
    if (empty($inc_num)) { array_push($errors, "Incident Number is required"); }
    if (empty($priority)) { array_push($errors, "Priority is required"); }
    if (empty($description)) { array_push($errors, "Description is required"); }
    if (empty($assign_group)) { array_push($errors, "Assignment Group is required"); }
    if (empty($kb_article)) { array_push($errors, "KB Artcile is required"); }
    if (empty($date)) { array_push($errors, "Date is required"); }
    if (empty($time)) { array_push($errors, "Time is required"); }
    
  
    // first check the database to make sure 
    // a incident does not already exist with the same incident number
    $user_check_query = "SELECT * FROM incidents WHERE inc_num='$inc_num' LIMIT 1";
    $result = mysqli_query($con, $user_check_query);
    $inc = mysqli_fetch_assoc($result);
    
    if ($inc) { // if incident exists
      if ($inc['inc_num'] === $inc_num) {
        array_push($errors, "Incident Number already exists");
      }
    }
  
    // Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
  
        $query = "INSERT INTO incidents (inc_num, priority, description, assign_group, kb_article, date, time) 
                  VALUES('$inc_num', '$priority', '$description', '$assign_group', '$kb_article', '$date', '$time')";
        mysqli_query($con, $query);
        header('location: /');
    }
  }

  // REGISTER USER
if (isset($_POST['rec_note'])) {
  // receive all input values from the form
  $date = mysqli_real_escape_string($con, $_POST['date']);
  $title = mysqli_real_escape_string($con, $_POST['title']);
  $note = mysqli_real_escape_string($con, $_POST['note']);
  $tag = mysqli_real_escape_string($con, $_POST['tag']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($date)) { array_push($errors, "date is required"); }
  if (empty($title)) { array_push($errors, "title is required"); }
  if (empty($note)) { array_push($errors, "note is required"); }
  if (empty($tag)) { array_push($errors, "tag is required"); }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $note_check_query = "SELECT * FROM notes WHERE title='$title' LIMIT 1";
  $result = mysqli_query($con, $note_check_query);
  $inc_note = mysqli_fetch_assoc($result);
  
  if ($inc_note) { // if user exists
    if ($note['title'] === $title) {
      array_push($errors, "Username already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	//$password = md5($password);//encrypt the password before saving in the database

  	$query = "INSERT INTO notes (date, title, note, tag) 
  			  VALUES('$date', '$title', '$note', '$tag')";
  	mysqli_query($con, $query);
  	$_SESSION['success'] = "Note Successfully Created!";
  	header('location: incident-notes.php');
  }
}

  



// RETURNS ALL INCIDENTS
  function getAllInc()
{
	global $con;
	$sql = "SELECT * FROM incidents";
	$result = mysqli_query($con, $sql);
	$all_incidents = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $all_incidents;
}
// RETURNS CLOSED INCIDENTS
function getClosedInc()
{
	global $con;
	$sql = "SELECT * FROM incidents where status=1";
	$result = mysqli_query($con, $sql);
	$closed_incidents = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $closed_incidents;
}
// RETURNS OPEN INCIDENTS
function getOpenInc()
{
	global $con;
	$sql = "SELECT * FROM incidents where status=0";
	$result = mysqli_query($con, $sql);
	$open_incidents = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $open_incidents;
}
// COUNT OPEN INCIDENTS
function countOpenInc()
{
    global $con;
    $sql="select count('1') from incidents";
    $result=mysqli_query($con,$sql);
    $rowtotal=mysqli_fetch_array($result); 
    return $rowtotal; 
}