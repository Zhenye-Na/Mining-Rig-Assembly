<?php
include('header.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>


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
    <div class="row text-center" style="display: flex; flex-wrap: wrap;">
    	<?php while($row = $result->fetch_assoc()) { ?>
        <div class = "col-xs-1 col-md-1 col-lg-1 col-sm-1">
            <div class = "thumbnail" >
                <?php echo '<img src='.$row['image_url'].'>'; ?>
                <div class = "caption text-center">
                    <h4><?php echo $row['name']; ?></h4>
                    <h4><?php echo $row['price']; ?></h4>
                    <h4><?php echo $row['manufacturer']; ?></h4>
                    <h4><?php echo $row['description']; ?></h4>
                    
                </div>
                <p>
                    <?php echo "<a href= ".$row['amazon_url']." class = \"btn btn-success\">More information here!</a>"; ?>
                </p>
            </div>
        </div>
        <?php } ?>
     </div>
</div>