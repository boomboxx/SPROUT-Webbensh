<?php
include('../../../libs/autoloader.php');
$jsonArray = array();
// Get projects for customer
//$_GET['cid']=2;
//echo $_GET['cid']."<br /><br />";
$mysqlConfig = new SWB_Config_Mysql();
$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);
$pdoQuery->setQuery("
	SELECT id, jobnumber, title
	FROM module_projects_projects
	WHERE customerId = :cid AND active = 1
	ORDER BY jobnumber ASC
");
$pdoQuery->bindInteger('cid', $_GET['cid']);
$pdoResult = $pdoQuery->fetchAll();
foreach ($pdoResult as $k => $v) {
	
	$jsonArray[$k]['id']=$pdoResult[$k]['id'];
	$jsonArray[$k]['title']=utf8_encode($pdoResult[$k]['title']);
	$jsonArray[$k]['jobnumber']=utf8_encode($pdoResult[$k]['jobnumber']);			
	
}
echo json_encode($jsonArray);
