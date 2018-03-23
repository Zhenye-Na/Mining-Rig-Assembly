<?php
include('header.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<style>
img {
    float: left;
}
</style>



<?php
require("db.php");
$name = $mysqli->real_escape_string($_POST['name']);

$query = "SELECT *
          FROM components
          WHERE name = '$name';";
$result = $mysqli->query($query) or die($mysqli->error);
?>



<div class = "container bg-info well well-lg">
	<h2>Information</h2>
	<p>Detailed information about this component.</p>
    <div class="col" style="display: flex; flex-wrap: wrap;">
    	<?php while($row = $result->fetch_assoc()) { ?>
        
        <div class = "img-rounded" alt= \"echo $row['name']\" >
            <?php echo '<img src='.$row['image_url'].'>'; ?>
        </div>
        
    <div class = "infoname">
        <p class="text-right"><?php echo 'Name: ', $row['name']; ?></p>
        <p class="text-right"><?php echo 'Price: ', $row['price']; ?></p>
        <p class="text-right"><?php echo 'Manufacturer: ', $row['manufacturer']; ?></p>
        <p class="text-right"><?php echo 'Description: ', $row['description']; ?></p>
    </div>
    </div>
    <div class = "text-center">
        <p>
            <?php echo "<a href= ".$row['amazon_url']." class = \"btn btn-success\">More information here!</a>"; ?>
        </p>
    </div>
        <?php } ?>
</div>
