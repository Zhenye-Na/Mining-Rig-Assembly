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
      
      // $strQuery = "SELECT cpu_name, gpu_name, mb_name, psu_name, ram_name, subscript
      //              FROM includes
      //              WHERE setID = (SELECT setID
      //                             FROM creates
      //                             WHERE email = '$email')";

      // cpu query -> cpu_name, speed, price
      $cpuQuery = "SELECT ALL cpu.name as name, cpu.speed as speed, components.price as price
                   FROM creates
                   INNER JOIN includes ON creates.setID = includes.setID
                   INNER JOIN cpu ON includes.cpu_name = cpu.name
                   INNER JOIN components ON components.name = cpu.name
                   WHERE creates.email = '$email'";
      
      
      // gpu query -> gpu_name, clock, price
      $gpuQuery = "SELECT ALL gpu.name as name, gpu.clock as clock, components.price as price
                   FROM creates
                   INNER JOIN includes ON creates.setID = includes.setID
                   INNER JOIN gpu ON includes.gpu_name = gpu.name
                   INNER JOIN components ON components.name = gpu.name
                   WHERE creates.email = '$email'";

      // mb query -> mb_name, price
      $mbQuery = "SELECT name, price
                   FROM components
                   WHERE name IN (SELECT mb_name
                                 FROM includes
                                 WHERE setID IN (SELECT setID
                                                FROM creates
                                                WHERE email = '$email'))";


      // psu query -> name, price, power
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
      $resultgpu = mysqli_query($mysqli, $gpuQuery) or exit("Error code ({$mysqli->errno}): {$mysqli->error}");

      // If the query returns a valid response, prepare the JSON string
      
      // cpu
      
      if ($resultcpu) {
        // The `$arrData` array holds the chart attributes and data
        $arrData1 = array(
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
        
        $arrData1["data"] = array();
        $categoryArray1=array();
        $dataseries11=array();
        $dataseries21=array();
        // $dataseries3=array();

        // Push the data into the array

        // pushing category array values
        while($row = mysqli_fetch_array($resultcpu)) {
            //  echo $row["name"], $row["speed"], $row["price"], '\n';

            array_push($categoryArray1, array(
                "label" => $row["name"]
                )
            );
            
             array_push($dataseries11, array(
                "value" => $row["speed"]
                )
            );
            
            array_push($dataseries21, array(
                "value" => $row["price"]
                )
            );
            
            }


      $arrData1["categories"]=array(array("category"=>$categoryArray1));
      // creating dataset object
      $arrData1["dataset"] = array(
        array("seriesName"=> "Speed", "parentYAxis" => "S", "showValues"=> "0", "data"=>$dataseries11), 
        array("seriesName"=> "Price", "data"=>$dataseries21));


     /*JSON Encode the data to retrieve the string containing the JSON representation of the data in the array. */

     $jsonEncodedData1 = json_encode($arrData1);

     /*Create an object for the column chart using the FusionCharts PHP class constructor. Syntax for the constructor is ` FusionCharts("type of chart", "unique chart id", width of the chart, height of the chart, "div id to render the chart", "data format", "data source")`. Because we are using JSON data to render the chart, the data format will be `json`. The variable `$jsonEncodeData` holds all the JSON data for the chart, and will be passed as the value for the data source parameter of the constructor.*/

     $columnChartcpu = new FusionCharts("mscombidy2d",
                                        "chartId1",
                                        700,
                                        400,
                                        "chart-cpu",
                                        "json",
                                        $jsonEncodedData1);

     // Render the chart
     $columnChartcpu->render();
}

    // gpu

     if ($resultgpu) {

        $arrData2 = array(
            "chart" => array(
              "caption" => "Comparison between your selected GPUs",
              "showValues" => "1",
              "theme" => "fint",
              "pyaxisname"=> "Price",
              "syaxisname"=> "Clock",
              "xaxisname"=>"GPU",
              "numberPrefix"=> "$",

          )
        );

        // creating array for categories object
        
        $arrData2["data"] = array();
        $categoryArray2=array();
        $dataseries12=array();
        $dataseries22=array();
        // $dataseries3=array();

        // Push the data into the array

        // pushing category array values
        while($row = mysqli_fetch_array($resultgpu)) {
            //  echo $row["name"], $row["speed"], $row["price"], '\n';

            array_push($categoryArray2, array(
                "label" => $row["name"]
                )
            );
            
             array_push($dataseries12, array(
                "value" => $row["clock"]
                )
            );
            
            array_push($dataseries22, array(
                "value" => $row["price"]
                )
            );
            
            }


      $arrData2["categories"]=array(array("category"=>$categoryArray2));
      // creating dataset object
      $arrData2["dataset"] = array(
        array("seriesName"=> "Clock", "parentYAxis" => "S", "showValues"=> "0", "data"=>$dataseries12), 
        array("seriesName"=> "Price", "data"=>$dataseries22));


     $jsonEncodedData2 = json_encode($arrData2);

     $columnChartgpu = new FusionCharts("mscombidy2d",
                                        "chartId2",
                                        700,
                                        400,
                                        "chart-gpu",
                                        "json",
                                        $jsonEncodedData2);

     // Render the chart
     $columnChartgpu->render();
}





     // Close the database connection
     $mysqli->close();

 ?>

 <div id="chart-cpu" align="center"> </div>
 <br><br>
 <div id="chart-gpu" align="center"> </div>

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

