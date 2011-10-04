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
	$getValues[urldecode($getArray[0])] = utf8_encode($getArray[1]); 
	
}

$mysqlConfig = new SWB_Config_Mysql();
$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
$pdoConnect->setUtf8();
$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);

// Insert customer to DB

$pdoQuery->setQuery('INSERT INTO module_projects_projects
	(customerId, jobnumber, title, setupUserId, active) 
	VALUES (:cid, :jnumber, :title, :userid, :active)');
$pdoQuery->bindInteger('cid', $getValues['projectCustomerId']);
$pdoQuery->bindString('jnumber', $getValues['projectJobnumber']);
$pdoQuery->bindString('title', $getValues['projectTitle']);
$pdoQuery->bindInteger('userid', $getValues['projectUserId']);
$pdoQuery->bindInteger('active', 1);
$pdoResult = $pdoQuery->insert();

if ($pdoResult) {
	
	$insertId = $pdoConnect->getInsertId();
	
	$jsonArray['projectId']=$insertId;
	$jsonArray['projectTitle']=$getValues['projectTitle'];

	echo json_encode($jsonArray);
	
} else {
	
	echo 'e';
	
}