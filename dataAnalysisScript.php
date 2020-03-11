<?php

// doesn't seem to work, gave a percentile below min.
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
  $stmt = $pdo->prepare("SELECT totalTime,requestContentSize,responseContentSize FROM resultdatalog WHERE executionNO=:execNO AND testCase=:testId AND api=:API AND dbName=:dbName");

  $execVar = 1;
  $testCase = "TestCase1";
  $API = "GRAPHQL";
  $dbName = "Mongo";

  $stmt->bindParam(":execNO",$execVar, PDO::PARAM_INT);
  $stmt->bindParam(":testId",$testCase);
  $stmt->bindParam(":API",$API);
  $stmt->bindParam(":dbName",$dbName);
  $stmt->execute();

  $responseTime = [];
  $requestSize = [];
  $responseSize = [];
  $totalSize = [];
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    array_push($result,$row['totalTime']);
    array_push($result,$row['requestContentSize']);
    array_push($result,$row['responseContentSize']);
    array_push($result,$row['requestContentSize']+$row['responseContentSize']);
}


  echo "<p>";
  /*
  foreach ($result as $key) {
    echo "$key <br>";
  }
  */
  //print_r($result);
  echo "</p>";

  $open = Quartile($responseTime,0.25);
  $close = Quartile($responseTime,0.75);

  echo "<p>";
  print_r($open);
  echo "<br>";
  print_r($close);
  echo "</p>";

  /*

    SELECT totalTime FROM resultdatalog WHERE executionNO=:execNO AND testCase=:testId AND api=:API;

    api = GRAPHQL
    testCase = TestCase1
    executionNO = 1
  */

?>
