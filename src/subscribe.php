<?php
require("db.php");
session_start(); //starts the session
if($_SESSION['username']){ //checks if user is logged in
}
else{
	header("location:login.php"); // redirects if user is not logged in
}
include('header.php');
?>
<?php

$setid = $mysqli->real_escape_string($_POST['setID']);
$query = "UPDATE includes SET subscript = 1 WHERE setID = $setid;";
$result = $mysqli->query($query) or die($mysqli->error);
if(result){
    echo "<div class = 'container' ><h4>You have successfully subsribed!</h4></div>";
}
?>
<?php
include('footer');
?>