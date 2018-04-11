<?php
include('header.php');
?>

<?php
session_start(); //starts the session
if($_SESSION['username']){ //checks if user is logged in
}
else{
  header("location:login.php"); // redirects if user is not logged in
}
$username = $_SESSION['username']; //assigns user value
?>

<?php

/* Include the `fusioncharts.php` file that contains functions to embed the charts. */
include("includes/fusioncharts.php");

/* Establish a connection to the database */
require("db.php");
$email = $_SESSION['username']

?>

<html>
<head>

  <!-- <link  rel="stylesheet" type="text/css" href="css/style.css" /> -->

      <!-- You need to include the following JS file to render the chart.
      When you make your own charts, make sure that the path to this JS file is correct.
      Else, you will get JavaScript errors. -->

      <script src="includes/fusioncharts.js"></script>
      <script src="includes/fusioncharts.theme.fint.js"></script>
  </head>

  <body>
      <?php

      // Form the SQL query that returns the top 10 most populous countries
      /* $strQuery = "SELECT Name, Population FROM Country ORDER BY Population DESC LIMIT 10"; */
      
      // $strQuery = "SELECT cpu_name, gpu_name, mb_name, psu_name, ram_name, subscript
      //              FROM includes
      //              WHERE setID = (SELECT setID
      //                             FROM creates
      //                             WHERE email = '$email')";


      // cpu query -> cpu_name, speed, price
      $cpuQuery = "SELECT cpu.name as name, cpu.speed as speed, components.price as price
                   FROM creates
                   INNER JOIN includes ON creates.setID = includes.setID
                   INNER JOIN cpu ON includes.cpu_name = cpu.name
                   INNER JOIN components ON components.name = cpu.name
                   WHERE creates.email = '$email'";
      
      
      // gpu query -> gpu_name, price, lock
      $gpuQuery = "SELECT name, lock
                   FROM gpu
                   WHERE name IN (SELECT gpu_name
                                 FROM includes
                                 WHERE setID IN (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))
                   UNION
                   SELECT price
                   FROM components
                   WHERE name IN (SELECT gpu_name
                                 FROM includes
                                 WHERE setID IN (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))";

      // mb query -> mb_name, price
      $mbQuery = "SELECT name, price
                   FROM components
                   WHERE name IN (SELECT mb_name
                                 FROM includes
                                 WHERE setID IN (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))";


      // psu query -> name, power, price
      $psuQuery = "SELECT name, power
                   FROM psu
                   WHERE name IN (SELECT psu_name
                                 FROM includes
                                 WHERE setID = (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))
                   UNION
                   SELECT price
                   FROM components
                   WHERE name IN (SELECT psu_name
                                 FROM includes
                                 WHERE setID IN (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))";


      // ram query -> name, price, size
      $ramQuery = "SELECT name, size
                   FROM ram
                   WHERE name IN (SELECT ram_name
                                 FROM includes
                                 WHERE setID IN (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))
                   UNION
                   SELECT price
                   FROM components
                   WHERE name IN (SELECT ram_name
                                 FROM includes
                                 WHERE setID IN (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))";

      // Execute the query, or else return the error message.

      $resultcpu = mysqli_query($mysqli, $cpuQuery) or exit("Error code ({$mysqli->errno}): {$mysqli->error}");

      // If the query returns a valid response, prepare the JSON string
      if ($resultcpu) {
        // The `$arrData` array holds the chart attributes and data
        $arrData = array(
            "chart" => array(
              "caption" => "Comparison between your selected CPUs",
              "showValues" => "1",
              "theme" => "fint",
              "pyaxisname"=> "Price",
              "syaxisname"=> "Speed",
              "xaxisname"=>"CPU",
              "pYAxisMaxValue"=> "5",
              "numberPrefix"=> "$",

          )
        );

        // creating array for categories object
        
        $arrData["data"] = array();
        $categoryArray=array();
        $dataseries1=array();
        $dataseries2=array();
        // $dataseries3=array();

        // Push the data into the array

        // pushing category array values
        while($row = mysqli_fetch_array($resultcpu)) {
            //  echo $row["name"], $row["speed"], $row["price"], '\n';

            array_push($categoryArray, array(
                "label" => $row["name"]
                )
            );
            
             array_push($dataseries1, array(
                "value" => $row["speed"]
                )
            );
            
            array_push($dataseries2, array(
                "value" => $row["price"]
                )
            );
            
            }


      $arrData["categories"]=array(array("category"=>$categoryArray));
      // creating dataset object
      $arrData["dataset"] = array(
        array("seriesName"=> "Speed", "parentYAxis" => "S", "showValues"=> "0", "data"=>$dataseries1), 
        array("seriesName"=> "Price", "data"=>$dataseries2));


     /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

     $jsonEncodedData = json_encode($arrData);

     /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

     $columnChart = new FusionCharts("mscombidy2d",
                                     "chartId",
                                     700,
                                     400,
                                     "chart-1",
                                     "json",
                                     $jsonEncodedData);

     // Render the chart
     $columnChart->render();

     // Close the database connection
     $mysqli->close();
 }


 ?>

 <div id="chart-1"><!-- Fusion Charts will render here--></div>

</body>

</html>



<style>
 body {
     color: #666666;
     font-family:"Arial", "Helvetica";
     font-size: 12px;
 }
 .grayBorder {
     border: 1px solid #CCCCCC;
     margin: 3px;
     float: left;
 }
 .fontBold {
     font-weight: bold;
     font-size: 14px;
     vertical-align: top;
     text-align:right;
 }
 .fontBoldSmall {
     font-weight: bold;
     font-size: 12px;
     background-color: #EEEEEE;
     text-align:center;
 }
 .valueFont {
     padding: 3px;
 }
 #tableView {
     width:500px;
     display:none;
     margin-left:0px;
     max-height: 250px;
     overflow:scroll;
 }
</style>

