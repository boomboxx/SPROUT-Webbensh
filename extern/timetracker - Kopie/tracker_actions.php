<?php
error_reporting(E_ALL);
session_start();
include('../../libs/autoloader.php');
$errorFound = false;

$mysqlConfig = new SWB_Config_Mysql();
$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);

// Add customer
if (isset($_POST['submitCustomerAdd'])) {
	
	// Check fields
	if (empty($_POST['customerTitle'])) {
		
		$_SESSION['messageText'] = 'Es wurde kein Kunde angegeben';
		$_SESSION['messageType'] = 'failed';
		$errorFound = true;
		
	}
	
	// No error actions
	if (!$errorFound) {
		
		$pdoQuery->setQuery('
			INSERT INTO module_projects_customer
			(title, active, notes) 
			VALUES (:title,:active,:notes)
		');
		$pdoQuery->bindString('title', $_POST['customerTitle']);
		$pdoQuery->bindInteger('active', 1);
		$pdoQuery->bindString('notes', 'tracker added');
		$pdoResult = $pdoQuery->insert();		
		
		$_SESSION['messageText'] = 'Kunde erfolgreich angelegt';
		$_SESSION['messageType'] = 'passed';		
		
	}
	
	
}	

// Add project
if (isset($_POST['submitProjectAdd'])) {
	
	// Check fields
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
	
	// No error actions
	if (!$errorFound) {
		
		$pdoQuery->setQuery('
			INSERT INTO module_projects_projects
			(customerId, jobnumber, title, setupUserId, active) 
			VALUES (:cid, :jnumber, :title, :userid, :active)
		');
		$pdoQuery->bindInteger('cid', $_POST['projectCustomerId']);
		$pdoQuery->bindString('jnumber', $_POST['projectJobnumber']);
		$pdoQuery->bindString('title', $_POST['projectTitle']);
		$pdoQuery->bindInteger('userid', $_POST['projectUserId']);
		$pdoQuery->bindInteger('active', 1);
		$pdoResult = $pdoQuery->insert();	
		
		$_SESSION['messageText'] = 'Projekt erfolgreich angelegt';
		$_SESSION['messageType'] = 'passed';		
		
	}
	
}	

// Redirect to tracker
header('location: tracker.php');