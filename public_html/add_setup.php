<script>
function myFunction(value, part_name, imgsrc) {
    
    selected = document.getElementById(part_name);
    table = document.getElementById(part_name.concat("_table"));
    
    selected.value = value;
    
    if (selected.value === "NULL") {
        table.style.display = "block";
    } else {
        table.style.display = "none";
    }
    
    document.getElementById("selected_table").style.display = "block";
    document.getElementById(part_name.concat("_selected_display")).style.display = "block";
    document.getElementById(part_name.concat("_selected_img")).src = imgsrc
    document.getElementById(part_name.concat("_selected_text")).innerHTML = value
    
    mb = document.getElementById("mb").value
    cpu = document.getElementById("cpu").value
    gpu = document.getElementById("gpu").value
    ram = document.getElementById("ram").value
    psu = document.getElementById("psu").value
    if (mb !== "NULL" && cpu !== "NULL" && gpu !== "NULL" && ram !== "NULL" && psu !== "NULL") {
        document.getElementById("submit").style.display = "block";
    }
}

function myFunction2(value) {
    method = "post";

    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", "info.php");

    var name = document.createElement("input");
    name.setAttribute("type", "hidden");
    name.setAttribute("name", "name");
    name.setAttribute("value", value);
    form.appendChild(name);
    
    document.body.appendChild(form);
    form.submit();
}

function myFunction3(part_name) {
    
    selected = document.getElementById(part_name);
    table = document.getElementById(part_name.concat("_table"));
    
    selected.value = "NULL";
    
    if (selected.value === "NULL") {
        table.style.display = "block";
    } else {
        table.style.display = "none";
    }
    
    document.getElementById("selected_table").style.display = "block";
    document.getElementById(part_name.concat("_selected_display")).style.display = "none";

    
    mb = document.getElementById("mb").value
    cpu = document.getElementById("cpu").value
    gpu = document.getElementById("gpu").value
    ram = document.getElementById("ram").value
    psu = document.getElementById("psu").value
    if (mb == "NULL" || cpu == "NULL" || gpu == "NULL" || ram == "NULL" || psu == "NULL") {
        document.getElementById("submit").style.display = "none";
    }
    if (mb == "NULL" && cpu == "NULL" && gpu == "NULL" && ram == "NULL" && psu == "NULL") {
        document.getElementById("selected_table").style.display = "none";
    }
}


function myFunction4(value) {
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


function submit(setID) {
    method = "post";

    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", "submit_setup.php");

    var mb = document.createElement("input");
    mb.setAttribute("type", "hidden");
    mb.setAttribute("name", "mb");
    mb.setAttribute("value", document.getElementById("mb").value);
    form.appendChild(mb);
    
    var cpu = document.createElement("input");
    cpu.setAttribute("type", "hidden");
    cpu.setAttribute("name", "cpu");
    cpu.setAttribute("value", document.getElementById("cpu").value);
    form.appendChild(cpu);
    
    var gpu = document.createElement("input");
    gpu.setAttribute("type", "hidden");
    gpu.setAttribute("name", "gpu");
    gpu.setAttribute("value", document.getElementById("gpu").value);
    form.appendChild(gpu);
    
    var ram = document.createElement("input");
    ram.setAttribute("type", "hidden");
    ram.setAttribute("name", "ram");
    ram.setAttribute("value", document.getElementById("ram").value);
    form.appendChild(ram);
    
    var psu = document.createElement("input");
    psu.setAttribute("type", "hidden");
    psu.setAttribute("name", "psu");
    psu.setAttribute("value", document.getElementById("psu").value);
    form.appendChild(psu);
    
    var SetID = document.createElement("input");
    SetID.setAttribute("type", "hidden");
    SetID.setAttribute("name", "setID");
    SetID.setAttribute("value", setID);
    form.appendChild(SetID);

    document.body.appendChild(form);
    form.submit();
}
</script>


<?php
include('header.php');
$setid = $_POST['setID'];
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<?php
require("db.php");
?>


<param id="mb" name="mb" value="NULL">
<param id="cpu" name="cpu" value="NULL">
<param id="gpu" name="gpu" value="NULL">
<param id="psu" name="psu" value="NULL">
<param id="ram" name="ram" value="NULL">


<style>
    #selected_table {
        display: none;
    }
    
    #mb_selected_display {
        display: none;
    }
    
    #cpu_selected_display {
        display: none;
    }
    
    #gpu_selected_display {
        display: none;
    }
    
    #ram_selected_display {
        display: none;
    }
    
    #psu_selected_display {
        display: none;
    }
    
    #submit {
        display: none;
    }
</style>

