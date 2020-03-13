<?php

$xmlstring = '﻿<?xml version="1.0" encoding="utf-8"?>
<database name ="bachelorproject_db">
  <table Name="Department">
    <Columns>
      <Column Name="DepartmentId" DataType="int" />
      <Column Name="CompanyId" DataType="int" />
      <Column Name="Department_Description" DataType="text" />
      <Column Name="Department_Key" DataType="varchar" />
      <Column Name="Department_Label" DataType="varchar" />
      <Column Name="Department_Name" DataType="varchar" />
    </Columns>
  </table>
  <table Name="Company">
    <Columns>
      <Column Name="CompanyId" DataType="int" />
      <Column Name="Company_Name" DataType="varchar" />
      <Column Name="Company_DirectionIn" DataType="boolean" />
      <Column Name="Company_DirectionOut" DataType="boolean" />
      <Column Name="Company_Phone" DataType="varchar" />
      <Column Name="Company_Label" DataType="varchar" />
      <Column Name="Company_Slogan" DataType="varchar" />
    </Columns>
  </table>
  <table Name="Person">
    <Columns>
      <Column Name="PersonId" DataType="int" />
      <Column Name="Person_Address1" DataType="varchar" />
      <Column Name="Person_Address2" DataType="varchar" />
      <Column Name="Person_Address3" DataType="varchar" />
      <Column Name="Person_Address4" DataType="varchar" />
      <Column Name="Person_Address5" DataType="varchar" />
      <Column Name="Person_Name" DataType="varchar" />
      <Column Name="Person_BirthDate" DataType="datetime" />
      <Column Name="EmployeeId" DataType="int" />
      <Column Name="Person_Class" DataType="varchar" />
      <Column Name="Person_Description" DataType="text" />
      <Column Name="Person_Gender" DataType="varchar" />
      <Column Name="Person_LastName" DataType="varchar" />
      <Column Name="LookupItem_CountryId" DataType="guid" />
      <Column Name="Person_FullName" DataType="varchar" />
      <Column Name="Person_Phone" DataType="varchar" />
      <Column Name="Person_FavoritePizza" DataType="varchar" />
      <Column Name="Person_CustomFields" DataType="varchar" />
      <Column Name="DefaultCompanyId" DataType="guid" />
      <Column Name="Person_FavoritePasta" DataType="varchar" />
      <Column Name="Person_Division" DataType="varchar" />
      <Column Name="Person_Email" DataType="varchar" />
      <Column Name="Person_Rating" DataType="varchar" />
      <Column Name="Person_Reference" DataType="varchar" />
      <Column Name="Person_FaxNumber" DataType="varchar" />
      <Column Name="Person_FirstName2" DataType="varchar" />
      <Column Name="StoneBricksID" DataType="guid" />
      <Column Name="Person_Group" DataType="varchar" />
      <Column Name="Person_GroupCode" DataType="varchar" />
      <Column Name="Person_HasData" DataType="boolean" />
      <Column Name="Person_String" DataType="varchar" />
      <Column Name="Person_FavoriteInstrument" DataType="varchar" />
      <Column Name="myAccountId1" DataType="guid" />
      <Column Name="myAccountId2" DataType="guid" />
      <Column Name="Person_InternalCode" DataType="varchar" />
      <Column Name="Person_HasParty" DataType="boolean" />
      <Column Name="Person_IsCompany" DataType="boolean" />
      <Column Name="Person_IsPhilosopher" DataType="boolean" />
      <Column Name="Person_HasCompany" DataType="boolean" />
      <Column Name="Person_IsSupplier" DataType="boolean" />
      <Column Name="Person_HasIssues" DataType="boolean" />
      <Column Name="Person_IsNaturalPerson" DataType="boolean" />
      <Column Name="Person_IsPerson" DataType="boolean" />
      <Column Name="Person_IsProfessional" DataType="boolean" />
      <Column Name="Person_IsReseller" DataType="boolean" />
      <Column Name="Person_IsTaxPayer" DataType="boolean" />
      <Column Name="Person_LastName2" DataType="varchar" />
      <Column Name="Person_LEIA" DataType="varchar" />
      <Column Name="Person_FavoriteMOvie" DataType="varchar" />
      <Column Name="Person_MiddleNames" DataType="varchar" />
      <Column Name="Person_Migration" DataType="varchar" />
      <Column Name="Person_LaundryRisk" DataType="varchar" />
      <Column Name="Person_PassportNumber" DataType="varchar" />
      <Column Name="Person_PersonalNumber" DataType="varchar" />
      <Column Name="Person_PhoneHome" DataType="varchar" />
      <Column Name="Person_PhoneMobile" DataType="varchar" />
      <Column Name="Person_PhoneWork" DataType="varchar" />
      <Column Name="Person_PostageAddressAttention" DataType="varchar" />
      <Column Name="Person_PostageAddressCity" DataType="varchar" />
      <Column Name="Person_PostageAddressCO" DataType="varchar" />
      <Column Name="PostageAddressCountryId" DataType="guid" />
      <Column Name="Person_PostageAddressDepartment" DataType="varchar" />
      <Column Name="Person_PostageAddressStreet" DataType="varchar" />
      <Column Name="Person_PostageAddressZip" DataType="varchar" />
      <Column Name="Person_Brokernode" DataType="varchar" />
      <Column Name="Person_Opinions" DataType="varchar" />
      <Column Name="Person_MovieComment" DataType="varchar" />
      <Column Name="Person_CreditCardCode" DataType="varchar" />
      <Column Name="Person_FavoriteDrink" DataType="varchar" />
      <Column Name="Person_PepsiStatus" DataType="int" />
      <Column Name="Person_PrintStatus" DataType="int" />
      <Column Name="Person_PrintStatusTimeStamp" DataType="datetime" />
      <Column Name="Person_PrintStatusTimeStampString" DataType="varchar" />
      <Column Name="Person_RatingAgency" DataType="varchar" />
      <Column Name="ResellerId" DataType="guid" />
      <Column Name="Person_Section" DataType="varchar" />
      <Column Name="Person_Sector" DataType="varchar" />
      <Column Name="Person_Signing" DataType="varchar" />
      <Column Name="Person_Taxi" DataType="guid" />
      <Column Name="Person_KnowledgeLevel" DataType="varchar" />
      <Column Name="CountryId2" DataType="guid" />
      <Column Name="Person_Id2" DataType="varchar" />
      <Column Name="Person_IdType" DataType="varchar" />
      <Column Name="Person_ManualHandling" DataType="boolean" />
      <Column Name="InstanceId" DataType="guid" />
    </Columns>
  </table>
  <table Name="Product">
    <Columns>
      <Column Name="ProductId" DataType="int" />
      <Column Name="ManagerId" DataType="guid" />
      <Column Name="AdministratorId" DataType="guid" />
      <Column Name="Product_Interval" DataType="int" />
      <Column Name="CompanyId" DataType="int" />
      <Column Name="AdjustedId" DataType="guid" />
      <Column Name="Product_Comment" DataType="varchar" />
      <Column Name="Product_Country" DataType="guid" />
      <Column Name="Currency" DataType="varchar" />
      <Column Name="Product_Type" DataType="varchar" />
      <Column Name="Product_DescriptionString" DataType="text" />
      <Column Name="Product_EndDate" DataType="datetime" />
      <Column Name="Product_ExternalReference" DataType="varchar" />
      <Column Name="Product_Price" DataType="decimal" />
      <Column Name="Product_Interests" DataType="varchar" />
      <Column Name="Product_Category" DataType="varchar" />
      <Column Name="Product_CommissionPrice" DataType="decimal" />
      <Column Name="Product_SupplierId" DataType="guid" />
      <Column Name="productTypeId" DataType="int" />
      <Column Name="Product_Rating" DataType="decimal" />
      <Column Name="Product_Key" DataType="varchar" />
      <Column Name="Product_Max" DataType="varchar" />
      <Column Name="Product_Name" DataType="varchar" />
      <Column Name="Product_Price2" DataType="decimal" />
      <Column Name="Product_Parameters" DataType="varchar" />
      <Column Name="Product_NoticeLevel" DataType="int" />
      <Column Name="Product_Premium" DataType="varchar" />
      <Column Name="Product_Product" DataType="varchar" />
      <Column Name="Product_Version" DataType="varchar" />
      <Column Name="Product_Level" DataType="decimal" />
      <Column Name="Product_ApprovedDate" DataType="datetime" />
      <Column Name="ResellerId" DataType="guid" />
      <Column Name="Product_Retention" DataType="decimal" />
      <Column Name="Product_Rule1" DataType="decimal" />
      <Column Name="Product_Rule2" DataType="decimal" />
      <Column Name="Product_Rule3" DataType="decimal" />
      <Column Name="Product_Method" DataType="varchar" />
      <Column Name="Product_StartDate" DataType="datetime" />
      <Column Name="Product_Status" DataType="int" />
      <Column Name="Product_StatusString" DataType="varchar" />
      <Column Name="Product_PhoneNo" DataType="varchar" />
      <Column Name="Product_URL" DataType="varchar" />
	  <Column Name="ProductTypeId" DataType="int" />
    </Columns>
  </table>
  <table Name="ProductType">
    <Columns>
      <Column Name="ProductTypeId" DataType="int" />
      <Column Name="ProductType_DescriptionString" DataType="text" />
      <Column Name="ProductType_KeySellingPoint" DataType="varchar" />
      <Column Name="ProductType_Label" DataType="varchar" />
      <Column Name="ProductType_Name" DataType="varchar" />
      <Column Name="ProductType_Status" DataType="int" />
    </Columns>
  </table>
