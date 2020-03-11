<?php
set_time_limit(500);
$list = ['person.json','company.json','department.json','product.json','producttype.json'];
//$list = ['company.json'];
$path = "D:\dev\Databasedata\wbexport";

foreach ($list as $key) {
  //var_dump($key);
  $filecontent = file_get_contents($path."\\".$key);
  $filecontent = str_replace("[","",$filecontent);
  $filecontent = str_replace("]","",$filecontent);
  $fileArray = explode("}",$filecontent);
  //var_dump($fileArray);
  $firstRow = explode("{",$fileArray[2]);
  $firstRow = $firstRow[2];
  /*
  echo "<p>";
  echo "<h1>1</h1>";
  echo "</p>";
  */
  $firstRow = "{" . $firstRow . "}";
  //$firstRow = json_decode($firstRow,true);
  //var_dump($firstRow);
  file_put_contents($path."\\Fixed".$key, $firstRow.PHP_EOL);
  for ($i=3; $i <= sizeof($fileArray)-3; $i++) {
    /*
    echo "<p>";
    echo "<h1>".$i."</h1>";
    */
    $currRow = $fileArray[$i] . "}";
    $currRow = substr($currRow,1);
    $currRow = trim($currRow);
    $currRow = $currRow.PHP_EOL;
    //var_dump($currRow);
    file_put_contents($path."\\Fixed".$key, $currRow, FILE_APPEND);
    //echo "</p>";
  }
}

?>
