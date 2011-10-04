<?php
class Modules_Projects_Tracking_TrackingDP {
	
	protected $pdoConnect = null;
	protected $pdoQuery = null;
	protected $transferObjects = array();
	protected $currentTO = null;
	
	public function __construct(SWB_Mysql_PDOConnect $connect) {
		
		$this->pdoConnect = $connect;
		$this->pdoQuery = new SWB_Mysql_PDOQuery($this->pdoConnect);
		
	}
	
	public function getModelsByUserId(int $userId, DateTime $lookUpDate) {
		
		$trackings = array();
		$this->pdoQuery->setQuery("
			SELECT * 
			FROM module_projects_projects_tracking 
			WHERE userId=:userid AND moment LIKE :lookupdate
			ORDER BY moment ASC
		");
		$this->pdoQuery->bindInteger('userid', $userId);
		$this->pdoQuery->bindString('lookupdate', $lookUpDate->format('Y-m-d').'%');
		$dbRows = $this->pdoQuery->fetchAll();
		
		foreach($dbRows as $row) {
			
			if ($this->currentTO === null || $currentTO->id != intval($row['id'])) {
				
				
				
			}
			
		}
		
		
		return $trackings;		
		
	}
	
}