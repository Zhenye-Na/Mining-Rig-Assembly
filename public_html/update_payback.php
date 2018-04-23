<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
set_time_limit(0);
require("db.php");
echo "updating ethereum prices and payback periods\n";
$bp_url = "https://www.etherchain.org/api/price";
$json = file_get_contents($bp_url);
$data = json_decode($json,true);

$bitcoin_price = (float)$data[sizeof($data)-1]["usd"];

$result = $mysqli->query("UPDATE eth SET value=$bitcoin_price WHERE bitcoin_attr='price'");

$diff_url = "https://www.etherchain.org/api/difficulty";
$json = file_get_contents($diff_url);
$data = json_decode($json, true);
$difficulty = (float)$data[0]['difficulty'];

$result = $mysqli->query("UPDATE eth SET value=$difficulty WHERE bitcoin_attr='difficulty'");
//////////////////////////////////////////////Calculate the setup totalprice 
$query = "UPDATE includes SET totalprice=(SELECT SUM(price) FROM components WHERE name=cpu_name OR name=gpu_name OR name=ram_name OR name=psu_name OR name=mb_name);";
$result = $mysqli->query($query) or die($mysqli->error);
///////////////////////////////////////////////Calculate the pay back period
$query = "SELECT * FROM includes;";
$result = $mysqli->query($query) or die($mysqli->error);
//for each setid
while($row = $result->fetch_assoc()){
    // echo $row['setID']."<br>";
    $setid = $row['setID'];
    $subscript = $row['subscript'];
    $gpu = $row['gpu_name'];
   	$price = $row['totalprice'];
   	// calculate the total price of setup
    /*
   	foreach ($row as $column=>$value){
   	  if($column!= 'setID' && $column!= 'subscript'){
       	  $item_query = "SELECT price FROM components where name = '$value';";
       	  $item_result = $mysqli->query($item_query) or die($mysqli->error);
       	  while($row = $item_result->fetch_assoc()){
       	     $price += $row['price'];
       	  }
       }
   	 }
   	 */
   	 // calculate the pay back period for each setup(using $price(total price of each setup) and current bitcoint price(find out by API?))
     
     $query = "SELECT hashrate, power FROM gpu WHERE name='$gpu'";
     $result2 = $mysqli->query($query) or die($mysqli->error);
     $res = $result2->fetch_assoc();
     $profit_per_day = $bitcoin_price * 86400 * 3.64 * $res['hashrate'] * 1000000 / $difficulty;
     $power_bill = $res['power'] * 24 * 0.12 /1000;
     $payback_time = $price / ($profit_per_day - $power_bill);
     $result3 = $mysqli->query("UPDATE includes SET payback=$payback_time WHERE setID=$setid");
     echo "$setid : \n";
     print_r($res);
     echo "$payback_time";
   	 
   	// change the $price variable below to your pay back period variable.
   	////////////////////////////return the new pay back period to the users
     if($subscript == 1){
	   	 $user_query = "SELECT email from creates WHERE setID = $setid;";
	   	 $user_result = $mysqli->query($user_query) or die($mysqli->error);
	   	 while($row = $user_result->fetch_assoc()){
	        $message = "The pay back period of your setup has been updated now.\r\nit is $payback_time days.";

	        // In case any of our lines are larger than 70 characters, we should use wordwrap()
	        $message = wordwrap($message, 70, "\r\n");
	        
	        // Send
	        mail($row['email'], 'Updated pay back for your setup', $message);
	  	 }
	  }
   }
   // echo($price);




?>