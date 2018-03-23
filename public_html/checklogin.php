
<?php
    require('db.php');
	session_start();
	$email = $mysqli->real_escape_string($_POST['email']);
	$password = $mysqli->real_escape_string($_POST['password']);

	//mysql_connect("localhost", "rigassembly_admin","jiajunc2") or die(mysql_error()); //Connect to server
	//mysql_select_db("rigassembly_main") or die("Cannot connect to database"); //Connect to database
	$result = $mysqli->query("SELECT * from `account` WHERE email='$email' and password='$password'");
	//Query the users table if there are matching rows equal to $username
	$exists = $result->num_rows; //Checks if username exists
	
	if($exists == 1) //IF there are no returning rows or no existing username
	{
		
		$_SESSION['username'] = $email; //set the username in a session. This serves as a global variable
		Print '<script>window.location.assign("home.php");</script>'; // redirects the user to the authenticated home page
	}
	else
	{
		Print '<script>alert("Incorrect password/username!");</script>'; //Prompts the user
		Print '<script>window.location.assign("login.php");</script>'; // redirects to login.php
	}
?>