<?php
include('header.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<script>
function myFunction2(value) {
    method = "post";

    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", "info.php");
    form.setAttribute("target", "_blank");

    var name = document.createElement("input");
    name.setAttribute("type", "hidden");
    name.setAttribute("name", "name");
    name.setAttribute("value", value);
    form.appendChild(name);
    
    document.body.appendChild(form);
    form.submit();
}
</script>


<?php
require("db.php");
$query = "SELECT * FROM components where name IN (SELECT name 
                                       FROM mb);";
$result = $mysqli->query($query) or die($mysqli->error);
?>


<div class = "container bg-info well well-lg">
	<h2>MotherBoard</h2>
    <div class="row text-center" style="display:flex; flex-wrap: wrap;">
    	<?php while($row = $result->fetch_assoc()) { ?>
        <div class = "col-md-3 col-lg-2 col-sm-6">
            <div class = "thumbnail" >
                <?php echo '<img src='.$row['image_url'].'>'; ?>
                <div class = "caption text-center">
                    <h4><?php echo $row['name']; ?></h4>
                </div>
                <p>
                    <?php echo "<a class = \"btn btn-info\" onclick=\"myFunction2('".$row['name']."')\">Info</a>"; ?>
                </p>
            </div>
        </div>
        <?php } ?>
     </div>
</div>

<?php
$query = "SELECT * FROM components where name IN (SELECT name 
                                       FROM cpu);";
$result = $mysqli->query($query) or die($mysqli->error);
?>

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
                    <?php echo "<a class = \"btn btn-info\" onclick=\"myFunction2('".$row['name']."')\">Info</a>"; ?>
                </p>
            </div>
        </div>
        <?php } ?>
     </div>
</div>

<?php
$query = "SELECT * FROM components where name IN (SELECT name 
                                       FROM gpu);";
$result = $mysqli->query($query) or die($mysqli->error);
?>

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
                    <?php echo "<a class = \"btn btn-info\" onclick=\"myFunction2('".$row['name']."')\">Info</a>"; ?>
                </p>
            </div>
        </div>
        <?php } ?>
     </div>
</div>

<?php
$query = "SELECT * FROM components where name IN (SELECT name 
                                       FROM ram);";
$result = $mysqli->query($query) or die($mysqli->error);
?>

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
                    <?php echo "<a class = \"btn btn-info\" onclick=\"myFunction2('".$row['name']."')\">Info</a>"; ?>
                </p>
            </div>
        </div>
        <?php } ?>
     </div>
</div>

<?php
$query = "SELECT * FROM components where name IN (SELECT name 
                                       FROM psu);";
$result = $mysqli->query($query) or die($mysqli->error);
?>

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
                    <?php echo "<a class = \"btn btn-info\" onclick=\"myFunction2('".$row['name']."')\">Info</a>"; ?>
                </p>
            </div>
        </div>
        <?php } ?>
     </div>
</div>

<?php
include('footer.php');
?>
