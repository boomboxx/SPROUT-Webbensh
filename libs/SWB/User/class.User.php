<?php

class SWB_User_User {
	
	protected $id					= null;
	protected $login				= '';
	protected $password		= '';
	protected $name				= '';
	protected $surname		= '';
	protected $admin 			= false;
	protected $gender			= null;
	protected $active			= false;
	
	private function __construct() {
		
	}
	
	/**
	 *
	 * @param SWB_Login_Login $login
	 * @return SWB_User_User 
	 */
	public static function getUserByLogin(SWB_Login_Login $login) {
		
		$mysqlConfig = new SWB_Config_Mysql();
		$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
		$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);
		$pdoQuery->setQuery("SELECT * FROM swb_user WHERE login=:username");
		$pdoQuery->bindString('username', $login->loginName);
		$result = $pdoQuery->fetchClass('SWB_User_User');
		
		if ($result[0] instanceof SWB_User_User) {
			return $result[0];
		} else {
			return false;
		}
		
	}
	
	/**
	 *
	 * @param int $userID
	 * @return SWB_User_User 
	 */
	public static function getUserById($userId) {
		
		$mysqlConfig = new SWB_Config_Mysql();
		$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
		$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);
		$pdoQuery->setQuery("SELECT * FROM swb_user WHERE id=:id");
		$pdoQuery->bindString('id', $userId);
		$result = $pdoQuery->fetchClass('SWB_User_User');
		
		if ($result[0] instanceof SWB_User_User) {
			return $result[0];
		} else {
			return false;
		}
		
	}	
	
	/**
	 *
	 * @return array of SWB_User_User 
	 */
	public static function getActiveUsers($sort = 'id') {
		
		$mysqlConfig = new SWB_Config_Mysql();
		$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
		$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);
		$pdoQuery->setQuery("SELECT * FROM swb_user WHERE active=1 ORDER BY :sort ASC");
		$pdoQuery->bindString('sort', $sort);
		$result = $pdoQuery->fetchClass('SWB_User_User');
		
		if (is_array($result)) {
			return $result;
		} else {
			return false;
		}
		
	}		
	
	/**
	 * @return boolean
	 */
	public function isActive() {
		
		if ($this->active == 1) {
			return true;
		}
		
		return false;
		
	}
	
	/**
	 * @return boolean
	 */
	public function isAdmin() {
		
		if ($this->admin == 1) {
			return true;
		}
		
		return false;
		
	}	
	
	/**
	 * @return string $this->password
	 */
	public function getPasswordHash() {
		return $this->password;
	}
	
	/**
	 * @return string $name
	 */
	public function getName() {
		return $this->name;
	}
	
	/**
	 * @return string $surname
	 */
	public function getSurname() {
		return $this->surname;
	}	
	
	
	/**
	 * @return int $id
	 */
	public function getId() {
		return $this->id;
	}		
	
}