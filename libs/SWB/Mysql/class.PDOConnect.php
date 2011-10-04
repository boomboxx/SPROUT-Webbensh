<?php

/*
 * Connects to MySQL given by SWB_Main_MysqlConfig
 */

class SWB_Mysql_PDOConnect {
	
	public $connector			= null;
	protected $lastInsertId	= null;
	
	/**
	 *
	 * @param SWB_Main_MysqlConfig $config
	 * @return SWB_PDOMysql_Connect 
	 */
	public function __construct(SWB_Config_Mysql $config) {
		
		$this->setConnection($config);
		
		// Set UTF-8 if defined in system
		if (SWB_Config_System::DB_SET_UTF8 === true) {
			$this->setUtf8();
		}
		
		return $this;
		
	}
	
	/**
	 *
	 * @param type $config 
	 */
	protected function setConnection($config) {
		
		try {
			
			$this->connector = new PDO('mysql:host='.$config->dbserver.';dbname='.$config->dbname,$config->dbuser, $config->dbpass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );
			
		} catch (PDOException $e) {
			
			die('PDO error: '.$e->getMessage());
			
		}
		
	}
	
	public function setUtf8() {
		$this->connector->exec('SET CHARSET SET utf8');
	}
	
	public function getInsertId() {
		return $this->connector->lastInsertId();
	}
		
}