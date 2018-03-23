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
// session_start(); //starts the session
if($_SESSION['username']){ //checks if user is logged in
}
else{
	header("location:login.php"); // redirects if user is not logged in
}
$username = $_SESSION['username']; //assigns user value
?>



<?php
require("db.php");
$name = $mysqli->real_escape_string($_POST['name']);

$query = "SELECT *
          FROM components
          WHERE name = '$name';";
$result = $mysqli->query($query) or die($mysqli->error);
?>



<script>
    function myFunction2(value) {
    method = "post";

    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", "add_setup.php");

    var name = document.createElement("input");
    name.setAttribute("type", "hidden");
    name.setAttribute("name", "setID");
    name.setAttribute("value", value);
    form.appendChild(name);
    
    document.body.appendChild(form);
    form.submit();
}
</script>



<div class = "container bg-info well well-lg">
	<!--<h2>Information</h2>-->
	<!--<p>Detailed information about this component.</p>-->
    <div class="container" style="display: flex; flex-wrap: wrap;">
    	<?php while($row = $result->fetch_assoc()) { ?>
        
        <div class = "img-rounded" >
            <?php echo '<img src='.$row['image_url'].'>'; ?>
            
                <table class="detail">
                    <tr>
                        <!--<td> <strong> Component: </strong></td>-->
                        <td colspan="2" > <p><strong><font size="5" > <?php echo $row['name'] ?> </font></strong></p> </td>
                    </tr>
                    <tr>
                        <td> <strong>Price: </strong></td>
                        <td> <?php echo '$ ', $row['price'] ?> </td>
                    </tr>
                    <tr>
                        <td> <strong>Manufacturer: </strong></td>
                        <td> <?php echo $row['manufacturer'] ?> </td>
                    </tr>
                    <tr>
                        <td> <strong>Description: </strong></td>
                        <td> <?php echo $row['description'] ?> </td>
                    </tr>
                </table>
            
            
            
        </div>
    </div>


    <table class="button">
        <tr>
            <td>
                <div class = "text-center" >
                    <?php echo "<a href= ".$row['amazon_url']." class = \"btn btn-success\">More information on Amazon !</a>"; ?>
                </div>
        <?php } ?>
            </td>
        	
	    </tr>
    </table>
    

</div>


<div class = "container bg-info well well-lg">
	<p><strong><font size="4" face="verdana" color=FF5733> Customers who bought this item also bought </font></strong></p>
	


</div>

<?php
require("db.php");
$name = $mysqli->real_escape_string($_POST['name']);

$query = "SELECT *
          FROM components
          WHERE name = '$name';";
$item = $mysqli->query($query) or die($mysqli->error);
?>



<div class = "container bg-info well well-lg">
	<p><strong><font size="4" face="verdana" color=FF5733> Compare with similar items </font></strong></p>
	
    <table class="similar">
        <tr>
            <td> 
                <p><strong><font size="5" >  </font></strong></p>
            </td>
            
            <?php $row = $item->fetch_assoc() ?>
            <td > 
            <div class = "thumbnail">
                <?php echo "<img src='" . $row['image_url'] . "' height='130' width='150'> "; ?>
                
            </div>
                <p> <?php echo $row['name'] ?> </p>
            </td>
            
            <?php $row = $item->fetch_assoc() ?>
            <td> 
                <p><strong> <?php echo $row['name'] ?> </font></strong></p> 
            </td>
            
            <?php while($row = $result->fetch_assoc()) { ?>
            <td> 
                <p><strong> <?php echo $row['name'] ?> </font></strong></p> 
            </td>
            <?php } ?>
            
            <?php while($row = $result->fetch_assoc()) { ?>
            <td> 
                <p><strong> <?php echo $row['name'] ?> </font></strong></p> 
            </td>
            <?php } ?>
            
        </tr>
        
        
        <tr>
            <td> 
                <p><strong> Price: </strong></p>
            </td>
            
            <?php $row = $item->fetch_assoc() ?>
            <td>
                <?php echo $row['price'] ?>
            </td>
                
            
            <td>
                
            </td>
            
            <td>
                
            </td>
        
        </tr>
        
        
        <tr>
            <td> 
                <p><strong> Manufacturer: </strong></p>
            </td>
            
            <?php $row = $item->fetch_assoc() ?> 
            <td>
                <p> <?php echo $row['manufacturer'] ?> </p>
            </td>
                
            
            <td>
                
            </td>
            
            <td>
                
            </td>
        
        </tr>
        
    </table>

</div>




