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
require('db.php');
$setid = $_SESSION['setid'];
if($result = $mysqli->query("SELECT * FROM includes WHERE setID = $setid")){
	$setup = $result->fetch_row();
	if(!$setup['cpu_name']){
		$query = "SELECT * FROM components where name IN (SELECT name 
                                       FROM cpu);";
		$result = $mysqli->query($query) or die($mysqli->error);?>
<div class = "container bg-info well well-lg">
	<h2>CPU</h2>
    <div class="row text-center" style="display:flex; flex-wrap: wrap;">
    	<?php while($row = $result->fetch_assoc()) { ?>
        <div class = "col-md-3 col-lg-2 col-sm-6">
            <div class = "thumbnail" >
                <?php echo '<img src='.$row['image_url'].'>'; ?>
                <div class = "caption text-center">
                    <h4><?php echo $row['name']; ?></h4>
                </div>
                <p>
                    <a href="" class = "btn btn-success">Add</a>
                </p>
            </div>
        </div>
        <?php } ?>
     </div>
</div>
		<?php
	}
	if($setup['gpu_name']==NULL){
		$query = "SELECT * FROM components where name IN (SELECT name 
                                       FROM gpu);";
		$result = $mysqli->query($query) or die($mysqli->error);?>
<div class = "container bg-info well well-lg">
	<h2>GPU</h2>
    <div class="row text-center" style="display:flex; flex-wrap: wrap;">
    	<?php while($row = $result->fetch_assoc()) { ?>
        <div class = "col-md-3 col-lg-2 col-sm-6">
            <div class = "thumbnail" >
                <?php echo '<img src='.$row['image_url'].'>'; ?>
                <div class = "caption text-center">
                    <h4><?php echo $row['name']; ?></h4>
                </div>
                <p>
                    <a href="" class = "btn btn-success">Add</a>
                </p>
            </div>
        </div>
        <?php } ?>
     </div>
</div>
		<?php
	}
	if($setup['mb_name']==NULL){
		$query = "SELECT * FROM components where name IN (SELECT name 
                                       FROM mb);";
		$result = $mysqli->query($query) or die($mysqli->error);?>
<div class = "container bg-info well well-lg">
	<h2>Mother Board</h2>
    <div class="row text-center" style="display:flex; flex-wrap: wrap;">
    	<?php while($row = $result->fetch_assoc()) { ?>
        <div class = "col-md-3 col-lg-2 col-sm-6">
            <div class = "thumbnail" >
                <?php echo '<img src='.$row['image_url'].'>'; ?>
                <div class = "caption text-center">
                    <h4><?php echo $row['name']; ?></h4>
                </div>
                <p>
                    <a href="" class = "btn btn-success">Add</a>
                </p>
            </div>
        </div>
        <?php } ?>
     </div>
</div>
		<?php
	}
	if($setup['psu_name']==NULL){
		$query = "SELECT * FROM components where name IN (SELECT name 
                                       FROM psu);";
		$result = $mysqli->query($query) or die($mysqli->error);?>
<div class = "container bg-info well well-lg">
	<h2>Power Supply</h2>
    <div class="row text-center" style="display:flex; flex-wrap: wrap;">
    	<?php while($row = $result->fetch_assoc()) { ?>
        <div class = "col-md-3 col-lg-2 col-sm-6">
            <div class = "thumbnail" >
                <?php echo '<img src='.$row['image_url'].'>'; ?>
                <div class = "caption text-center">
                    <h4><?php echo $row['name']; ?></h4>
                </div>
                <p>
                    <a href="" class = "btn btn-success">Add</a>
                </p>
            </div>
        </div>
        <?php } ?>
     </div>
</div>
		<?php
	}
	if($setup['ram_name']==NULL){
		$query = "SELECT * FROM components where name IN (SELECT name 
                                       FROM ram);";
		$result = $mysqli->query($query) or die($mysqli->error);?>
<div class = "container bg-info well well-lg">
	<h2>RAM</h2>
    <div class="row text-center" style="display:flex; flex-wrap: wrap;">
    	<?php while($row = $result->fetch_assoc()) { ?>
        <div class = "col-md-3 col-lg-2 col-sm-6">
            <div class = "thumbnail" >
                <?php echo '<img src='.$row['image_url'].'>'; ?>
                <div class = "caption text-center">
                    <h4><?php echo $row['name']; ?></h4>
                </div>
                <p>
                    <a href="" class = "btn btn-success">Add</a>
                </p>
            </div>
        </div>
        <?php } ?>
     </div>
</div>
		<?php
	}
}
?>
