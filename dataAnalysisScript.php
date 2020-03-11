<?php

set_time_limit(500);
error_reporting(0);

function Quartile($Array, $Quartile) {
  sort($Array);
  $pos = (count($Array) - 1) * $Quartile;

  $base = floor($pos);
  $rest = $pos - $base;

  if( isset($Array[$base+1]) ) {
    return $Array[$base] + $rest * ($Array[$base+1] - $Array[$base]);
  } else {
    return $Array[$base];
  }
}

$pdo = new PDO('mysql:host=localhost;dbname=logdb', "root", "");
// should be 18
for ($testcaseNo=1; $testcaseNo <= 18 ; $testcaseNo++) {

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
    // should be 10
    echo "<p>";
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
        //echo $testCase, " :",$executionNum, " " , $API, " ", $dbName, " counts: " , count($responseTime), " - " , count($requestSize), " - " ,count($responseSize), " - " , count($totalSize);
        //echo "<br>";


        $timeOpen = Quartile($responseTime,0.25);
        $timeClose = Quartile($responseTime,0.75);
        $timeMin = min($responseTime);
        $timeMax = max($responseTime);

        $requestSizeOpen = Quartile($requestSize,0.25);
        $requestSizeClose = Quartile($requestSize,0.75);
        $requestSizeMin = min($requestSize);
        $requestSizeMax = max($requestSize);

        $responseSizeOpen = Quartile($responseSize,0.25);
        $responseSizeClose = Quartile($responseSize,0.75);
        $responseSizeMin = min($responseSize);
        $responseSizeMax = max($responseSize);

        $totalSizeOpen = Quartile($totalSize,0.25);
        $totalSizeClose = Quartile($totalSize,0.75);
        $totalSizeMin = min($totalSize);
        $totalSizeMax = max($totalSize);

        $insert = $pdo->prepare("INSERT INTO resultstatistics
          (executionNo, api, dbName, testCase, timeOpen, timeClose, timeMin, timeMax,
          requestSizeOpen,  requestSizeClose ,  requestSizeMin ,  requestSizeMax ,
          responseSizeOpen ,  responseSizeClose ,  responseSizeMin ,  responseSizeMax ,
          totalSizeOpen ,  totalSizeClose ,  totalSizeMin ,  totalSizeMax )
          VALUES (:executionNo, :api ,  :dbName ,  :testCase ,
              :timeOpen ,  :timeClose ,  :timeMin ,  :timeMax ,
              :requestSizeOpen ,  :requestSizeClose ,  :requestSizeMin ,  :requestSizeMax ,
              :responseSizeOpen ,  :responseSizeClose ,  :responseSizeMin ,  :responseSizeMax ,
              :totalSizeOpen ,  :totalSizeClose ,  :totalSizeMin ,  :totalSizeMax )");
        $insert->bindParam(":executionNo",$executionNum);
        $insert->bindParam(":api",$API);
        $insert->bindParam(":dbName",$dbName);
        $insert->bindParam(":testCase",$testCase);
        $insert->bindParam(":timeOpen",$timeOpen);
        $insert->bindParam(":timeClose",$timeClose);
        $insert->bindParam(":timeMin",$timeMin);
        $insert->bindParam(":timeMax",$timeMax);
        $insert->bindParam(":requestSizeOpen",$requestSizeOpen);
        $insert->bindParam(":requestSizeClose",$requestSizeClose);
        $insert->bindParam(":requestSizeMin",$requestSizeMin);
        $insert->bindParam(":requestSizeMax",$requestSizeMax);
        $insert->bindParam(":responseSizeOpen",$responseSizeOpen);
        $insert->bindParam(":responseSizeClose",$responseSizeClose);
        $insert->bindParam(":responseSizeMin",$responseSizeMin);
        $insert->bindParam(":responseSizeMax",$responseSizeMax);
        $insert->bindParam(":totalSizeOpen",$totalSizeOpen);
        $insert->bindParam(":totalSizeClose",$totalSizeClose);
        $insert->bindParam(":totalSizeMin",$totalSizeMin);
        $insert->bindParam(":totalSizeMax",$totalSizeMax);
        $insert->execute();
    }
    // after exect loop
    echo "</p>";
  }
  // after param loop
}
// after testcase loop

?>
