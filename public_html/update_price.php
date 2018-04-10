<?php

require('db.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

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
while($row = $asinresult->fetch_assoc()) {
    
    if ($count == 0){
        $asinstr = $row['ASIN'];
    }
    else {
        $asinstr = $asinstr . "," . $row['ASIN'];
    }
    $count = $count + 1;
    if ($count >= 10) {
        
        $asinstr = '"'.$asinstr.'"';
        echo $asinstr;
        echo "\n";

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
        //print_r($xml);
        
        //test code below
        print_r($xml->Items->Item[0]);
        echo $count;
        echo "\n";
        $cnt = 0;
        while ($cnt < $count) {
            $price = (float)($xml->Items->Item[$cnt]->ItemAttributes->ListPrice->Amount[0])/100;
            $asin = $xml->Items->Item[$cnt]->ASIN;
            echo $cnt;
            echo $asin;
            echo $price;
            
            echo "\n";
            
            
            $result = $mysqli->query("UPDATE components SET price=$price WHERE ASIN='$asin'");
            $cnt = $cnt + 1;
        }
        echo $asinstr;
        $asinstr = "";
        $count = 0;
        // /test 
    }
}


?>