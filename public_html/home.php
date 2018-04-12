<?php
session_start(); //starts the session
if($_SESSION['username']){ //checks if user is logged in
}
else{
	header("location:login.php"); // redirects if user is not logged in
}
$username = $_SESSION['username']; //assigns user value
?>
<script>
    function myFunction(value) {
    method = "post";

    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", "home.php");

    var name = document.createElement("input");
    name.setAttribute("type", "hidden");
    name.setAttribute("name", "setID");
    name.setAttribute("value", value);
    form.appendChild(name);
    
    document.body.appendChild(form);
    form.submit();
}
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

<?php
include('header.php');
?>


    <div class = "container">
    	<div class = "text-center" style = "padding-bottom: 30px">

        	    <a class = "btn btn-primary btn-lg" onclick="myFunction2(-1)" style="width: 200px" >Create Your Setup</a>
        	    
        	    <a class = "btn btn-primary btn-lg" style="width: 200px" href="compare.php" target="_blank" >Compare Your Setup</a>

    	 
	    </div>



 <?php
 // //select all the setups of user and return
 //      select * from includes where setID in
 //     (select setID from creates where email = $username;??)
 //     setID motherboard psu mb ram
require("db.php");
$query = "SELECT * FROM includes where setID IN (SELECT setID 
                                       FROM creates
                                       where email = '$username');";
// $result = mysqli_query($con,"SELECT `note` FROM `glogin_users` WHERE email = '$email'");
$result = $mysqli->query($query) or die($mysqli->error);
?>

<!-- $order = 0;
//for each row:
     for each attribute(component):??
         show if not null -->

    <?php $order = 1;?>
    <?php while($row = $result->fetch_assoc()) { ?>
    <div class = "container bg-info well well-lg">
    	<h2>SetUP#<?php echo $order; ?></h2>
	    <div class="row text-center" style="display:flex; flex-wrap: wrap;">
	    	<?php foreach ($row as $column=>$value){ ?>
	    	<?php if($column != 'setID'){?>
	    	<?php if(!empty($value)){?>
            <div class = "col-md-3 col-lg-2 col-sm-6">
                <div class = "thumbnail" >
                    <?php
                    require("db.php");
                    $item_query = "SELECT * FROM components where name = '$value';";
                    $item_result = $mysqli->query($item_query) or die($mysqli->error);
                    while($item = $item_result->fetch_assoc()) {
                       echo '<img src='.$item['image_url'].'>';
                    ?>
                    <div class = "caption text-center">
                        <h4><?php echo $item['name']; ?></h4>
                    </div>
                    <?php }?>
                </div>
            </div>
            <?php } ?>
            <?php } ?>
            <?php } ?>
        </div>
        <?php echo "<a class = \"btn btn-success\" onclick=\"myFunction2('".$row['setID']."')\">Edit</a>"; ?>
        <?php echo "<a class = \"btn btn-danger\" onclick=\"myFunction('".$row['setID']."')\">Delete</a>"; ?>
        <?php $order += 1?>
    </div>
    <?php } ?>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $setid = $mysqli->real_escape_string($_POST['setID']);
    $result = $mysqli->query("DELETE FROM includes WHERE setID = $setid;");
    $result = $mysqli->query("DELETE FROM creates WHERE setID = $setid;");
    $URL="http://rigassembly.web.engr.illinois.edu/home.php";
    echo "<script type='text/javascript'>document.location.href='{$URL}';</script>";
}
?>

<?php
include('footer.php');
?>