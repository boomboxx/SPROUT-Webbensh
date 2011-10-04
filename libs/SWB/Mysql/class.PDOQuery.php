<?php

/*
 * PDO Query
 */

class SWB_Mysql_PDOQuery {
	
	protected $connect		= null;
	protected $statement		= '';
	protected $lastInsertId = null;

	public function __construct(SWB_Mysql_PDOConnect $connect) {
		
		$this->connect = $connect;
		return $this;

	}
	
	public function setQuery($query = '') {
		
		$this->statement = $this->connect->connector->prepare($query);
		
	}	
	
	public function bindString($var, $value) {
		
		$this->statement->bindParam(':'.$var, $value, PDO::PARAM_STR);
		
	}
	
	public function bindInteger($var, $value) {
		
		$this->statement->bindParam(':'.$var, $value, PDO::PARAM_INT);
		
	}	
	
	public function fetchObject() {
		
		$this->statement->execute();
		$result = $this->statement->fetch(PDO::FETCH_OBJ);
		return $result;
		
	}
	
	public function execute() {
		
		return $this->statement->execute();
		
	}
	
	/**
	 *
	 * @param class $class
	 * @return array $result
	 */
	public function fetchClass($class = '') {
		
		if (empty($class) || !class_exists($class)) {
			return null;
		} else {
			$this->statement->execute();
			$result = $this->statement->fetchALL(PDO::FETCH_CLASS, $class);
			return $result;
		}

	}	
	
	/**
	 *
	 * @return array $result
	 */
	public function fetchAll() {
		
		$this->statement->execute();
		$result = $this->statement->fetchALL(PDO::FETCH_ASSOC);
		return $result;

	}		
	
	/**
	 * 
	 * Enter description here ...
	 */
	public function insert() {
		
		try {

			$result = $this->statement->execute();
			return $result;
			
		} catch (PDOException $e) {
		
			die('PDO error: '.$e->getMessage());
		
		}
		
	}
	
	/**
	 * @return int lastIsertId
	 */
	public function getInserId() {
		return $this->lastInsertId;
	}

}