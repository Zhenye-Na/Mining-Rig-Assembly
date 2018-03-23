<?php
session_start(); //starts the session
if($_SESSION['username']){ //checks if user is logged in
}
else{
	header("location:login.php");
	exit();// redirects if user is not logged in
}
$username = $_SESSION['username']; //assigns user value
?>