<div id = "selected_table" class = "container bg-info well well-lg">
        	<h2>Selected Component</h2>
        	<!-- <% campgrounds.forEach(function(campground){ %> -->
		    <div class="row text-center" style="display:flex; flex-wrap: wrap;">
		        
	            <div id = "mb_selected_display" class = "col-md-3 col-lg-2 col-sm-6">
	                <div class = "thumbnail" >
	                    <img id = "mb_selected_img" src = "" >
	                    <div class = "caption text-center">
	                        <h4 id = "mb_selected_text"></h4>
	                    </div>
	                    <p>
                            <?php echo "<a class = \"btn btn-danger\" onclick=\"myFunction3('mb')\">Remove</a>"; ?>
                        </p>
	                </div>
	            </div>
	            
	            <div id = "cpu_selected_display" class = "col-md-3 col-lg-2 col-sm-6">
	                <div class = "thumbnail" >
	                    <img id = "cpu_selected_img" src = "" >
	                    <div class = "caption text-center">
	                        <h4 id = "cpu_selected_text"></h4>
	                    </div>
	                    <p>
                            <?php echo "<a class = \"btn btn-danger\" onclick=\"myFunction3('cpu')\">Remove</a>"; ?>
                        </p>
	                </div>
	            </div>
	            
	            <div id = "gpu_selected_display" class = "col-md-3 col-lg-2 col-sm-6">
	                <div class = "thumbnail" >
	                    <img id = "gpu_selected_img" src = "" >
	                    <div class = "caption text-center">
	                        <h4 id = "gpu_selected_text"></h4>
	                    </div>
	                    <p>
                            <?php echo "<a class = \"btn btn-danger\" onclick=\"myFunction3('gpu')\">Remove</a>"; ?>
                        </p>
	                </div>
	            </div>
	            
	            <div id = "ram_selected_display" class = "col-md-3 col-lg-2 col-sm-6">
	                <div class = "thumbnail" >
	                    <img id = "ram_selected_img" src = "" >
	                    <div class = "caption text-center">
	                        <h4 id = "ram_selected_text"></h4>
	                    </div>
	                    <p>
                            <?php echo "<a class = \"btn btn-danger\" onclick=\"myFunction3('ram')\">Remove</a>"; ?>
                        </p>
	                </div>
	            </div>
	            
	            <div id = "psu_selected_display" class = "col-md-3 col-lg-2 col-sm-6">
	                <div class = "thumbnail" >
	                    <img id = "psu_selected_img" src = "" >
	                    <div class = "caption text-center">
	                        <h4 id = "psu_selected_text"></h4>
	                    </div>
	                    <p>
                            <?php echo "<a class = \"btn btn-danger\" onclick=\"myFunction3('psu')\">Remove</a>"; ?>
                        </p>
	                </div>
	            </div>
	            
	        </div>
	        <a id = "submit" onclick="submit(<?php echo $setid ;?>)" class = "btn btn-success">Complete</a>
	    </div>

<?php
$email = $_SESSION['username'];
$query = "SELECT * FROM components WHERE name IN (
SELECT name FROM (
(SELECT name, MAX(c1) FROM (SELECT mb_name as name, COUNT(mb_name) AS c1 FROM creates,includes  WHERE creates.setID=includes.setID AND creates.email='$email' GROUP BY mb_name ORDER BY c1 DESC)t1)
UNION
(SELECT name, MAX(c1) FROM (SELECT cpu_name as name, COUNT(cpu_name) AS c1 FROM creates,includes  WHERE creates.setID=includes.setID AND creates.email='$email' GROUP BY cpu_name ORDER BY c1 DESC)t2)
UNION
(SELECT name, MAX(c1) FROM (SELECT gpu_name as name, COUNT(gpu_name) AS c1 FROM creates,includes  WHERE creates.setID=includes.setID AND creates.email='$email' GROUP BY gpu_name ORDER BY c1 DESC)t3)
UNION
(SELECT name, MAX(c1) FROM (SELECT ram_name as name, COUNT(ram_name) AS c1 FROM creates,includes  WHERE creates.setID=includes.setID AND creates.email='$email' GROUP BY ram_name ORDER BY c1 DESC)t4)
UNION
(SELECT name, MAX(c1) FROM (SELECT psu_name as name, COUNT(psu_name) AS c1 FROM creates,includes  WHERE creates.setID=includes.setID AND creates.email='$email' GROUP BY psu_name ORDER BY c1 DESC)t5)) namet);";

$result = $mysqli->query($query) or die($mysqli->error);
$component_array = array("mb", "cpu", "gpu", "ram", "psu");
$component_index = 0;
?>

<?php if ($result->num_rows >= 5) { ?>  
<div id = "user_favorite" class = "container bg-info well well-lg">
    <h2>User Favorite</h2>
    <!-- <% campgrounds.forEach(function(campground){ %> -->
	<div class="row text-center" style="display:flex; flex-wrap: wrap;">
	    <?php while($row = $result->fetch_assoc()) { ?>
        <div class = "col-md-3 col-lg-2 col-sm-6">
            <div class = "thumbnail" >
                <?php echo '<img src='.$row['image_url'].'>'; ?>
                <div class = "caption text-center">
                    <h4><?php echo $row['name']; ?></h4>
                </div>
                <p>
                    <?php echo "<a class = \"btn btn-success\" onclick=\"myFunction('".$row['name']."','$component_array[$component_index]','".$row['image_url']."')\">Add</a>";
                    $component_index = $component_index + 1; ?>
                    
                    <?php echo "<a class = \"btn btn-success\" onclick=\"myFunction4('".$row['name']."')\">Info</a>"; ?>
                </p>
            </div>
        </div>
        <?php } ?>
<?php } ?>
	            
	</div>
	<a id = "submit" onclick="submit(<?php echo $setid ;?>)" class = "btn btn-success">Complete</a>
</div>

<?php
$query = "SELECT * FROM components where name IN (SELECT name 
                                       FROM mb);";
$result = $mysqli->query($query) or die($mysqli->error);
?>

<div id = "mb_table" class = "container bg-info well well-lg">
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
                    <?php echo "<a class = \"btn btn-success\" onclick=\"myFunction('".$row['name']."','mb','".$row['image_url']."')\">Add</a>"; ?>
                    
                    <?php echo "<a class = \"btn btn-success\" onclick=\"myFunction4('".$row['name']."')\">Info</a>"; ?>
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

<div id = "cpu_table" class = "container bg-info well well-lg">
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
                    <?php echo "<a class = \"btn btn-success\" onclick=\"myFunction('".$row['name']."','cpu','".$row['image_url']."')\">Add</a>"; ?>
                    <?php echo "<a class = \"btn btn-success\" onclick=\"myFunction4('".$row['name']."')\">Info</a>"; ?>
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

<div id = "gpu_table" class = "container bg-info well well-lg">
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
                    <?php echo "<a class = \"btn btn-success\" onclick=\"myFunction('".$row['name']."','gpu','".$row['image_url']."')\">Add</a>"; ?>
                    <?php echo "<a class = \"btn btn-success\" onclick=\"myFunction4('".$row['name']."')\">Info</a>"; ?>
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

<div id = "ram_table" class = "container bg-info well well-lg">
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
                    <?php echo "<a class = \"btn btn-success\" onclick=\"myFunction('".$row['name']."','ram','".$row['image_url']."')\">Add</a>"; ?>
                    <?php echo "<a class = \"btn btn-success\" onclick=\"myFunction4('".$row['name']."')\">Info</a>"; ?>
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

<div id = "psu_table" class = "container bg-info well well-lg">
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
                    <?php echo "<a class = \"btn btn-success\" onclick=\"myFunction('".$row['name']."','psu','".$row['image_url']."')\">Add</a>"; ?>
                    <?php echo "<a class = \"btn btn-success\" onclick=\"myFunction4('".$row['name']."')\">Info</a>"; ?>
                </p>
            </div>
        </div>
        <?php } ?>
     </div>
</div>

<?php



$result = $mysqli->query("SELECT * FROM includes where setID = '$setid'");
$set = $result->fetch_assoc();
//cpu
$result2 = $mysqli->query("SELECT name, image_url FROM components where name='".$set['cpu_name']."'");
$row = $result2->fetch_assoc();
if($row['name']!=null){
echo "<script>
      myFunction('".$row['name']."', 'cpu', '".$row['image_url']."');
     </script>";
}
//mb
$result2 = $mysqli->query("SELECT name, image_url FROM components where name='".$set['mb_name']."'");
$row = $result2->fetch_assoc();
if($row['name']!=null){
echo "<script>
      myFunction('".$row['name']."', 'mb', '".$row['image_url']."');
     </script>";
}
//gpu
$result2 = $mysqli->query("SELECT name, image_url FROM components where name='".$set['gpu_name']."'");
$row = $result2->fetch_assoc();
if($row['name']!=null){
echo "<script>
      myFunction('".$row['name']."', 'gpu', '".$row['image_url']."');
     </script>";
}
//ram
$result2 = $mysqli->query("SELECT name, image_url FROM components where name='".$set['ram_name']."'");
$row = $result2->fetch_assoc();
if($row['name']!=null){
echo "<script>
      myFunction('".$row['name']."', 'ram', '".$row['image_url']."');
     </script>";
}
//psu
$result2 = $mysqli->query("SELECT name, image_url FROM components where name='".$set['psu_name']."'");
$row = $result2->fetch_assoc();
if($row['name']!=null){
echo "<script>
      myFunction('".$row['name']."', 'psu', '".$row['image_url']."');
     </script>";
}
?>
<?php
include('footer.php');
?>
</html>