<?php 
session_start();
//require('connect.php');

// connect to database update
$db = mysqli_connect('localhost', 'root', 'Morgan22!', 'irms');

// variable declaration
$username = "";
$email    = "";
$name = "";
$password    = "";
$errors   = array(); 

// call the register() function if register_btn is clicked
if (isset($_POST['register_btn'])) {
	register();
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
    $name         =  e($_POST['name']);
	$username     =  e($_POST['username']);
	$email        =  e($_POST['email']);
	$password     =  e($_POST['password']);
	$passwordConf =  e($_POST['passwordConf']);

	// form validation: ensure that the form is correctly filled
    if (empty($name)) { 
		array_push($errors, "Name is required"); 
	}
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password != $passwordConf) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password);//encrypt the password before saving in the database

		if (!isset($_POST['user_type'])) {
			$query = "INSERT INTO users (name, username, email, user_type, password) 
					  VALUES('$name','$username', '$email', 'user', '$password')";
            mysqli_query($db, $query);
            $logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: /');
		}else{
			
                      $user_type = e($_POST['user_type']);
                      $query = "INSERT INTO users (name, username, email, user_type, password) 
                                VALUES('$name', '$username', '$email', '$user_type', '$password')";
                      mysqli_query($db, $query);
                      $_SESSION['success']  = "New user successfully created!!";
                      header('location: /');
							
		}
	}
}

// call the register() function if register_btn is clicked
if (isset($_POST['create_user_btn'])) {
	register();
}

// REGISTER USER
function create_user(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database

		if (isset($_POST['user_type'])) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);
			$_SESSION['success']  = "New user successfully created!!";
			header('location: profileinfo.php');
		}else{
			$query = "INSERT INTO users (username, email, user_type, password) 
					  VALUES('$username', '$email', 'user', '$password')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: profileinfo.php');				
		}
	}
}

// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM users WHERE id=" . $id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: /");
}

// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM users WHERE username='$username' AND password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {

				
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: /');		  
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";

				header('location: /');
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}

function isSuperAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'superadmin' ) {
		return true;
	}else{
		return false;
	}
}




// call the register() function if register_btn is clicked
if (isset($_POST['reset_btn'])) {
	resetPass();
}

function resetPass(){
	// call these variables with the global keyword to make them available in function
	global $db, $username, $errors;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$password_1 = e($_POST['password_1']);
	$password_2 = e($_POST['password_2']);

	// form validation: ensure that the form is correctly filled
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}
	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database
		$username = $_SESSION['user']['username'];

			$sql = "UPDATE users SET password = '$password' WHERE username = '$username'";
			mysqli_query($db, $sql);
			$_SESSION['success']  = "Password successfully updated";
			header('location: profileinfo.php');		
		}
	}

	function executeQuery($sql, $data)
{
    global $db;
    $stmt = $db->prepare($sql);
    $values = array_values($data);
    $types = str_repeat('s', count($values));
    $stmt->bind_param($types, ...$values);
    $stmt->execute();
    return $stmt;
}

function dd($value) // to be deleted
{
    echo "<pre>", print_r($value, true), "</pre>";
    die();
}

// SELECT ALL
	function selectAll($table, $conditions = [])
	{
		global $db;
		$sql = "SELECT * FROM $table";
		if (empty($conditions)) {
			$stmt = $db->prepare($sql);
			$stmt->execute();
			$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			return $records;
		} else {
			$i = 0;
			foreach ($conditions as $key => $value) {
				if ($i === 0) {
					$sql = $sql . " WHERE $key=?";
				} else {
					$sql = $sql . " AND $key=?";
				}
				$i++;
			}
			
			$stmt = executeQuery($sql, $conditions);
			$records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
			return $records;
		}
	}
// SELECT ONE
function selectOne($table, $conditions)
{
    global $db;
    $sql = "SELECT * FROM $table";

    $i = 0;
    foreach ($conditions as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " WHERE $key=?";
        } else {
            $sql = $sql . " AND $key=?";
        }
        $i++;
    }

    $sql = $sql . " LIMIT 1";
    $stmt = executeQuery($sql, $conditions);
    $records = $stmt->get_result()->fetch_assoc();
    return $records;
}
// CREATE
function create($table, $data)
{
    global $db;
    $sql = "INSERT INTO $table SET ";

    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }
    
    $stmt = executeQuery($sql, $data);
    $id = $stmt->insert_id;
    return $id;
}

function update($table, $id, $data)
{
    global $db;
    $sql = "UPDATE $table SET ";

    $i = 0;
    foreach ($data as $key => $value) {
        if ($i === 0) {
            $sql = $sql . " $key=?";
        } else {
            $sql = $sql . ", $key=?";
        }
        $i++;
    }

    $sql = $sql . " WHERE id=?";
    $data['id'] = $id;
    $stmt = executeQuery($sql, $data);
    return $stmt->affected_rows;
}

function delete($table, $id)
{
    global $db;
    $sql = "DELETE FROM $table WHERE id=?";

    $stmt = executeQuery($sql, ['id' => $id]);
    return $stmt->affected_rows;
}

function getPublishedPosts()
{
    global $db;
    $sql = "SELECT p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=?";

    $stmt = executeQuery($sql, ['published' => 1]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function getPostsByTopicId($topic_id)
{
    global $db;
    $sql = "SELECT p.*, u.username FROM posts AS p JOIN users AS u ON p.user_id=u.id WHERE p.published=? AND topic_id=?";

    $stmt = executeQuery($sql, ['published' => 1, 'topic_id' => $topic_id]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}

function searchPosts($term)
{
    $match = '%' . $term . '%';
    global $conn;
    $sql = "SELECT 
                p.*, u.username 
            FROM posts AS p 
            JOIN users AS u 
            ON p.user_id=u.id 
            WHERE p.published=?
            AND p.title LIKE ? OR p.body LIKE ?";


    $stmt = executeQuery($sql, ['published' => 1, 'title' => $match, 'body' => $match]);
    $records = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    return $records;
}