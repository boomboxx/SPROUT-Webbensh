<?php

class SWB_Config_Mysql {
	
	/**
	 *
	 * @param type $identifier
	 * @return SWB_Config_Mysql
	 */
	public function __construct($identifier = '') {
		
		$this->getConfigByIdentifier($identifier);
		return $this;
	}
	
	/**
	 *
	 * @param type $identifier 
	 */
	private function getConfigByIdentifier($identifier) {

		switch ($identifier) {
			default:
				$this->dbserver = 'localhost';
				$this->dbname = 'sproutbensh';
				$this->dbuser = 'root';
				$this->dbpass = '';
		}
		
	}
	
}
