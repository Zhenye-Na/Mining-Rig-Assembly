<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

ignore_user_abort(); //即使Client断开(如关掉浏览器)，PHP脚本也可以继续执行.
set_time_limit(0); // 执行时间为无限制，php默认执行时间是30秒，可以让程序无限制的执行下去
$interval=24*60*60*7; // 每隔7天运行一次
do{
     // 按设置的时间等待一小时循环执行
    //auto update all the price
    //caculate the expected payback period
         //check the setid that has been subscribed
                   require("db.php");
                   $query = "SELECT * FROM includes WHERE subscript = 1;";
                   $result = $mysqli->query($query) or die($mysqli->error);
                   

         //calculate the payback period of the setID
                   
                   //for each setid
                   while($row = mysql_fetch_assoc($result)){
                   	    $setid = $row['setID'];
	                   	$price = 0;
	                   	foreach ($row as $column=>$value){
	                   	  if($column!= 'setID' && $column!= 'subscript'){
		                   	  $item_query = "SELECT price FROM components where name = '$value';";
		                   	  $item_result = $mysqli->query($item_query) or die($mysqli->error);
		                   	  $price += $item_result;
		                   }
	                   	 }
                   	}
                   	echo($price);
	                   	//calculate the packback period by the new total price
	                    //
	                    //






	                   
	                   	//send the expected period to the users
	                        $query = 'select email from creates where setID = $setid;';
	                        $emal = $mysqli->query($query) or die($mysqli->error);
	                        //send email with setID and expected payback period
                   	
                   	sleep($interval);

                    //calculte the paybackperiod
                    //send the expected period to the users
                        //select email from creates where setID = setID;
                        //send email with setID and expected payback period
                        
}while(true);

?>