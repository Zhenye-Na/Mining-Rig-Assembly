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
<?php
include('header.php');
?>

<div class = "container bg-info well well-lg">
	<h2>Edit your setup:</h2>
    <div class="row text-center" style="display:flex; flex-wrap: wrap;">

		<?php
		require('db.php');
		$num_components = 0;
		if(1){
			
			if($_GET['setid']){
				$setid = $_GET['setid'];
				$_SESSION['setid'] = $setid;
				$setid = $mysqli->real_escape_string($setid);
				if($result = $mysqli->query("SELECT * FROM includes WHERE setID = $setid")){
					$row = $result->fetch_array();
					if($c_name = $row['cpu_name']){ 
						$num_components += 1;?>
		<div class = "col-md-3 col-lg-2 col-sm-6">
            <div class = "thumbnail" >
            	<?php 
            	$item = $mysqli->query("SELECT * FROM components WHERE name = '$c_name'");
            	$item = $item->fetch_array();
            	echo '<img src='.$item['image_url'].'>'; ?>
            	<div class = "caption text-center">
            		<h4><?php echo $item['name']; ?></h4>
                </div>
                <p>
                    <a href="" class = "btn btn-danger">Delete</a>
                </p>
            </div>
        </div>
					<?php
					}
					if($c_name = $row['gpu_name']){ 
						$num_components += 1;?>
		<div class = "col-md-3 col-lg-2 col-sm-6">
            <div class = "thumbnail" >
            	<?php 
            	$item = $mysqli->query("SELECT * FROM components WHERE name = '$c_name'");
            	$item = $item->fetch_array();
            	echo '<img src='.$item['image_url'].'>'; ?>
            	<div class = "caption text-center">
            		<h4><?php echo $item['name']; ?></h4>
                </div>
                <p>
                    <a href="" class = "btn btn-danger">Delete</a>
                </p>
            </div>
        </div>                
					<?php
					}
					if($c_name = $row['mb_name']){ 
						$num_components += 1;?>
		<div class = "col-md-3 col-lg-2 col-sm-6">
            <div class = "thumbnail" >
            	<?php 
            	$item = $mysqli->query("SELECT * FROM components WHERE name = '$c_name'");
            	$item = $item->fetch_array();
            	echo '<img src='.$item['image_url'].'>'; ?>
            	<div class = "caption text-center">
            		<h4><?php echo $item['name']; ?></h4>
                </div>
                <p>
                    <a href="" class = "btn btn-danger">Delete</a>
                </p>
            </div>
        </div>                
					<?php
					}
					if($c_name = $row['psu_name']){ 
						$num_components += 1;?>
		<div class = "col-md-3 col-lg-2 col-sm-6">
            <div class = "thumbnail" >
            	<?php 
            	$item = $mysqli->query("SELECT * FROM components WHERE name = '$c_name'");
            	$item = $item->fetch_array();
            	echo '<img src='.$item['image_url'].'>'; ?>
            	<div class = "caption text-center">
            		<h4><?php echo $item['name']; ?></h4>
                </div>
                <p>
                    <a href="" class = "btn btn-danger">Delete</a>
                </p>
            </div>
        </div>                
					<?php
					}
					if($c_name = $row['ram_name']){ 
						$num_components += 1;?>
		<div class = "col-md-3 col-lg-2 col-sm-6">
            <div class = "thumbnail" >
            	<?php 
            	$item = $mysqli->query("SELECT * FROM components WHERE name = '$c_name'");
            	$item = $item->fetch_array();
            	echo '<img src='.$item['image_url'].'>'; ?>
            	<div class = "caption text-center">
            		<h4><?php echo $item['name']; ?></h4>
                </div>
                <p>
                    <a href="" class = "btn btn-danger">Delete</a>
                </p>
            </div>
        </div>                
					<?php
					}


				}
			}
		}
		if($num_components < 5){ ?>
		<div class = "col-md-3 col-lg-2 col-sm-6">
            <div class = "thumbnail" >
            	<img src="ic_add_circle_outline_black_48dp_2x.png">
            	<div class = "caption text-center">
            		<h4>Add new component</h4>
                </div>
            	<p>
                    <a href="add_component.php" class = "btn btn-success">Add</a>
                </p>
            </div>
        </div>
			<?php

		}
		

		?>
     </div>
</div>