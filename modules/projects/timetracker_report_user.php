<?php

class Module_Data {
	
	protected $mysqlConfig = null;
	protected $pdoConnect = null;
	protected $pdoQuery = null;
	protected $userActive = array();
	
	public function __construct() {
		
		$this->mysqlConfig = new SWB_Config_Mysql();
		$this->pdoConnect = new SWB_Mysql_PDOConnect($this->mysqlConfig);
		$this->pdoConnect->setUtf8();
		$this->pdoQuery = new SWB_Mysql_PDOQuery($this->pdoConnect);
		
	}
	
	public function getActiveProjectsAndCustomer() {
		
		$this->pdoQuery->setQuery("
			SELECT mp.id AS projectid, mp.jobnumber, mp.title AS jobtitle, mc.id AS customerid, mc.title AS customertitle, mc.acronym
			FROM module_projects_projects AS mp, module_projects_customer AS mc 
			WHERE mp.customerId = mc.id
			ORDER BY mc.acronym ASC, mp.jobnumber
		");		
		return $this->pdoQuery->fetchAll();
		
	}
	
	public function getCategories() {
		
		$this->pdoQuery->setQuery("
			SELECT id, title
			FROM module_projects_tasks_categories 
			ORDER BY title ASC
		");		
		return $this->pdoQuery->fetchAll();		
		
	}
	
	/**
	 * @return array of SWB_User_User
	 */
	public function getActiveUsers() {
		
		$users = SWB_User_User::getActiveUsers('surname');
		return $users;
		
	}
	
	/**
	 * @param int $userId
	 * @return array of trackings
	 */
	public function getTrackingsByUserId($userId) {
		
		$this->pdoQuery->setQuery("
			SELECT id, projectId, categoryId, userId, moment, hoursUsed, hoursKV, hoursOB, nettoSeconds, notice 
			FROM module_projects_projects_tracking 
			WHERE userId=:userid AND moment LIKE :lookupdate
			ORDER BY moment ASC
		");
		$this->pdoQuery->bindInteger('userid', $userId);
		$this->pdoQuery->bindString('lookupdate', $this->getLookupDate().'%');
		$trackings = $this->pdoQuery->fetchAll();
		return $trackings;
		
	}
	
	/**
	 * @param int $userId
	 * @return sum of trackings
	 */
	public function getTrackingSumStd($userId) {
		
		$this->pdoQuery->setQuery("SELECT SUM(hoursUsed) AS sumHoursUsed  FROM module_projects_projects_tracking WHERE userId=:userid AND moment LIKE :lookupdate");
		$this->pdoQuery->bindInteger('userid', $userId);
		$this->pdoQuery->bindString('lookupdate', $this->getLookupDate().'%');
		$hours = $this->pdoQuery->fetchAll();
		return $hours[0]['sumHoursUsed'];
		
	}	
	
	/**
	 * @param int $userId
	 * @return sum of trackings
	 */
	public function getTrackingSumOb($userId) {
		
		$this->pdoQuery->setQuery("SELECT SUM(hoursOB) AS sumHoursUsed  FROM module_projects_projects_tracking WHERE userId=:userid AND moment LIKE :lookupdate");
		$this->pdoQuery->bindInteger('userid', $userId);
		$this->pdoQuery->bindString('lookupdate', $this->getLookupDate().'%');
		$hours = $this->pdoQuery->fetchAll();
		return $hours[0]['sumHoursUsed'];
		
	}		
	
	/**
	 * @param int $userId
	 * @return sum of trackings
	 */
	public function getTrackingSumKv($userId) {
		
		$this->pdoQuery->setQuery("SELECT SUM(hoursKV) AS sumHoursUsed  FROM module_projects_projects_tracking WHERE userId=:userid AND moment LIKE :lookupdate");
		$this->pdoQuery->bindInteger('userid', $userId);
		$this->pdoQuery->bindString('lookupdate', $this->getLookupDate().'%');
		$hours = $this->pdoQuery->fetchAll();
		return $hours[0]['sumHoursUsed'];
		
	}		
	
	/**
	 * @param int $userId
	 * @return sum of trackings
	 */
	public function getTrackingSumSecondsNetto($userId) {
		
		$this->pdoQuery->setQuery("SELECT SUM(nettoSeconds) AS sumHoursUsed  FROM module_projects_projects_tracking WHERE userId=:userid AND moment LIKE :lookupdate");
		$this->pdoQuery->bindInteger('userid', $userId);
		$this->pdoQuery->bindString('lookupdate', $this->getLookupDate().'%');
		$hours = $this->pdoQuery->fetchAll();
		return round(($hours[0]['sumHoursUsed']/3600),2);
		
	}		
	
	/**
	 * @param int $customerId
	 * @return array $customer
	 */
	public function getCustomerById($customerId) {
		$this->pdoQuery->setQuery("SELECT * FROM module_projects_customer WHERE id=:cid");
		$this->pdoQuery->bindInteger('cid', $customerId);
		$customer = $this->pdoQuery->fetchAll();
		return $customer[0];
	}
	
	/**
	 * @param int $categoryId
	 * @return array $category
	 */
	public function getCategoryById($categoryId) {
		$this->pdoQuery->setQuery("SELECT * FROM module_projects_tasks_categories WHERE id=:cid");
		$this->pdoQuery->bindInteger('cid', $categoryId);
		$category = $this->pdoQuery->fetchAll();
		return $category[0];
	}	
	
	/**
	 * @param int $projectId
	 * @return array $project
	 */
	public function getProjectById($projectId) {
		$this->pdoQuery->setQuery("SELECT * FROM module_projects_projects WHERE id=:pid");
		$this->pdoQuery->bindInteger('pid', $projectId);
		$project = $this->pdoQuery->fetchAll();
		return $project[0];
	}	
	
	public function getLookupDate() {
		
		if (isset($_REQUEST['trackerreportDateSumbit'])) {
			
			$arrayDate = explode('.', $_REQUEST['trackreportUserDate']);
			return $arrayDate[2].'-'.$arrayDate[1].'-'.$arrayDate[0];
			
		}
		
		return date('Y-m-d');
		
	}
	
	public function getDateToday() {
		
		return date('d.m.Y');
		
	}	
	
	public function getNettoSecondsFormatted($seconds) {

		return round(($seconds/3600),2);		
		
	}
	
	public function getHoursAndMinutesByNettoSeconds($nettoSeconds) {
		
		$returnValue['hours'] = intval($nettoSeconds/3600);
		$returnValue['minutes'] = ($nettoSeconds-($returnValue['hours']*3600))/60;		
		
		return $returnValue;
		
	}
	
	public function addEntry() {
		
		// Check fields
		$errorFound = false;
		$errorText = '<strong>Fehler bei der Eingabe der Daten:</strong><br /><br />';
		
		if (empty($_POST['trackingAddHoursHours']) && empty($_POST['trackingAddHoursMinutes'])) {
			
			$errorText .= 'Keine Stunden/Minuten angegeben';
			$errorFound = true;
			
		}
		
		if (!$errorFound) {
		
			// Calculate netto seconds
			$nettoSeconds = ($_POST['trackingAddHoursHours']*3600) + ($_POST['trackingAddHoursMinutes']*60);
			
			// Calculate quarter hours/units
			$hoursUsed = 0;
			if ($_POST['trackingAddHoursMinutes'] >= 0 && $_POST['trackingAddHoursMinutes'] <= 15) { $hoursUsed+=0.25; }
			if ($_POST['trackingAddHoursMinutes'] >= 16 && $_POST['trackingAddHoursMinutes'] <= 30) { $hoursUsed+=0.5; }
			if ($_POST['trackingAddHoursMinutes'] >= 31 && $_POST['trackingAddHoursMinutes'] <= 45) { $hoursUsed+=0.75; }
			if ($_POST['trackingAddHoursMinutes'] >= 46 && $_POST['trackingAddHoursMinutes'] <= 60) { $hoursUsed+=1; }
			$hoursUsed += $_POST['trackingAddHoursHours'];
			
			// Hours field
			$hoursFields = array(
			
				'std' => 'hoursUsed',
				'ob' => 'hoursOB',
				'kv' => 'hoursKV'
			
			);
			
			// DateTime
			$momentArray = explode('.', $_POST['trackreportUserDate']);
			$momentArray = array_reverse($momentArray);
			$moment = implode('-', $momentArray);
			$moment .= ' 21:00:00';
			
			$this->pdoQuery->setQuery('
				INSERT INTO module_projects_projects_tracking
				(projectId, categoryId, userId, moment, '.$hoursFields[$_POST['trackingAddType']].', nettoSeconds, notice) 
				VALUES (:projectid, :categoryid, :userid, :moment, :hourscalc, :nettoseconds, :notice)
			');
			$this->pdoQuery->bindInteger('projectid', $_POST['trackingAddCustomerId']);
			$this->pdoQuery->bindInteger('categoryid', $_POST['trackingAddCategoryId']);
			$this->pdoQuery->bindInteger('userid', $_SESSION['userId']);
			$this->pdoQuery->bindString('moment', $moment);
			$this->pdoQuery->bindString('hourscalc', $hoursUsed);
			$this->pdoQuery->bindInteger('nettoseconds', $nettoSeconds);
			$this->pdoQuery->bindString('notice', $_POST['trackingAddComment']);
			$pdoResult = $this->pdoQuery->insert();	
			
			if ($pdoResult) {
				
				$_SESSION['systemMessageText'] = 'Tracking wurde erfolgreich erfasst';
				$_SESSION['systemMessageType'] = 'passed';
				
			} else {
				
				$_SESSION['systemMessageText'] = 'Fehler beim Speichern in der Datenbank';
				$_SESSION['systemMessageType'] = 'failed';			
				
			}
		
		} else {
			
			$_SESSION['systemMessageText'] = $errorText;
			$_SESSION['systemMessageType'] = 'failed';			
			
		}
		
		$_POST = array();
		
	}
	
	public function editEntry() {
		
		// Check fields
		$errorFound = false;
		$errorText = '<strong>Fehler bei der Eingabe der Daten:</strong><br /><br />';
		
		if (empty($_POST['trackingEditHoursHours']) && empty($_POST['trackingEditHoursMinutes'])) {
			
			$errorText .= 'Keine Stunden/Minuten angegeben';
			$errorFound = true;
			
		}
		
		if (!$errorFound) {
		
			// Calculate netto seconds
			$nettoSeconds = ($_POST['trackingEditHoursHours']*3600) + ($_POST['trackingEditHoursMinutes']*60);
			
			// Calculate quarter hours/units
			$hoursUsed = 0;
			if ($_POST['trackingEditHoursMinutes'] >= 0 && $_POST['trackingEditHoursMinutes'] <= 15) { $hoursUsed+=0.25; }
			if ($_POST['trackingEditHoursMinutes'] >= 16 && $_POST['trackingEditHoursMinutes'] <= 30) { $hoursUsed+=0.5; }
			if ($_POST['trackingEditHoursMinutes'] >= 31 && $_POST['trackingEditHoursMinutes'] <= 45) { $hoursUsed+=0.75; }
			if ($_POST['trackingEditHoursMinutes'] >= 46 && $_POST['trackingEditHoursMinutes'] <= 60) { $hoursUsed+=1; }
			$hoursUsed += $_POST['trackingEditHoursHours'];
			
			// Hours field
			$hoursFields = array(
			
				'std' => 'hoursUsed',
				'ob' => 'hoursOB',
				'kv' => 'hoursKV'
			
			);
			$test = '
				UPDATE module_projects_projects_tracking
				SET projectId = :projectid, categoryId = :categoryid, '.$hoursFields[$_POST['trackingEditType']].' = :hourscalc, nettoSeconds = :nettoseconds, notice = :notice
				WHERE id = :trackingid
			';
			
			// Set all hours to 0
			$this->pdoQuery->setQuery('
				UPDATE module_projects_projects_tracking
				SET hoursUsed = 0, hoursOB = 0, hoursKV = 0
				WHERE id = :trackingid
			');
			$this->pdoQuery->bindInteger('trackingid', $_POST['trackingEditId']);
			$pdoResult = $this->pdoQuery->execute();				
			
			$this->pdoQuery->setQuery('
				UPDATE module_projects_projects_tracking
				SET projectId = :projectid, categoryId = :categoryid, '.$hoursFields[$_POST['trackingEditType']].' = :hourscalc, nettoSeconds = :nettoseconds, notice = :notice
				WHERE id = :trackingid
			');
			$this->pdoQuery->bindInteger('projectid', $_POST['trackingEditCustomerId']);
			$this->pdoQuery->bindInteger('categoryid', $_POST['trackingEditCategoryId']);
			$this->pdoQuery->bindString('hourscalc', $hoursUsed);
			$this->pdoQuery->bindInteger('nettoseconds', $nettoSeconds);
			$this->pdoQuery->bindString('notice', $_POST['trackingEditComment']);
			$this->pdoQuery->bindInteger('trackingid', $_POST['trackingEditId']);
			$pdoResult = $this->pdoQuery->execute();	
			
			if ($pdoResult) {
				
				$_SESSION['systemMessageText'] = 'Tracking wurde erfolgreich geändert';
				$_SESSION['systemMessageType'] = 'passed';
				
			} else {
				
				$_SESSION['systemMessageText'] = 'Fehler beim Speichern in der Datenbank';
				$_SESSION['systemMessageType'] = 'failed';			
				
			}
		
		} else {
			
			$_SESSION['systemMessageText'] = $errorText;
			$_SESSION['systemMessageType'] = 'failed';			
			
		}
		
		$_POST = array();
		
	}	
	
	public function deleteEntry() {
		
		$this->pdoQuery->setQuery('
			DELETE FROM module_projects_projects_tracking
			WHERE id = :trackingid
		');
		$this->pdoQuery->bindInteger('trackingid', $_GET['trackDelete']);
		$pdoResult = $this->pdoQuery->execute();		

		if ($pdoResult) {
			
			$_SESSION['systemMessageText'] = 'Tracking wurde erfolgreich gelöscht';
			$_SESSION['systemMessageType'] = 'passed';
			
		} else {
			
			$_SESSION['systemMessageText'] = 'Fehler beim Löschen in der Datenbank';
			$_SESSION['systemMessageType'] = 'failed';			
			
		}		
		
	}
	
}

$module = new Module_Data();

if (isset($_POST['trackingAddSubmit'])) {
	
	$module->addEntry();
	
}

if (isset($_POST['trackingEditSubmit'])) {
	
	$module->editEntry();
	
}

if (isset($_GET['trackDelete'])) {
	
	$module->deleteEntry();
	
}

$smarty->assign('module', $module);

