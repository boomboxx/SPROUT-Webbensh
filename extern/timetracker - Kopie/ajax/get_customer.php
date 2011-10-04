<?php
session_start();
$jsonArray = array();
include('../../../libs/autoloader.php');

$mysqlConfig = new SWB_Config_Mysql();
$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);

// Insert customer to DB

$pdoQuery->setQuery('
	SELECT id, title 
	FROM module_projects_customer
	WHERE active = 1
	ORDER BY title ASC
');
$pdoResult = $pdoQuery->fetchAll();
if ($pdoResult) {

	foreach ($pdoResult as $k => $v) {
		
		$jsonArray[$k]['id']=$pdoResult[$k]['id'];
		$jsonArray[$k]['title']=utf8_encode($pdoResult[$k]['title']);		
		
	}

	echo json_encode($jsonArray);
	
} else {
	
	echo 'e';
	
}