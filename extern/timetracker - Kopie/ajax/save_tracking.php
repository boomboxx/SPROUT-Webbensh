<?php
session_start();
error_reporting(E_ALL);

include('../../../libs/autoloader.php');
// Get projects for customer
//$_GET['cid']=2;
//echo $_GET['cid']."<br /><br />";
$getValues = array();
$getStrings = explode('&', $_SERVER['QUERY_STRING']);
foreach ($getStrings as $getString) {
	
	$getArray = explode('=',$getString);
	$getValues[urldecode($getArray[0])] = $getArray[1]; 
	
}

//var_dump($getValues);

// Set date for now
$dateTime = new DateTime("now", new DateTimeZone('Europe/Berlin'));
$dtNow =  $dateTime->format("Y-m-d H:i:s");

// Calculate hours
$hours = $getValues['unitsNeeded']*0.25;

$mysqlConfig = new SWB_Config_Mysql();
//var_dump($mysqlConfig);
$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);

// Set column for hours in array
$hoursColumns = array(

	'std' => 'hoursUsed',
	'ob' => 'hoursOB'

);

//echo "<br /><br />".$hoursColumns[$getValues['trackRate']]."<br />";

$pdoQuery->setQuery('INSERT INTO module_projects_projects_tracking
	(projectId, categoryId, moment, '.$hoursColumns[$getValues['trackRate']].', notice) 
	VALUES (:pid,:cid,:moment,:hours,:notice)');
$pdoQuery->bindInteger('pid', $getValues['pid']);
$pdoQuery->bindInteger('cid', $getValues['catid']);
//$pdoQuery->bindInteger('uid', $_SESSION['userId']);
$pdoQuery->bindString('moment', "".$dtNow."");
$pdoQuery->bindString('hours', "".$hours."");
$pdoQuery->bindString('notice', "".$getValues['trackText']."");
$pdoResult = $pdoQuery->insert();

if ($pdoResult) {
	
	echo 'k';
	
} else {
	
	echo 'e';
	
}