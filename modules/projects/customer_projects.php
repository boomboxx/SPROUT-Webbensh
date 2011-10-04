<?php

// Get all customer from database
$mysqlConfig = new SWB_Config_Mysql();
$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
$pdoConnect->setUtf8();


// Get customer data
$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);
$pdoQuery->setQuery("SELECT * FROM module_projects_customer WHERE id=:cid");
$pdoQuery->bindInteger('cid', $_REQUEST['customerId']);
$results = $pdoQuery->fetchAll();
$smarty->assign('customer', $results[0]);

// Get projects for customer
$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);
$pdoQuery->setQuery("SELECT * FROM module_projects_projects WHERE customerId=:cid");
$pdoQuery->bindInteger('cid', $_REQUEST['customerId']);
$projects = $pdoQuery->fetchAll();

foreach($projects as $k => $v) {
	
	// Get user and add to array
	$manager = SWB_User_User::getUserById($v['managerUserId']);
	$projects[$k]['manager'] = $manager;
	
	$setup = SWB_User_User::getUserById($v['setupUserId']);
	$projects[$k]['setup'] = $setup;	
	
}

$smarty->assign('projects', $projects);