<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

ignore_user_abort(); //即使Client断开(如关掉浏览器)，PHP脚本也可以继续执行.
set_time_limit(0); // 执行时间为无限制，php默认执行时间是30秒，可以让程序无限制的执行下去
// $interval=24*60*60*7; // 每隔7天运行一次
$interval=2;// This interval will change to 24*60*60*7, 2 is just for testing.
do{

    require("db.php");
    /////////////////////////////////////////////Update prices of all components
    $query = "SELECT ASIN FROM components";
    $asinresult = $mysqli->query($query) or die($mysqli->error);
    // Your Access Key ID, as taken from the Your Account page
    $access_key_id = "AKIAJZ2PXUCFPSBXDP7Q";
    
    // Your Secret Key corresponding to the above ID, as taken from the Your Account page
    $secret_key = "/lKdz/9mxKkPYZ32YKJkIGI3i5rdKU/cPNP6XIOY";
    
    // The region you are interested in
    $endpoint = "webservices.amazon.com";
    
    $uri = "/onca/xml";
    
    $count = 0;
    $asinstr = "";
    while(1) {
        $row = $asinresult->fetch_assoc();
        if ($row != NULL) {
            
        
            if ($count == 0){
                $asinstr = $row['ASIN'];
            }
            else {
                $asinstr = $asinstr . "," . $row['ASIN'];
            }
            $count = $count + 1;
        }
        if (($count >= 10) || ($row == NULL)) {
    
            $params = array(
                "Service" => "AWSECommerceService",
                "Operation" => "ItemLookup",
                "AWSAccessKeyId" => "AKIAJZ2PXUCFPSBXDP7Q",
                "AssociateTag" => "fama0aa-20",
                "ItemId" => $asinstr,
                "IdType" => "ASIN",
                "ResponseGroup" => "ItemAttributes"
            );
    
            // Set current timestamp if not set
            if (!isset($params["Timestamp"])) {
                $params["Timestamp"] = gmdate('Y-m-d\TH:i:s\Z');
            }
            
            // Sort the parameters by key
            ksort($params);
            
            $pairs = array();
            
            foreach ($params as $key => $value) {
                array_push($pairs, rawurlencode($key)."=".rawurlencode($value));
            }
            
            // Generate the canonical query
            $canonical_query_string = join("&", $pairs);
            
            // Generate the string to be signed
            $string_to_sign = "GET\n".$endpoint."\n".$uri."\n".$canonical_query_string;
            
            // Generate the signature required by the Product Advertising API
            $signature = base64_encode(hash_hmac("sha256", $string_to_sign, $secret_key, true));
            
            // Generate the signed URL
            $request_url = 'http://'.$endpoint.$uri.'?'.$canonical_query_string.'&Signature='.rawurlencode($signature);
            
            $xml = file_get_contents($request_url);
            
            //load xml
            $xml = simplexml_load_string($xml);
            
            $cnt = 0;
            while ($cnt < $count) {
                
                $price = (float)($xml->Items->Item[$cnt]->ItemAttributes->ListPrice->Amount[0])/100;
                $asin = $xml->Items->Item[$cnt]->ASIN;
    
                
                $result = $mysqli->query("UPDATE components SET price=$price WHERE ASIN='$asin'");
                $cnt = $cnt + 1;
            }
            $asinstr = "";
            $count = 0;
            if ($row == NULL) {
                break;
            }
            
        }
    }
    ////////////////////////////////////////////////////////////////////////////
   
   ///////////////////////////////////////////////Calculte the pay back period
   $query = "SELECT * FROM includes WHERE subscript = 1;";
   $result = $mysqli->query($query) or die($mysqli->error);
   //for each setid
   while($row = $result->fetch_assoc()){
        echo $row['setID']."<br>";
   	    $setid = $row['setID'];
       	$price = 0;
       	// calculate the total price of setup
       	foreach ($row as $column=>$value){
       	  if($column!= 'setID' && $column!= 'subscript'){
           	  $item_query = "SELECT price FROM components where name = '$value';";
           	  $item_result = $mysqli->query($item_query) or die($mysqli->error);
           	  while($row = $item_result->fetch_assoc()){
           	     $price += $row['price'];
           	  }
           }
       	 }
       	 
       	 // calculate the pay back period for each setup($price(total price of each setup) and $setid has been given, find current bitcoin price by API)
       	 
       	 
       	 
       	 
       	 
       	 
       	 
       	// change the $price variable below to your pay back period variable.
       	////////////////////////////return the new pay back period to the users
       	 $user_query = "SELECT email from creates WHERE setID = $setid;";
       	 $user_result = $mysqli->query($user_query) or die($mysqli->error);
       	 while($row = $user_result->fetch_assoc()){
            $message = "The pay back period of your setup has been updated now.\r\nit is $price days.";

            // In case any of our lines are larger than 70 characters, we should use wordwrap()
            $message = wordwrap($message, 70, "\r\n");
            
            // Send
            mail($row['email'], 'Updated pay back for your setup', $message);
      	  }
   	}
   	echo($price);
    sleep($interval);

}while(true);

?>