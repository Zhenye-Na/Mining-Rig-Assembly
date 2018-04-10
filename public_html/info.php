<?php
include('header.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<style>
img {
    float: left;
    width: 400px;
    height: auto;
}
</style>



<?php
//session_start(); //starts the session
if($_SESSION['username']){ //checks if user is logged in
}
else{
    //Add pop-ups for users who did not login, redirect to the login.php
	echo "<script>alert('Please first log in, then see the detail of this component!');</script>";
	Print '<script>window.location.assign("login.php");</script>';
	//header("location:login.php"); // redirects if user is not logged in
}
// $username = $_SESSION['username']; //assigns user value
?>



<?php
require("db.php");
$name = $mysqli->real_escape_string($_POST['name']);

$query = "SELECT *
          FROM components
          WHERE name = '$name';";
// $result = $mysqli->query($query) or die($mysqli->error);
$result = mysqli_query($mysqli, $query) or die($mysqli->error);


//advanced query
$advanced_query = "SELECT COUNT(*) as c1 FROM (SELECT DISTINCT email FROM creates,includes WHERE creates.setID=includes.setID AND (includes.cpu_name='$name' OR includes.gpu_name='$name' OR includes.ram_name='$name' OR includes.psu_name='$name' OR includes.mb_name='$name') ) t1;";
// $advanced_result = $mysqli->query($advanced_query) or die($mysqli->error);

$advanced_result = mysqli_query($mysqli, $advanced_query) or die($mysqli->error);

//similar components query
$similar_query = "SELECT c1.*
                  FROM components as c1
                  WHERE c1.price - 10 >= (SELECT c2.price
                                          FROM components as c2
                                          WHERE name = '$name')
                    OR  c1.price + 10 <= (SELECT c3.price
                                          FROM components as c3
                                          WHERE name = '$name');";

$similar_result = mysqli_query($mysqli, $similar_query) or die($mysqli->error);

// while($var = mysqli_fetch_array($similar_result)) {
//     echo $var['name'];
//     echo "<img src='" . $var['image_url'] . "' height='130' width='130'> ";
// }

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
    	<?php while($row = mysqli_fetch_array($result)) { ?>
        
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
                    <!--advanced query result display-->
                    <tr>
                        <td> <strong>Number of user picked this item: </strong></td>
                        <td> <?php $adv_row = mysqli_fetch_array($advanced_result); echo $adv_row['c1'] ?> </td>
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
            
            <div class="fb-share-button" data-href="http://rigassembly.web.engr.illinois.edu/info.php" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Frigassembly.web.engr.illinois.edu%2Finfo.php&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Share</a></div>
            
            </td>
        	
	    </tr>
    </table>
    

</div>

<?php
mysqli_data_seek($result, 0);
mysqli_data_seek($advanced_result, 0);
?>

<div class = "container bg-info well well-lg">
	<p><strong><font size="4" face="verdana" color=FF5733> Customers who bought this item also bought </font></strong></p>
	


</div>


<!--Compare with similar items-->

<div class = "container bg-info well well-lg">
	<p><strong><font size="4" face="verdana" color=FF5733> Compare with similar items </font></strong></p>
	
    <table class="similar">
        <!--First column: Component image and name-->
        <tr>
            <td> 
                <p> </p>
            </td>
            
            
            <!--First column -> Indicates this component-->
            <?php while($row = mysqli_fetch_array($result)) { ?>
            
            <td > 
                <div class = "thumbnail">
                    <?php echo "<img src='" . $row['image_url'] . "' height='130' width='130'> "; ?>
                    
                </div>
                <p> <?php echo $row['name'] ?> </p>
            </td>
            
            <!--Second column -> Indicates similar object 1 name-->
            <?php $new_item = mysqli_fetch_array($similar_result) ?>
            <td> 
                <div class = "thumbnail">
                    <?php echo "<img src='" . $new_item['image_url'] . "' height='130' width='130'> "; ?>
                    
                </div>
                <p> <?php echo $new_item['name'] ?> </p>
            </td>
            
            <!--Third column -> Indicates similar object 2 name-->
            <?php $new_item = mysqli_fetch_array($similar_result) ?>
            <td> 
                <div class = "thumbnail">
                    <?php echo "<img src='" . $new_item['image_url'] . "' height='130' width='130'> "; ?>
                    
                </div>
                <p> <?php echo $new_item['name'] ?> </p>
            </td>
            
            
            <!--Fourth column -> Indicates similar object 3 name-->
            <?php $new_item = mysqli_fetch_array($similar_result) ?>
            <td> 
                <div class = "thumbnail">
                    <?php echo "<img src='" . $new_item['image_url'] . "' height='130' width='130'> "; ?>
                    
                </div>
                <p> <?php echo $new_item['name'] ?> </p>
            </td>
            
            
        </tr>
        
        <!--Second row : Price-->
        <tr>
            <td> 
                <p><strong> Price: </strong></p>
            </td>

            
            <td>
                <?php echo $row['price'] ?>
            </td>
                
            <?php $new_item = mysqli_fetch_array($similar_result) ?>
            <td>
                <?php echo $new_item['price'] ?>
            </td>
            
            <?php $new_item = mysqli_fetch_array($similar_result) ?>
            <td>
                <?php echo $new_item['price'] ?>
            </td>
            
            <?php $new_item = mysqli_fetch_array($similar_result) ?>
            <td>
                <?php echo $new_item['price'] ?>
            </td>
        
        </tr>
        
        <!--Third row : Manufacturer-->
        <tr>
            <td> 
                <p><strong> Manufacturer: </strong></p>
            </td>
            
            
            <td>
                <?php echo $row['manufacturer'] ?>
            </td>
                
            
            <?php $new_item = mysqli_fetch_array($similar_result) ?>
            <td>
                <?php echo $new_item['manufacturer'] ?>
            </td>
            
            <?php $new_item = mysqli_fetch_array($similar_result) ?>
            <td>
                <?php echo $new_item['manufacturer'] ?>
            </td>
            
            <?php $new_item = mysqli_fetch_array($similar_result) ?>
            <td>
                <?php echo $new_item['manufacturer'] ?>
            </td>
        
        </tr>
        
        
        
        <!--Fourth row : Description-->
        <tr>
            <td> 
                <p><strong> Description: </strong></p>
            </td>
            
            
            <td>
                <?php echo $row['description'] ?>
            </td>
                
            
            <?php $new_item = mysqli_fetch_array($similar_result) ?>
            <td>
                <?php echo $new_item['description'] ?>
            </td>
            
            <?php $new_item = mysqli_fetch_array($similar_result) ?>
            <td>
                <?php echo $new_item['description'] ?>
            </td>
            
            <?php $new_item = mysqli_fetch_array($similar_result) ?>
            <td>
                <?php echo $new_item['description'] ?>
            </td>
        
        </tr>
        
        
        
        <!--Fifth row : Number of user picked this item-->
        <!--<tr>-->
        <!--    <td> -->
        <!--        <strong> Number of user picked this item: </strong>-->
        <!--    </td>-->
            
        <!--    <td>-->
        <!--        <?php $adv_row = mysqli_fetch_array($advanced_result); echo $adv_row['c1'] ?>-->
        <!--    </td>-->
            
        <!--    <td>-->
        <!--        <?php $adv_row = mysqli_fetch_array($advanced_result); echo $adv_row['c1'] ?>-->
        <!--    </td>-->
        <!--</tr>-->
            <?php } ?>
    </table>

</div>




