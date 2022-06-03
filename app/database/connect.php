<?php

$host = 'localhost';
$user = 'gmorg';
$pass = 'gmorgpass';
$db_name = 'recipes';

$conn = new MySQLi($host, $user, $pass, $db_name);

if ($conn->connect_error) {
    die('Database connection error: ' . $conn->connect_error);
}