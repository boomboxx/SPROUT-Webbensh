<?php

// Get all customer from database
$mysqlConfig = new SWB_Config_Mysql();
$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);
$pdoConnect->setUtf8();


// Task speichern
if (isset($_POST['taskSubmit'])) {
	
	/*var_dump ($_POST);
	echo "<br />";
	var_dump($_SESSION);*/
	
	// Date modifications
	$dateCreatedArray = explode('.', $_POST['taskDateCreated']);
	$dateCreated = $dateCreatedArray[2].'-'.$dateCreatedArray[1].'.'.$dateCreatedArray[0];
	
	$dateDoneArray = explode('.', $_POST['taskDateDone']);
	$dateDone = $dateDoneArray[2].'-'.$dateDoneArray[1].'.'.$dateDoneArray[0];	
	
	
	$taskNew = false;
	$qryString = '';
	if (!isset($_POST['taskId']) && empty($_POST['taskId'])) {
		
		$taskNew = true;
		$qryString = 'INSERT INTO module_projects_tasks 
			(projectId,categoryId,title,notice,stateId,dateCreated,dateDone,hours,assignedUserId,setupUserId) 
			VALUES (:pid,:cid,:title,:notice,:state,:datecreated,:datedone,:hours,:assignedUid,:setupUid)';
		
		$pdoQuery->setQuery($qryString);
		$pdoQuery->bindInteger('pid', $_POST['projectId']);
		$pdoQuery->bindInteger('cid', $_POST['taskCategoryId']);
		$pdoQuery->bindString('title', $_POST['taskTitle']);
		$pdoQuery->bindString('notice', $_POST['taskNotice']);
		$pdoQuery->bindInteger('state', 1);
		$pdoQuery->bindString('datecreated', $dateCreated);
		$pdoQuery->bindString('datedone', $dateDone);
		$pdoQuery->bindInteger('hours', $_POST['taskHours']);
		$pdoQuery->bindInteger('assignedUid', $_POST['taskAssignedUserId']);
		$pdoQuery->bindInteger('setupUid', $_SESSION['userId']);
		
		$pdoResult = $pdoQuery->insert();
		
	} 
	
}

// Get customer data
$pdoQuery->setQuery("SELECT * FROM module_projects_customer WHERE id=:cid");
$pdoQuery->bindInteger('cid', $_REQUEST['customerId']);
$results = $pdoQuery->fetchAll();
$smarty->assign('customer', $results[0]);

// Get project
$pdoQuery->setQuery("SELECT * FROM module_projects_projects WHERE id=:pid");
$pdoQuery->bindInteger('pid', $_REQUEST['projectId']);
$projects = $pdoQuery->fetchAll();
foreach($projects as $k => $v) {
	
	// Get user and add to array
	$manager = SWB_User_User::getUserById($v['managerUserId']);
	$projects[$k]['manager'] = $manager;
	
	$setup = SWB_User_User::getUserById($v['setupUserId']);
	$projects[$k]['setup'] = $setup;	
	
}
$smarty->assign('project', $projects[0]);

// Get tasks
$pdoQuery->setQuery("SELECT * FROM module_projects_tasks WHERE projectId=:pid");
$pdoQuery->bindInteger('pid', $_REQUEST['projectId']);
$tasks = $pdoQuery->fetchAll();

foreach($tasks as $k => $v) {
	
	// Get user and add to array
	$assignedUser = SWB_User_User::getUserById($v['assignedUserId']);
	$tasks[$k]['assignedUser'] = $assignedUser;
	
	$setupUser = SWB_User_User::getUserById($v['setupUserId']);
	$tasks[$k]['setupUser'] = $setupUser;	
	
	// Get category
	$pdoQuery->setQuery("SELECT title FROM module_projects_tasks_categories WHERE id=:cid");
	$pdoQuery->bindInteger('cid', $tasks[$k]['categoryId']);
	$categoryData = $pdoQuery->fetchAll();
	$tasks[$k]['categoryTitle'] = $categoryData[0]['title'];	
	
}

$smarty->assign('tasks', $tasks);

// Get available categories
$pdoQuery->setQuery("SELECT * FROM module_projects_tasks_categories ORDER BY title ASC");
$categoriesArray = $pdoQuery->fetchAll();
foreach($categoriesArray as $k => $v) {
	
	// Get user and add to array
	$categories[$k]['id'] = $categoriesArray[$k]['id'];
	$categories[$k]['title'] = utf8_encode($categoriesArray[$k]['title']);

}

$smarty->assign('categories', $categories);

// Get available user
$pdoQuery->setQuery("SELECT * FROM swb_user WHERE active=1 ORDER BY surname ASC");
$userArray = $pdoQuery->fetchAll();
foreach($userArray as $k => $v) {
	
	// Get user and add to array
	$userlist[$k]['id'] = $userArray[$k]['id'];
	$userlist[$k]['name'] = utf8_encode($userArray[$k]['surname'].', '.$userArray[$k]['name']);

}

$smarty->assign('userlist', $userlist);

// Get available states
$pdoQuery->setQuery("SELECT * FROM  module_projects_tasks_states");
$statesArray = $pdoQuery->fetchAll();
foreach($statesArray as $k => $v) {
	
	// Get user and add to array
	$keyToUse = $statesArray[$k]['id'];
	$states[$keyToUse]['id'] = $statesArray[$k]['id'];
	$states[$keyToUse]['title'] = utf8_encode($statesArray[$k]['title']);

}

$smarty->assign('states', $states);

// Budget procents
$pdoQuery->setQuery("SELECT SUM(hours) AS hoursum FROM  module_projects_tasks WHERE projectId=:pid");
$pdoQuery->bindInteger('pid', $projects[0]['id']);
$result = $pdoQuery->fetchAll();
$sumHours = $result[0]['hoursum'];
$percent = (($sumHours*50) * 100)/$projects[0]['budget'];
$percent = intval($percent);

// Percentage; pro percent 4px
$smarty->assign('percent',$percent);
$smarty->assign('usedSum',intval($sumHours*50));
$smarty->assign('percentRed',$percent*4);
$smarty->assign('percentGreen',(100-$percent)*4);

// Date today
$smarty->assign('dateToday', date('d.m.Y'));