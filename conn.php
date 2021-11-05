<?php
require_once("data/login.php");
//Create the connection
$con = mysqli_connect($host, $username, $password, $database);
//Fixes the problem displaying special characters
mysqli_set_charset($con, 'utf8');
//Check the connection
if (!$con) {
	die("Connection failed: " . mysqli_connect_error());
}
?>