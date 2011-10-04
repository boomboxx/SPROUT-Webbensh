<?php

class Module_Data {
	
	protected $mysqlConfig 					= null;
	protected $pdoConnect 					= null;
	protected $pdoQuery 						= null;
	protected $trackings 						= null;
	protected $selectQuery 					= '';
	protected $selectQuerySums			= '';
	protected $whereArray					= array();
	protected $whereClause 				= '';
	protected $filterDates						= array();
	
	public function __construct() {
		
		$this->mysqlConfig = new SWB_Config_Mysql();
		$this->pdoConnect = new SWB_Mysql_PDOConnect($this->mysqlConfig);
		$this->pdoConnect->setUtf8();
		$this->pdoQuery = new SWB_Mysql_PDOQuery($this->pdoConnect);
		
		$this->getDates();
		
	}
	
	public function getDateToday() {
		
		return date('d.m.Y');
		
	}
	
	protected function getWhereClause() {
		
		// Re-init arrays
		$this->whereArray = array();
		$this->whereClause = '';
		
		// Customer
		if (isset($_REQUEST['filterCustomer']) && !empty($_REQUEST['filterCustomer'])) {
			
			$this->whereArray[] = array(
				'column' => 'customerId', 
				'marker' => 'customerId',
				'value' => $_REQUEST['filterCustomer']
			);
			
		}
		
		// Project
		if (isset($_REQUEST['filterProjects']) && !empty($_REQUEST['filterProjects'])) {
			
			$this->whereArray[] = array(
				'column' => 'projectId', 
				'marker' => 'projectId',
				'value' => $_REQUEST['filterProjects']
			);
			
		}
		
		// User
		if (isset($_REQUEST['filterUsers']) && !empty($_REQUEST['filterUsers'])) {
			
			$this->whereArray[] = array(
				'column' => 'userId', 
				'marker' => 'userId',
				'value' => $_REQUEST['filterUsers']
			);
			
		}		
		
		// Categories
		if (isset($_REQUEST['filterCategories']) && !empty($_REQUEST['filterCategories'])) {
			
			$this->whereArray[] = array(
				'column' => 'categoryId', 
				'marker' => 'categoryId',
				'value' => $_REQUEST['filterCategories']
			);
			
		}		
		
		// Date
		$this->whereClause = ' WHERE ';
		$this->whereClause .= 'moment >= "'.$this->filterDates['fromCalc'].'" AND moment <= "'.$this->filterDates['toCalc'].'"';		
		
		// Build WHERE-clause
		if (count($this->whereArray)) {
			
			foreach ($this->whereArray as $k => $v) {
				
				$andString = ' AND ';
				
				$this->whereClause .= $andString.$this->whereArray[$k]['column'].' = "'.$this->whereArray[$k]['value'].'"';
				
			}
			
		}
		
	}
	
	protected function getQuery() {
		
		$this->getWhereClause();
		$this->selectQuery = '
			SELECT 
				tasks.id AS taskId, 
				customer.acronym AS customerAcronym, 
				customer.title AS customerTitle, 
				customer.id AS customerId, 
				projects.jobnumber AS projectJobnumber, 
				projects.title AS projectTitle, 
				projects.id AS projectId, 
				tasks.moment AS moment, 
				users.surname, 
				users.name,	
				users.id AS userId,
				categories.title AS categoryTitle,
				categories.id AS categoryId,
				tasks.notice,
				tasks.hoursUsed,
				tasks.hoursOB,
				tasks.hoursKV,
				tasks.nettoSeconds
			
			FROM module_projects_projects_tracking AS tasks
			LEFT JOIN module_projects_projects AS projects
			ON tasks.projectId = projects.id
			LEFT JOIN module_projects_customer AS customer
			ON projects.customerId = customer.id
			LEFT JOIN module_projects_tasks_categories AS categories
			ON tasks.categoryId  = categories.id
			LEFT JOIN swb_user AS users
			ON tasks.userId = users.id
		';
		
		$this->selectQuery .= $this->whereClause;
		$this->selectQuery .= ' ORDER BY taskId ASC';
		
	}

    protected function getQuerySums() {
        
        $this->getWhereClause();
        $this->selectQuerySums = '
            SELECT 
                SUM(tasks.hoursUsed) AS sumUsed, 
                SUM(tasks.hoursOB) AS sumOB, 
                SUM(tasks.hoursKV) AS sumKV, 
                SUM(tasks.nettoSeconds)/3600 AS sumNettoSeconds
            FROM module_projects_projects_tracking AS tasks
            LEFT JOIN module_projects_projects AS projects
            ON tasks.projectId = projects.id
            LEFT JOIN module_projects_customer AS customer
            ON projects.customerId = customer.id
            LEFT JOIN module_projects_tasks_categories AS categories
            ON tasks.categoryId  = categories.id
            LEFT JOIN swb_user AS users
            ON tasks.userId = users.id
        ';
        
        $this->selectQuerySums .= $this->whereClause;
        $this->selectQuery .= ' ORDER BY taskId ASC';
        
    }
	
