<?php

class Modules_Projects_Trackings_TrackingAPI {
	
	protected $dbConfig 		= null;
	protected $pdoConnect 	= null;
	protected $dataProvider = null;
	
	public function __construct(SWB_Config_Mysql $dbConfig) {
		
		$this->dbConfig = $dbConfig;
		$this->pdoConnect = new SWB_Mysql_PDOConnect($this->dbConfig);	
		$this->dataProvider = new Modules_Projects_Tracking_TrackingDP($this->pdoConnect);
		
	}

	public function getTrackingsByUserId($userId) {
		
		return $this->dataProvider->getModelsByUserId(intval($userId), $lookUpDate);
		
	}

}