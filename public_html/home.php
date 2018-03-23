<?php
include('header.php');
?>
    <?php
	session_start(); //starts the session
	if($_SESSION['email']){ //checks if user is logged in
	}
	else{
		header("location:login.php"); // redirects if user is not logged in
	}
	$email = $_SESSION['email']; //assigns user value
	?>


<?php   //Create(Account.email, Setup.Setid)  Includes(Setup.Setid, Component.name), Component(Name, Manufacturer, Price)
/*require("db.php");
$query = "SELECT Component.Name as name, Component.Manufacturer as manufacturer, Component.Price as price, image_url?
          FROM Create as c1, Includes as i1, Component as c2
          WHERE Create.Setup.Setid = Includes.Setup.Setid
            AND Create.Account.email = $email    <- If possible here
            AND Includes.Component.name = Component.Name


          ;";
$result = $mysqli->query($query) or die($mysqli->error);
*/
?>


    <div class = "container">
    	<div class = "text-center" style = "padding-bottom: 30px">
	    <a class = "btn btn-primary btn-lg"href="add_setup.php">Create Your Setup</a>
	</div>

        
        <div class = "container bg-info well well-lg">
        	<h2>SetUP#1</h2>
        	<!-- <% campgrounds.forEach(function(campground){ %> -->
		    <div class="row text-center" style="display:flex; flex-wrap: wrap;">
		    	<?php while($row = $result->fetch_assoc()) { ?>
	            <div class = "col-md-3 col-lg-2 col-sm-6">
	                <div class = "thumbnail" >
                        <?php echo '<img src='.$row['image_url'].'>'; ?>
	                    <div class = "caption text-center">
	                        <h4><?php echo $row['name']; ?></h4>
	                    </div>
	                </div>
	            </div>
	            <div class = "col-md-3 col-lg-2 col-sm-6">
	                <div class = "thumbnail">
	                    <img src = "http://images.wisegeek.com/cpu-processor.jpg">
	                    <div class = "caption text-center">
	                        <h4><!-- <%= campground.name%> -->CPU</h4>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <a href="setup.php" class = "btn btn-success">Edit</a>
	    </div>

	    <div class = "container bg-info well well-lg">
        	<h2>SetUP#2</h2>
        	<!-- <% campgrounds.forEach(function(campground){ %> -->
		    <div class="row text-center" style="display:flex; flex-wrap: wrap;">
	            <div class = "col-md-3 col-lg-2 col-sm-6">
	                <div class = "thumbnail">
	                    <img src = "https://motherboardsforgaming.com/wp-content/uploads/2015/02/ASUS-SABERTOOTH-990FX1.jpg">
	                    <div class = "caption text-center">
	                        <h4><!-- <%= campground.name%> -->Mother Board</h4>
	                    </div>
	                    <p>
	                        <a href="" class = "btn btn-danger">Delete</a>
	                    </p>
	                </div>
	            </div>
	            <div class = "col-md-3 col-lg-2 col-sm-6">
	                <div class = "thumbnail">
	                    <img src = "http://images.wisegeek.com/cpu-processor.jpg">
	                    <div class = "caption text-center">
	                        <h4><!-- <%= campground.name%> -->CPU</h4>
	                    </div>
	                </div>
	            </div>
	        </div>
	        <a href="setup.php" class = "btn btn-success">Edit</a>
	    </div>	
	

<?php
include('footer.php');
?>