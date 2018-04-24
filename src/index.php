<?php
include('header.php');
?>
	<!--<div class = "container">-->
	<!--	<h3>Hello!</h3>-->
	<!--    <P> This website lets you browse and select parts of your mining rigs, store your own rig setups, and estimate their performances. Login or sign up to get started!</P>	-->
	<!--    <h3>Advanced Functions</h3>-->
	<!--    <ul>-->
	<!--    <li> Calculate the payback period of different mining rig setups </li>-->
	<!--    <p> This function is the core of this application. It allows the users to plan their investments without having to monitor every little aspect of the market at all time. It is especially useful, and convenient to have in the current situation because of how rapidly the prices are changing.</p>-->
	<!--    <li> Compare between different parts and setups with visualization</li>-->
	<!--    <p>This can help user easier to understand the tradeoff of different setups and choose the best setup based on the comparison.</p>-->
	    
	<!--    </ul>-->
	    
	<!--        <h3>Advanced Queries</h3>-->
	<!--    <ul>-->
	<!--    <li> How many users have chosen specific component for their setups?</li>-->
	<!--    <p> "SELECT COUNT(*) as c1</p>-->
 <!--       <p> FROM (SELECT DISTINCT email</p>-->
 <!--       <p>       FROM creates,includes</p>-->
 <!--       <p>       WHERE creates.setID=includes.setID</p>-->
 <!--       <p>       AND (includes.cpu_name='$name' OR includes.gpu_name='$name' OR</p>-->
 <!--       <p>       includes.ram_name='$name' OR includes.psu_name='$name' OR includes.mb_name='$name') ) t1;"</p>-->
	<!--    <li> For each category what component a specific user favor most?</li>-->
	<!--    <p>"SELECT * FROM components WHERE name IN (SELECT name FROM (</p>-->
 <!--       <p>(SELECT name, MAX(c1) FROM (SELECT mb_name as name, COUNT(mb_name) AS c1 FROM creates,includes WHERE creates.setID=includes.setID AND creates.email=$email GROUP BY mb_name ORDER BY c1 DESC)t1)</p>-->
 <!--       <p>UNION</p>-->
 <!--       <p>(SELECT name, MAX(c1) FROM (SELECT cpu_name as name, COUNT(cpu_name) AS c1 FROM creates,includes WHERE creates.setID=includes.setID AND creates.email=$email GROUP BY cpu_name ORDER BY c1 DESC)t2)</p>-->
 <!--       <p>UNION</p>-->
 <!--       <p>(SELECT name, MAX(c1) FROM (SELECT gpu_name as name, COUNT(gpu_name) AS c1 FROM creates,includes WHERE creates.setID=includes.setID AND creates.email=$email GROUP BY gpu_name ORDER BY c1 DESC)t3)</p>-->
 <!--       <p>UNION</p>-->
 <!--       <p>(SELECT name, MAX(c1) FROM (SELECT ram_name as name, COUNT(ram_name) AS c1 FROM creates,includes WHERE creates.setID=includes.setID AND creates.email=$email GROUP BY ram_name ORDER BY c1 DESC)t4)</p>-->
 <!--       <p>UNION</p>-->
 <!--       <p>(SELECT name, MAX(c1) FROM (SELECT psu_name as name, COUNT(psu_name) AS c1 FROM creates,includes WHERE creates.setID=includes.setID AND creates.email=$email GROUP BY psu_name ORDER BY c1 DESC)t5)) namet);";</p>-->
	<!--    </ul>-->
	<!--</div>-->
	<header class = jumbotron>
	    <div class = "text-center">
	        <h1>Welcome to Rigs Assembly</h1>
	        <p>Build your own setup by choosing our powerful components!</p>
	        <p>
	            <a class = "btn btn-primary btn-large" href = 'register.php'>Sign Up</a>
	        </p>
	    </div>
	</header>

<?php
include('footer.php');
?>