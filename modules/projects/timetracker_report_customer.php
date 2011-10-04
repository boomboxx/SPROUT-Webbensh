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
	
	/**
	 * @return array $projects
	 */
	public function getActiveCustomer() {
		
		$this->pdoQuery->setQuery("
			SELECT * 
			FROM module_projects_customer
			WHERE active = 1
			ORDER BY title ASC
		");
		$customerList = $this->pdoQuery->fetchAll();
		return $customerList;
		
	}
	
	/**
	 * @param int $userId
	 * @return array of trackings
	 */
	public function getTrackingsByProjectId($projectId) {
		
		$this->pdoQuery->setQuery("
			SELECT projectId, categoryId, userId, moment, hoursUsed, hoursOB, hoursKV, nettoSeconds, notice 
			FROM module_projects_projects_tracking 
			WHERE projectId=:projectid
			ORDER BY moment ASC
		");
		$this->pdoQuery->bindInteger('projectid', $projectId);
		$trackings = $this->pdoQuery->fetchAll();
		return $trackings;
		
	}
	
	/**
	 * @return object SWB_User_User  
	 */
	public function getUserById($userId) {
		
		$user = SWB_User_User::getUserById($userId);
		return $user;
		
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
	
	public function getDateFormatted($dateTimeString) {
		$dtObject = new DateTime($dateTimeString);
		return $dtObject->format('d.m.Y');
	}
	
	/**
	 * @param int $projectId
	 */
	public function getTrackingSumStd($projectId) {
		$this->pdoQuery->setQuery("SELECT SUM(hoursUsed) AS sumHoursUsed  FROM module_projects_projects_tracking WHERE projectId=:projectid");
		$this->pdoQuery->bindInteger('projectid', $projectId);
		$hours = $this->pdoQuery->fetchAll();
		return $hours[0]['sumHoursUsed'];		
	}
	
	/**
	 * @param int $projectId
	 */
	public function getTrackingSumOb($projectId) {
		$this->pdoQuery->setQuery("SELECT SUM(hoursOB) AS sumHoursUsed  FROM module_projects_projects_tracking WHERE projectId=:projectid");
		$this->pdoQuery->bindInteger('projectid', $projectId);
		$hours = $this->pdoQuery->fetchAll();
		return $hours[0]['sumHoursUsed'];		
	}	
	
	/**
	 * @param int $projectId
	 */
	public function getTrackingSumKv($projectId) {
		$this->pdoQuery->setQuery("SELECT SUM(hoursKV) AS sumHoursUsed  FROM module_projects_projects_tracking WHERE projectId=:projectid");
		$this->pdoQuery->bindInteger('projectid', $projectId);
		$hours = $this->pdoQuery->fetchAll();
		return $hours[0]['sumHoursUsed'];		
	}	

	/**
	 * @param int $projectId
	 */
	public function getTrackingSumSecondsNetto($projectId) {
		$this->pdoQuery->setQuery("SELECT SUM(nettoSeconds) AS sumHoursUsed  FROM module_projects_projects_tracking WHERE projectId=:projectid");
		$this->pdoQuery->bindInteger('projectid', $projectId);
		$hours = $this->pdoQuery->fetchAll();
		return round(($hours[0]['sumHoursUsed']/3600),2);
	}		
	
	public function getCustomerById($customerId) {
		$this->pdoQuery->setQuery("SELECT * FROM module_projects_customer WHERE id=:cid");
		$this->pdoQuery->bindInteger('cid', $customerId);
		$customer = $this->pdoQuery->fetchAll();
		return $customer[0];
	}		
	
	/**
	 * @param int $customerId
	 * @param boolean $includeDeactivatedProjects
	 * @return array of projects
	 */
	public function getProjectsByCustomerId($customerId, $includeDeactivatedProjects = false) {
		$this->pdoQuery->setQuery("
			SELECT * 
			FROM module_projects_projects 
			WHERE customerId=:cid
			ORDER BY jobnumber ASC
		");
		$this->pdoQuery->bindInteger('cid', $customerId);
		$projects = $this->pdoQuery->fetchAll();
		return $projects;
	}	

	public function getNettoSecondsFormatted($seconds) {

		return round(($seconds/3600),2);		
		
	}		
	
}

$module = new Module_Data();
$smarty->assign('module', $module);