</database> ';

$xml = simplexml_load_string($xmlstring, "SimpleXMLElement", LIBXML_NOCDATA);
$json = json_encode($xml);
$array = json_decode($json,TRUE);


$array = $array['table'];

foreach ($array as $key => $key_value) {
  echo "<p>";
  $tableScript = "CREATE TABLE ";
  $tableName = $key_value["@attributes"];
  $tableName = $tableName['Name'];
  $tableScript .= $tableName . " ( ";

  printf("-------");
  print_r($tableName);
  printf("-------");

  $columns = $key_value['Columns']['Column'];

  foreach ($columns as $type => $val) {
    echo "<br>";
    $val = $val['@attributes'];
    $columnName = $val['Name'];
    $dataType = $val['DataType'];
    $comment = "";

    $length = NULL;

    switch ($dataType) {
      case 'int':
        $length = 11;
        break;
      case 'varchar':
        $length = 50;
        break;
      case 'guid':
        $dataType = 'varchar';
        $length = 32;
        $comment = "COMMENT 'guid'";
        break;
      case 'decimal':
        $length = "10,2";
        break;
    }

    // if there is no length
    if(is_null($length)){
      $tableScript .= " " . $columnName . " " .  $dataType . " NOT NULL" .  $comment . ",";
    } else {
      $tableScript .= " " . $columnName . " " .  $dataType . "(".$length.") NOT NULL " . $comment . ",";
    }


    echo "columnName: " , $columnName , " and dataType is: " , $dataType;
    echo "<br>";
  }

  //$tableScript = rtrim($tableScript, ',');

  $tableScript .= " );";
  echo "<br>";
  echo $tableScript;
  echo "</p>";
}
//print_r($formatted);



 ?>
