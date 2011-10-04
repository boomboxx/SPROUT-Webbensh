<?php
error_reporting(E_ALL);
session_start();
include('../../libs/autoloader.php');
$errorFound = false;
$queryAdd = '';

$mysqlConfig = new SWB_Config_Mysql();
$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);

// Add customer
if (isset($_POST['submitCustomerAdd'])) {
	
	// Check if fields contain data
	if (empty($_POST['customerTitle']) || empty($_POST['customerShort'])) {
		
		$_SESSION['messageText'] = 'Kürzel und Titel müssen eingegeben werden';
		$_SESSION['messageType'] = 'failed';
		$errorFound = true;
		
	}
	
	// Check if customer allready exists (by acronym)
	$pdoQuery->setQuery('
		SELECT * 
		FROM module_projects_customer
		WHERE LOWER(acronym) LIKE :acronym
	');
	$pdoQuery->bindString('acronym', strtolower('%'.$_POST['customerShort']));
	$pdoResult = $pdoQuery->fetchAll();	
	if ($pdoResult) {
		$_SESSION['messageText'] = 'Dieser Kunde existiert bereits';
		$_SESSION['messageType'] = 'failed';
		$errorFound = true;		
	}	
	
	
	// No error actions
	if (!$errorFound) {
		
		$pdoQuery->setQuery('
			INSERT INTO module_projects_customer
			(acronym,title, active, notes) 
			VALUES (:acronym,:title,:active,:notes)
		');
		$pdoQuery->bindString('acronym', $_POST['customerShort']);
		$pdoQuery->bindString('title', $_POST['customerTitle']);
		$pdoQuery->bindInteger('active', 1);
		$pdoQuery->bindString('notes', 'tracker added');
		$pdoResult = $pdoQuery->insert();		
		
		$_SESSION['messageText'] = 'Kunde erfolgreich angelegt';
		$_SESSION['messageType'] = 'passed';
		$queryAdd .= '?cid='.$pdoConnect->getInsertId();
		
	}
	
}	

// Add project
if (isset($_POST['submitProjectAdd'])) {
	
	// Check if fields contain data
	if (empty($_POST['projectTitle'])) {
		
		$_SESSION['messageText'] = 'Es wurde kein Projektitel angegeben';
		$_SESSION['messageType'] = 'failed';
		$errorFound = true;
		
	}
	
	if (empty($_POST['projectJobnumber'])) {
		
		$_SESSION['messageText'] = 'Es wurde keine Jobnummer angegeben';
		$_SESSION['messageType'] = 'failed';
		$errorFound = true;
		
	}	
	
	if (empty($_POST['projectCustomerId'])) {
		
		$_SESSION['messageText'] = 'Es wurde keine Kunden-ID angegeben';
		$_SESSION['messageType'] = 'failed';
		$errorFound = true;
		
	}		
	
	if (empty($_POST['projectUserId'])) {
		
		$_SESSION['messageText'] = 'Es wurde kein Projekt-User angegeben';
		$_SESSION['messageType'] = 'failed';
		$errorFound = true;
		
	}		
	
	// Unallowed characters in budget field
	if (!preg_match('/^[0-9\,]+/', $_POST['projectBudget'])) {
		
		$_SESSION['messageText'] = 'Bitte nur 0-9 und Komma im Budget verwenden';
		$_SESSION['messageType'] = 'failed';
		$errorFound = true;		
		
	}
	
	// Check if project allready exists (by jobnumber)
	$pdoQuery->setQuery('
		SELECT * 
		FROM module_projects_projects
		WHERE SUBSTRING(REPLACE(jobnumber, " ",""),1,10) LIKE :jnumber
	');
	$pdoQuery->bindString('jnumber', '%'.substr(str_replace(' ','',$_POST['projectJobnumber']),0,10));
	$pdoResult = $pdoQuery->fetchAll();	
	if ($pdoResult) {
		$_SESSION['messageText'] = 'Dieses Projekt existiert bereits';
		$_SESSION['messageType'] = 'failed';
		$errorFound = true;		
	}		
	
	// No error actions
	if (!$errorFound) {
		
		// Format budget
		$budgetArray = explode(',', $_POST['projectBudget']);
		$budget = $budgetArray[0];
		if (count($budgetArray) > 1) {
			$budget = $budgetArray[0].'.'.$budgetArray[1];
		}
		
		//var_dump($budget); die();
		
		$pdoQuery->setQuery('
			INSERT INTO module_projects_projects
			(customerId, jobnumber, title, setupUserId, active, budget, charging_default) 
			VALUES (:cid, :jnumber, :title, :userid, :active, :budget, :charging)
		');
		$pdoQuery->bindInteger('cid', $_POST['projectCustomerId']);
		$pdoQuery->bindString('jnumber', $_POST['projectJobnumber']);
		$pdoQuery->bindString('title', $_POST['projectTitle']);
		$pdoQuery->bindInteger('userid', $_POST['projectUserId']);
		$pdoQuery->bindString('budget', $budget);
		$pdoQuery->bindString('charging',  $_POST['projectCalcType']);
		$pdoQuery->bindInteger('active', 1);
		$pdoResult = $pdoQuery->insert();	
		
		$_SESSION['messageText'] = 'Projekt erfolgreich angelegt';
		$_SESSION['messageType'] = 'passed';	
		$queryAdd .= '?pid='.$pdoConnect->getInsertId().'&cid='.$_REQUEST['projectCustomerId'];
		
	}
	
}	

// Save tracking
if (!empty($_POST['trackText']) && isset($_REQUEST['cid']) && isset($_REQUEST['pid'])) {
	
	// Set date for now
	$dateTime = new DateTime("now", new DateTimeZone('Europe/Berlin'));
	$dtNow =  $dateTime->format("Y-m-d H:i:s");

	// Calculate hours
	$hours = $_POST['unitsNeeded']*0.25;	
	
	// Set column for hours in array
	$hoursColumns = array(

		'std' => 'hoursUsed',
		'ob' => 'hoursOB'

	);
	
	$pdoQuery->setQuery('INSERT INTO module_projects_projects_tracking
		(projectId, categoryId, moment, userId, '.$hoursColumns[$_POST['trackRate']].', nettoSeconds, notice) 
		VALUES (:pid,:cid,:moment,:uid,:hours,:nettoseconds,:notice)');
	$pdoQuery->bindInteger('pid', $_POST['pid']);
	$pdoQuery->bindInteger('cid', $_POST['catid']);
	$pdoQuery->bindInteger('uid', $_SESSION['userId']);
	$pdoQuery->bindString('moment', $dtNow);
	$pdoQuery->bindString('hours', $hours);
	$pdoQuery->bindInteger('nettoseconds', $_POST['nettoSeconds']);
	$pdoQuery->bindString('notice', trim($_POST['trackText']));
	$pdoResult = $pdoQuery->insert();
	
	if ($pdoResult) {
		
		$_SESSION['messageText'] = 'Tracking erfolgreich erfasst';
		$_SESSION['messageType'] = 'passed';			
		
	} else {
		
		$_SESSION['messageText'] = 'Fehler beim Speichern in der Datenbank';
		$_SESSION['messageType'] = 'failed';			
		
	}
	
}

// Redirect to tracker
header('location: tracker.php'.$queryAdd);