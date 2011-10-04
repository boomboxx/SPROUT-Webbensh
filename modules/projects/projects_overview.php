<?php
// Get all projects from database
$mysqlConfig = new SWB_Config_Mysql();
$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
$pdoConnect->setUtf8();
$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);
$pdoQuery->setQuery("
	SELECT pro.id, pro.jobnumber, pro.customerId, pro.managerUserId
		(
		SELECT title 
		FROM module_projects_customer
		WHERE id = pro.customerId
		) AS customerTitle,
		(
		SELECT CONCAT (surname,", ",name) 
		FROM swb_user
		WHERE id = pro.managerUserId
		) AS managerName		
	FROM module_projects_projects AS pro
	");
$results = $pdoQuery->fetchAll();
var_dump($results);
$smarty->assign('projects', $results);