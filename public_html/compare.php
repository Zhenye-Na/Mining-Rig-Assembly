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
  <title>Charts XT - Data from a database</title>
  <!-- <link  rel="stylesheet" type="text/css" href="css/style.css" /> -->

      <!-- You need to include the following JS file to render the chart.
      When you make your own charts, make sure that the path to this JS file is correct.
      Else, you will get JavaScript errors. -->

      <script src="includes/fusioncharts.js"></script>
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
      $cpuQuery = "SELECT name, speed
                   FROM cpu
                   WHERE name = (SELECT cpu_name
                                 FROM includes
                                 WHERE setID = (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))
                   UNION
                   SELECT price
                   FROM components
                   WHERE name = (SELECT cpu_name
                                 FROM includes
                                 WHERE setID = (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))";

      // gpu query -> gpu_name, price, lock
      $gpuQuery = "SELECT name, lock
                   FROM gpu
                   WHERE name = (SELECT gpu_name
                                 FROM includes
                                 WHERE setID = (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))
                   UNION
                   SELECT price
                   FROM components
                   WHERE name = (SELECT gpu_name
                                 FROM includes
                                 WHERE setID = (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))";

      // mb query -> mb_name, price
      $mbQuery = "SELECT name, price
                   FROM components
                   WHERE name = (SELECT mb_name
                                 FROM includes
                                 WHERE setID = (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))";


      // psu query -> name, power, price
      $psuQuery = "SELECT name, power
                   FROM psu
                   WHERE name = (SELECT psu_name
                                 FROM includes
                                 WHERE setID = (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))
                   UNION
                   SELECT price
                   FROM components
                   WHERE name = (SELECT psu_name
                                 FROM includes
                                 WHERE setID = (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))";


      // ram query -> name, price, size
      $ramQuery = "SELECT name, size
                   FROM ram
                   WHERE name = (SELECT ram_name
                                 FROM includes
                                 WHERE setID = (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))
                   UNION
                   SELECT price
                   FROM components
                   WHERE name = (SELECT ram_name
                                 FROM includes
                                 WHERE setID = (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))";

      // Execute the query, or else return the error message.

      // $result = $mysqli->query($strQuery) or exit("Error code ({$mysqli->errno}): {$mysqli->error}");

      // $result = mysqli_query($mysqli, $strQuery) or exit("Error code ({$mysqli->errno}): {$mysqli->error}");

      $result = mysqli_query($mysqli, $cpuQuery) or exit("Error code ({$mysqli->errno}): {$mysqli->error}");

      // If the query returns a valid response, prepare the JSON string
      if ($result) {
        // The `$arrData` array holds the chart attributes and data
        $arrData = array(
            "chart" => array(
              "caption" => "Comparation between your Setups | Parts",
              "showValues" => "0",
              "theme" => "zune"

              // "paletteColors" => "#0075c2",
              // "bgColor" => "#ffffff",
              // "borderAlpha"=> "20",
              // "canvasBorderAlpha"=> "0",
              // "usePlotGradientColor"=> "0",
              // "plotBorderAlpha"=> "10",
              // "showXAxisLine"=> "1",
              // "xAxisLineColor" => "#999999",
              // "showValues" => "0",
              // "divlineColor" => "#999999",
              // "divLineIsDashed" => "1",
              // "showAlternateHGridColor" => "0"
          )
        );

        $arrData["data"] = array();

        // Push the data into the array

        // while($row = mysqli_fetch_array($result)) {
        //  array_push($arrData["data"], array(
        //   "label" => $row["cpu_name"],
        //   "value" => $row["gpu_name"]
        // )

         while($row = mysqli_fetch_array($result)) {
           array_push($arrData["data"], array(
            "label" => $row["name"],
            "value" => $row["speed"]
            "value" => $row["price"]

          )
     );
     }

      $arrData["categories"]=array(array("category"=>$categoryArray));
      // creating dataset object
      $arrData["dataset"] = array(array("seriesName"=> "Actual Revenue", "data"=>$dataseries1), array("seriesName"=> "Projected Revenue",  "renderAs"=>"line", "data"=>$dataseries2),array("seriesName"=> "Profit",  "renderAs"=>"area", "data"=>$dataseries3));


     /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

     $jsonEncodedData = json_encode($arrData);

     /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

     $columnChart = new FusionCharts("column2D", "myFirstChart" , 600, 300, "chart-1", "json", $jsonEncodedData);

     // Render the chart
     $columnChart->render();

     // Close the database connection
     $mysqli->close();
 }

 ?>

 <div id="chart-1"><!-- Fusion Charts will render here--></div>

</body>

</html>





