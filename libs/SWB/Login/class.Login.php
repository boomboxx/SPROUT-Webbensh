<?php

class SWB_Login_Login {
	
	const LOGIN_ERROR_USER_UNKNOWN 							= 1;
	const LOGIN_ERROR_WRONG_PASSWORD 						= 2;
	const LOGIN_ERROR_NOT_ACTIVE 									= 3;
	const LOGIN_ERROR_NO_USERNAME_OR_PASSWORD 	= 4;
	
	public $loginName		= null;
	public $loginPassword	= null;
	protected $loginError	= false;
	protected $user			= false;	
		
	public function __construct($username, $password) {
		
		$this->loginName = $username;
		$this->loginPassword = $password;	
		$this->checkLogin();

	}
	
	/**
	 * @param const $errorConst
	 */
	protected function setError($errorConst) {
		
		$this->loginError = $errorConst;
		
	}
	
	protected function checkLogin() {
		
		// Form fields not empty?
		if (empty($this->loginName) || empty($this->loginPassword)) {
			$this->setError(self::LOGIN_ERROR_NO_USERNAME_OR_PASSWORD);
		}		
		
		// Get user and check
		if (!$this->loginError) {

			$this->user = SWB_User_User::getUserByLogin($this);
			
			// User exists?
			if (!$this->user) {
				
				$this->setError(self::LOGIN_ERROR_USER_UNKNOWN);
				
			} else {
				
				if ($this->loginPassword != $this->user->getPasswordHash()) {
					
					$this->setError(self::LOGIN_ERROR_WRONG_PASSWORD);
					
				} elseif (!$this->user->isActive()) {
					
					$this->setError(self::LOGIN_ERROR_NOT_ACTIVE);
					
				}
				
			}
			
			
		}
		
		return $this;
		
	}
	
	/**
	 * @return boolean $this->loginError
	 */
	public function getLoginError() {
		
			return $this->loginError;
			
	}
	
	/**
	 * @return SWB_User_User $this->user
	 */
	public function getUser() {
			
		// Check if user is active
		return $this->user;

	}

}