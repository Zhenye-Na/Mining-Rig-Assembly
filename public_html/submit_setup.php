
<?php
    require('db.php');
	session_start();
	$mb = $mysqli->real_escape_string($_POST['mb']);
	$cpu = $mysqli->real_escape_string($_POST['cpu']);
	$gpu = $mysqli->real_escape_string($_POST['gpu']);
	$ram = $mysqli->real_escape_string($_POST['ram']);
	$psu = $mysqli->real_escape_string($_POST['psu']);
	$setid = $mysqli->real_escape_string($_POST['setID']);
    
    if($setid > 0){
        $result = $mysqli->query("UPDATE includes SET mb_name = '$mb', cpu_name='$cpu', gpu_name='$gpu', ram_name='$ram', psu_name='$psu' WHERE setID = $setid");
        Print '<script>alert("setup modified!");</script>';

    }else{
    	$result = $mysqli->query("INSERT INTO includes(mb_name, cpu_name, gpu_name, ram_name, psu_name) VALUES ('$mb','$cpu','$gpu','$ram','$psu')");
    	$email = $_SESSION['username']; //email
    	$id =  $mysqli->insert_id; //setID
    	$result = $mysqli->query("INSERT INTO creates(email,setID) VALUES ('$email','$id')");
        
    	Print '<script>alert("setup created!");</script>'; //Prompts the user
    }
	Print '<script>window.location.assign("home.php");</script>'; // redirects the user to the authenticated home page
?>