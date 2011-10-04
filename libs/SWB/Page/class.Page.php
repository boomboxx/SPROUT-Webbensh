<?php

class SWB_Page_Page {
	
	protected $id					= null;
	protected $title				= null;
	protected $alias				= null;
	protected $hint				= null;
	protected $phpFile			= null;
	protected $template		= null;
	protected $checkRights	= false;
	protected $admin 			= false;
	protected $systemMessage	= null;
	protected $filesJS			= array();
	protected $filesCSS			= array();
	
	private function __construct() {
		
	}
	
	/**
	 *
	 * @param string $alias
	 * @return SWB_Page_Page 
	 */
	public static function getPageByAlias($alias) {
		
		$mysqlConfig = new SWB_Config_Mysql();
		$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
		$pdoConnect->setUtf8();
		$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);
		$pdoQuery->setQuery("SELECT * FROM swb_pages WHERE alias=:alias");
		$pdoQuery->bindString('alias', $alias);
		$result = $pdoQuery->fetchClass('SWB_Page_Page');
		
		if ($result[0] instanceof SWB_Page_Page) {
			return $result[0];
		} else {
			return false;
		}
	}
	
	/**
	 *
	 * @param int $alias
	 * @return SWB_Page_Page 
	 */
	public static function getPageById($pageId) {
		
		$mysqlConfig = new SWB_Config_Mysql();
		$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
		$pdoConnect->setUtf8();
		$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);
		$pdoQuery->setQuery("SELECT * FROM swb_pages WHERE id=:id");
		$pdoQuery->bindInteger('id', $pageId);
		$result = $pdoQuery->fetchClass('SWB_Page_Page');
		
		if ($result[0] instanceof SWB_Page_Page) {
			return $result[0];
		} else {
			return false;
		}
	}	
	
	/**
	 * @return string $id
	 */
	public function getId() {
		
		return $this->id;
	}		
	
	/**
	 * @return string $title
	 */
	public function getTitle() {
		
		return $this->title;
	}		
	
	/**
	 * @return string $alias
	 */
	public function getAlias() {
		
		return $this->alias;
	}	
	
	/**
	 * @return string $hint
	 */
	public function getHint() {
		
		return $this->hint;
	}	
	
	/**
	 * @return string $phpFile
	 */
	public function getPhpFile() {
		
		return $this->phpFile;
	}		
	
	/**
	 * @return string $template
	 */
	public function getTemplate() {
		
		return $this->template;
	}		
	
	/**
	 * @return boolean $checkRights
	 */
	public function getCheckRights() {
		
		if ($this->checkRights == 1) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * @return boolean $admin
	 */
	public function getAdmin() {
		
		if ($this->admin == 1) {
			return true;
		}
		
		return false;
	}
	
	/**
	 * @param SWB_Page_SystemMessage $message 
	 */
	public function setSystemMessage(SWB_Page_SystemMessage $message) {
		
		$this->systemMessage = $message;
		
	}

	/**
	 * @return obj SWB_Page_SystemMessage | false
	 */
	public function getSystemMessage() {
		
		if ($this->systemMessage instanceof SWB_Page_SystemMessage) {
		
			return $this->systemMessage = $message;
			break;
			
		} else {
			
			return false;
			
		}
		
	}	
	
	/**
	 * @return array $arrayFiles|boolean
	 */
	public function getFilesJs() {
		
		$arrayFilesJs = explode(',', $this->filesJS);
		foreach ($arrayFilesJs as $k => $v) {
			if (empty($v)) {
				unset($arrayFilesJs[$k]);
			}
		}
		if (count($arrayFilesJs)) {
			return $arrayFilesJs;
		} else {
			return false;
		}
		
	}
	
	/**
	 * @return array $arrayFiles|boolean
	 */	
	public function getFilesCss() {
		
		$arrayFilesCss = explode(',', $this->filesCSS);
		foreach ($arrayFilesCss as $k => $v) {
			if (empty($v)) {
				unset($arrayFilesCss[$k]);
			}
		}		
		if (count($arrayFilesCss)) {
			return $arrayFilesCss;
		} else {
			return false;
		}
		
	}	
	
}