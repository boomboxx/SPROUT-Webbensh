<?php
// Get all customer from database
$mysqlConfig = new SWB_Config_Mysql();
$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
$pdoConnect->setUtf8();
$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);
$pdoQuery->setQuery("SELECT * FROM module_projects_customer");
$results = $pdoQuery->fetchAll();
$smarty->assign('results', $results);