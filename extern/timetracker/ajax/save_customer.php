<?php
session_start();
$jsonArray = array();
include('../../../libs/autoloader.php');
// Get projects for customer
//$_GET['cid']=2;
//echo $_GET['cid']."<br /><br />";
$getValues = array();
$getStrings = explode('&', $_SERVER['QUERY_STRING']);
foreach ($getStrings as $getString) {
	
	$getArray = explode('=',$getString);
	$getValues[urldecode($getArray[0])] = urldecode($getArray[1]); 
	
}

$mysqlConfig = new SWB_Config_Mysql();
$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);

// Insert customer to DB

$pdoQuery->setQuery('INSERT INTO module_projects_customer
	(title, active, notes) 
	VALUES (:title,:active,:notes)');
$pdoQuery->bindString('title', $getValues['customerTitle']);
$pdoQuery->bindInteger('active', 1);
$pdoQuery->bindString('notes', 'tracker added');
$pdoResult = $pdoQuery->insert();

if ($pdoResult) {
	
	$insertId = $pdoConnect->getInsertId();
	
	$jsonArray['customerId']=$insertId;
	$jsonArray['customerTitle']=$getValues['customerTitle'];

	echo json_encode($jsonArray);
	
} else {
	
	echo 'e';
	
}