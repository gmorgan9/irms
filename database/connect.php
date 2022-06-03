<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "Morgan22!";
$dbname = "irms";

if(!$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("Failed to connect!");
}