	public function getTrackings() {
		
		$this->getQuery();
		$this->pdoQuery->setQuery($this->selectQuery);		
		$trackings = $this->pdoQuery->fetchAll();
		return $trackings;
		
	}	
	
	public function getTrackingsSums() {
		
		$this->getQuerySums();
		$this->pdoQuery->setQuery($this->selectQuerySums);		
		$trackingsSums = $this->pdoQuery->fetchAll();
		return $trackingsSums[0];
		
	}	
	
	public function getProject($projectId) {
		
		$this->pdoQuery->setQuery("SELECT * FROM module_projects_projects WHERE id=:projectId");
		$this->pdoQuery->bindInteger('projectId', $projectId);		
		$results = $this->pdoQuery->fetchAll();
		return $results[0];
		
	}
	
	public function getCategory($categoryId) {
		
		$this->pdoQuery->setQuery("SELECT * FROM module_projects_tasks_categories WHERE id=:categoryId");
		$this->pdoQuery->bindInteger('categoryId', $categoryId);		
		$results = $this->pdoQuery->fetchAll();
		return $results[0];
		
	}
	
	public function getNettoSecondsFormatted($seconds) {

		return round(($seconds/3600),2);		
		
	}
	
	public function getNettoSecondsFormattedSum($seconds) {
		
		return round($seconds,2);
		
	}
	
	public function getUser($userId) {
		
		$user = SWB_User_User::getUserById($userId);
		return $user;
		
	}
	
	/**
	 * @return array of SWB_User_User
	 */
	public function getActiveUsers() {
		
		$users = SWB_User_User::getActiveUsers('surname');
		return $users;
		
	}	
	
	public function getDateFormatted($dateString) {
		
		$dtObject = new DateTime($dateString);
		return $dtObject->format('d.m.Y');
		
	}
	
	public function getCustomerList() {
		$this->pdoQuery->setQuery("SELECT * FROM module_projects_customer ORDER BY acronym ASC");
		$results = $this->pdoQuery->fetchAll();
		return $results;
	}
	
	public function getProjectsList() {
		$this->pdoQuery->setQuery("SELECT * FROM module_projects_projects ORDER BY jobnumber ASC");
		$results = $this->pdoQuery->fetchAll();
		return $results;
	}
	
	public function getCategoriesList() {
		$this->pdoQuery->setQuery("SELECT * FROM module_projects_tasks_categories ORDER BY title ASC");
		$results = $this->pdoQuery->fetchAll();
		return $results;
	}
	
	public function getDates() {
		
		// Filter date from
		if (isset($_REQUEST['filterDateFrom']) && !empty($_REQUEST['filterDateFrom'])) {
			
			$this->filterDates['fromForm'] = $_REQUEST['filterDateFrom'];
			$filterDateFromArray = explode('.', $_REQUEST['filterDateFrom']);
			$this->filterDates['fromCalc'] = $filterDateFromArray[2].'-'.$filterDateFromArray[1].'-'.$filterDateFromArray[0].' 00:00:00';
			$this->filterDates['toCalc'] = $filterDateFromArray[2].'-'.$filterDateFromArray[1].'-'.$filterDateFromArray[0].' 23:59:59';
			
		} else {
			
			$this->filterDates['fromForm'] = date('d.m.Y');
			$this->filterDates['fromCalc'] = date('Y-m-d 00:00:00');
			$this->filterDates['toCalc'] = date('Y-m-d 23:59:59');
			
		}
		
		// Filter date to
		if (isset($_REQUEST['filterDateTo']) && !empty($_REQUEST['filterDateTo'])) {
			
			$this->filterDates['toForm'] = $_REQUEST['filterDateTo'];
			$filterDateToArray = explode('.', $_REQUEST['filterDateTo']);
			$this->filterDates['toCalc'] = $filterDateToArray[2].'-'.$filterDateToArray[1].'-'.$filterDateToArray[0].' 23:59:59';
			
		}
		
		return $this->filterDates;
		
	}
	
}

$module = new Module_Data();

if (isset($_GET['trackDelete'])) {
	
	$module->deleteEntry();
	
}

$smarty->assign('module', $module);

