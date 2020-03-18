<?php

error_reporting(1);

function Quartile($Array, $Quartile) {
  $array = sort($Array);
  $pos = (count($Array) - 1) * $Quartile;

  $base = floor($pos);
  $rest = $pos - $base;

  if( isset($Array[$base+1]) ) {
    return $Array[$base] + $rest * ($Array[$base+1] - $Array[$base]);
  } else {
    return $Array[$base];
  }
}

function Average($array){
  return (floor(array_sum($array)/count($array)*100))/100;
}

$pdo = new PDO('mysql:host=localhost;dbname=logdb', "root", "");
// should be 18
for ($testcaseNo=1; $testcaseNo <= 18; $testcaseNo++) {

  set_time_limit(500);

  $testCase = "TestCase".$testcaseNo;

  // should be 6
  for ($dbApi=1; $dbApi <=6 ; $dbApi++) {

    switch ($dbApi) {
      case 1:
      $API = "GRAPHQL";
      $dbName = "Mongo";
      break;
      case 2:
      $API = "REST";
      $dbName = "Mongo";
      break;
      case 3:
      $API = "SOAP";
      $dbName = "Mongo";
      break;
      case 4:
      $API = "GRAPHQL";
      $dbName = "MySql";
      break;
      case 5:
      $API = "REST";
      $dbName = "MySql";
      break;
      case 6:
      $API = "SOAP";
      $dbName = "MySql";
      break;
      default:
      // random default values, shouldn't happen.
      $API = "GRAPHQL";
      $dbName = "Mongo";
      break;
    }

    $timeOpenSum = [];
    $timeCloseSum = [];
    $timeAvgSum = [];
    $timeMedianSum = [];

    $requestSizeOpenSum = [];
    $requestSizeCloseSum = [];
    $requestSizeAvgSum = [];
    $requestSizeMedianSum = [];

    $responseSizeOpenSum = [];
    $responseSizeCloseSum = [];
    $responseSizeAvgSum = [];
    $responseSizeMedianSum = [];

    $totalSizeOpenSum = [];
    $totalSizeCloseSum = [];
    $totalSizeAvgSum = [];
    $totalSizeMedianSum = [];

    // should be 10
    for ($executionNum=1; $executionNum <= 10 ; $executionNum++) {


        $stmt = $pdo->prepare("SELECT totalTime,requestContentSize,responseContentSize
           FROM resultdatalog WHERE executionNO=:execNO
           AND testCase=:testId AND api=:API AND dbName=:dbName");

        $stmt->bindParam(":execNO",$executionNum, PDO::PARAM_INT);
        $stmt->bindParam(":testId",$testCase);
        $stmt->bindParam(":API",$API);
        $stmt->bindParam(":dbName",$dbName);
        $stmt->execute();

        $responseTime = [];
        $requestSize = [];
        $responseSize = [];
        $totalSize = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          array_push($responseTime,$row['totalTime']);
          array_push($requestSize,$row['requestContentSize']);
          array_push($responseSize,$row['responseContentSize']);
          array_push($totalSize,($row['requestContentSize']+$row['responseContentSize']));
        }
        /*
        echo $testCase, " :",$executionNum, " " , $API, " ", $dbName, " counts: " , count($responseTime), " - " , count($requestSize), " - " ,count($responseSize), " - " , count($totalSize);
        echo "<br>";
        */

        $timeOpen = Quartile($responseTime,0.25);
        $timeClose = Quartile($responseTime,0.75);
        $timeMin = min($responseTime);
        $timeMax = max($responseTime);
        $timeAvg = Average($responseTime);
        $timeMedian = Quartile($responseTime,0.50);

        // Push values into sum array.
        array_push($timeOpenSum,$timeOpen);
        array_push($timeCloseSum,$timeClose);
        array_push($timeAvgSum,$timeAvg);
        array_push($timeMedianSum,$timeMedian);


        $requestSizeOpen = Quartile($requestSize,0.25);
        $requestSizeClose = Quartile($requestSize,0.75);
        $requestSizeMin = min($requestSize);
        $requestSizeMax = max($requestSize);
        $requestSizeAvg = Average($requestSize);
        $requestSizeMedian = Quartile($requestSize,0.50);

        // Push values into sum array.
        array_push($requestSizeOpenSum,$requestSizeOpen);
        array_push($requestSizeCloseSum,$requestSizeClose);
        array_push($requestSizeAvgSum,$requestSizeAvg);
        array_push($requestSizeMedianSum,$requestSizeMedian);

        $responseSizeOpen = Quartile($responseSize,0.25);
        $responseSizeClose = Quartile($responseSize,0.75);
        $responseSizeMin = min($responseSize);
        $responseSizeMax = max($responseSize);
        $responseSizeAvg = Average($responseSize);
        $responseSizeMedian = Quartile($responseSize,0.50);

        // Push values into sum array.
        array_push($responseSizeOpenSum,$responseSizeOpen);
        array_push($responseSizeCloseSum,$responseSizeClose);
        array_push($responseSizeAvgSum,$responseSizeAvg);
        array_push($responseSizeMedianSum,$responseSizeMedian);

        $totalSizeOpen = Quartile($totalSize,0.25);
        $totalSizeClose = Quartile($totalSize,0.75);
        $totalSizeMin = min($totalSize);
        $totalSizeMax = max($totalSize);
        $totalSizeAvg = Average($totalSize);
        $totalSizeMedian = Quartile($totalSize,0.50);

        // Push values into sum array.
        array_push($totalSizeOpenSum,$totalSizeOpen);
        array_push($totalSizeCloseSum,$totalSizeClose);
        array_push($totalSizeAvgSum,$totalSizeAvg);
        array_push($totalSizeMedianSum,$totalSizeMedian);

        $insert = $pdo->prepare("INSERT INTO resultstatistics
          (executionNo, api, dbName, testCase, timeOpen, timeClose, timeMin, timeMax, timeAvg,
          requestSizeOpen,  requestSizeClose ,  requestSizeMin ,  requestSizeMax , requestSizeAvg,
          responseSizeOpen ,  responseSizeClose ,  responseSizeMin ,  responseSizeMax , responseSizeAvg,
          totalSizeOpen ,  totalSizeClose ,  totalSizeMin ,  totalSizeMax, totalSizeAvg )
          VALUES (:executionNo, :api ,  :dbName ,  :testCase ,
              :timeOpen ,  :timeClose ,  :timeMin ,  :timeMax , :timeAvg,
              :requestSizeOpen ,  :requestSizeClose ,  :requestSizeMin ,  :requestSizeMax , :requestSizeAvg,
              :responseSizeOpen ,  :responseSizeClose ,  :responseSizeMin ,  :responseSizeMax , :responseSizeAvg,
              :totalSizeOpen ,  :totalSizeClose ,  :totalSizeMin ,  :totalSizeMax, :totalSizeAvg )");
        $insert->bindParam(":executionNo",$executionNum);
        $insert->bindParam(":api",$API);
        $insert->bindParam(":dbName",$dbName);
        $insert->bindParam(":testCase",$testCase);
        $insert->bindParam(":timeOpen",$timeOpen);
        $insert->bindParam(":timeClose",$timeClose);
        $insert->bindParam(":timeMin",$timeMin);
        $insert->bindParam(":timeMax",$timeMax);
        $insert->bindParam(":timeAvg",$timeAvg);
        $insert->bindParam(":requestSizeOpen",$requestSizeOpen);
        $insert->bindParam(":requestSizeClose",$requestSizeClose);
        $insert->bindParam(":requestSizeMin",$requestSizeMin);
        $insert->bindParam(":requestSizeMax",$requestSizeMax);
        $insert->bindParam(":requestSizeAvg",$requestSizeAvg);
        $insert->bindParam(":responseSizeOpen",$responseSizeOpen);
        $insert->bindParam(":responseSizeClose",$responseSizeClose);
        $insert->bindParam(":responseSizeMin",$responseSizeMin);
        $insert->bindParam(":responseSizeMax",$responseSizeMax);
        $insert->bindParam(":responseSizeAvg",$responseSizeAvg);
        $insert->bindParam(":totalSizeOpen",$totalSizeOpen);
        $insert->bindParam(":totalSizeClose",$totalSizeClose);
        $insert->bindParam(":totalSizeMin",$totalSizeMin);
        $insert->bindParam(":totalSizeMax",$totalSizeMax);
        $insert->bindParam(":totalSizeAvg",$totalSizeAvg);
        $insert->execute();
    }

    /*
    echo "<br> **** ";
    echo $testCase, " :" , $API, " ", $dbName, " counts: " , count($timeAvgSum), " - " , count($timeOpenSum), " - " ,count($timeCloseSum);
    echo "<br>";
    */

    $timeMinTot = min($timeAvgSum);
    $timeOpenTot = Quartile($timeAvgSum,0.25);
    $timeCloseTot = Quartile($timeAvgSum,0.75);
    $timeMaxTot = max($timeAvgSum);

    $requestSizeMinTot = min($requestSizeAvgSum);
    $requestSizeOpenTot = Quartile($requestSizeAvgSum,0.25);
    $requestSizeCloseTot = Quartile($requestSizeAvgSum,0.75);
    $requestSizeMaxTot = max($requestSizeAvgSum);

    $responseSizeMinTot = min($responseSizeAvgSum);
    $responseSizeOpenTot = Quartile($responseSizeAvgSum,0.25);
    $responseSizeCloseTot = Quartile($responseSizeAvgSum,0.75);
    $responseSizeMaxTot = max($responseSizeAvgSum);

    $totalSizeMinTot = min($totalSizeAvgSum);
    $totalSizeOpenTot = Quartile($totalSizeAvgSum,0.25);
    $totalSizeCloseTot = Quartile($totalSizeAvgSum,0.75);
    $totalSizeMaxTot = max($totalSizeAvgSum);

    $insertFinal = $pdo->prepare("INSERT INTO resultfinal
      (api, dbName, testCase,
          timeMin, timeOpen, timeClose,  timeMax,
          requestSizeMin , requestSizeOpen,  requestSizeClose , requestSizeMax ,
          responseSizeMin ,  responseSizeOpen ,  responseSizeClose ,  responseSizeMax ,
          totalSizeOpen ,  totalSizeClose ,  totalSizeMin ,  totalSizeMax)
      VALUES (:api ,  :dbName ,  :testCase ,
          :timeMin , :timeOpen ,  :timeClose , :timeMax ,
          :requestSizeMin , :requestSizeOpen ,  :requestSizeClose , :requestSizeMax ,
          :responseSizeMin ,  :responseSizeOpen ,  :responseSizeClose ,  :responseSizeMax ,
          :totalSizeMin ,  :totalSizeOpen ,  :totalSizeClose ,  :totalSizeMax )");
      $insertFinal->bindParam(":api",$API);
      $insertFinal->bindParam(":dbName",$dbName);
      $insertFinal->bindParam(":testCase",$testCase);
      $insertFinal->bindParam(":timeMin",$timeMinTot);
      $insertFinal->bindParam(":timeOpen",$timeOpenTot);
      $insertFinal->bindParam(":timeClose",$timeCloseTot);
      $insertFinal->bindParam(":timeMax",$timeMaxTot);
      $insertFinal->bindParam(":requestSizeMin",$requestSizeMinTot);
      $insertFinal->bindParam(":requestSizeOpen",$requestSizeOpenTot);
      $insertFinal->bindParam(":requestSizeClose",$requestSizeCloseTot);
      $insertFinal->bindParam(":requestSizeMax",$requestSizeMaxTot);
      $insertFinal->bindParam(":responseSizeMin",$responseSizeMinTot);
      $insertFinal->bindParam(":responseSizeOpen",$responseSizeOpenTot);
      $insertFinal->bindParam(":responseSizeClose",$responseSizeCloseTot);
      $insertFinal->bindParam(":responseSizeMax",$responseSizeMaxTot);
      $insertFinal->bindParam(":totalSizeMin",$totalSizeMinTot);
      $insertFinal->bindParam(":totalSizeOpen",$totalSizeOpenTot);
      $insertFinal->bindParam(":totalSizeClose",$totalSizeCloseTot);
      $insertFinal->bindParam(":totalSizeMax",$totalSizeMaxTot);
      $insertFinal->execute();
      //$insertFinal->debugDumpParams();

      //Some prints and stuff
      $timeAvgTotal = Average($timeAvgSum);
      $timeMedianTotal = Quartile($timeMedianSum,0.5);

      $requestSizeAvgTotal = Average($requestSizeAvgSum);
      $requestSizeMedianTotal = Quartile($requestSizeMedianSum,0.5);

      $responseSizeAvgTotal = Average($responseSizeAvgSum);
      $responseSizeMedianTotal = Quartile($responseSizeMedianSum,0.5);

      $totalSizeAvgTotal = Average($totalSizeAvgSum);
      $totalSizeMedianTotal = Quartile($totalSizeMedianSum,0.5);

      echo $API . ";" . $dbName . ";" . $testCase . ";" . $timeAvgTotal . ";" .
            $timeMedianTotal . ";" . $requestSizeAvgTotal . ";" .
            $requestSizeMedianTotal . ";" . $responseSizeAvgTotal . ";" .
            $responseSizeMedianTotal . ";" . $totalSizeAvgTotal . ";" .
            $totalSizeMedianTotal;
      echo "<br>";

    // after exect loop
  }
  // after param loop
}
// after testcase loop

?>
