<?php

$host = 'localhost';
$user = 'root';
$pass = 'Morgan22!';
$db_name = 'irms';

$conn = new MySQLi($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die('Database connection error: ' . $conn->connect_error);
} else {
  echo "success";
}