
<?php
    require('db.php');
	session_start();
	$mb = $mysqli->real_escape_string($_POST['mb']);
	$cpu = $mysqli->real_escape_string($_POST['cpu']);
	$gpu = $mysqli->real_escape_string($_POST['gpu']);
	$ram = $mysqli->real_escape_string($_POST['ram']);
	$psu = $mysqli->real_escape_string($_POST['psu']);

	$result = $mysqli->query("INSERT INTO includes(mb_name, cpu_name, gpu_name, ram_name, psu_name) VALUES ('$mb','$cpu','$gpu','$ram','$psu')");
	
	$email = $_SESSION['username']; //email
	$id =  $mysqli->insert_id; //setID
	
	
	$result = $mysqli->query("INSERT INTO creates(email,setID) VALUES ('$email','$id')");
	
	Print '<script>alert("setup created!");</script>'; //Prompts the user
	Print '<script>window.location.assign("home.php");</script>'; // redirects the user to the authenticated home page
?>