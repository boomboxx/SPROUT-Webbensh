<?php

class SWB_Page_SystemMessage {
	
	protected $message				= null;
	protected $messageState			= null;
	
	const SWB_SYSTEMMESSAGE_STATE_OKAY		= 1;
	const SWB_SYSTEMMESSAGE_STATE_WARNING	= 2;
	const SWB_SYSTEMMESSAGE_STATE_ERROR		= 3;
	
	private function __construct() {
		
	}
	
	/**
	 * @param string $message
	 * @return SWB_Page_SystemMessage 
	 */
	public function setMessage($message) {
		
		$this->message = $message;
		return $this;
		
	}			
	
	/**
	 * @param const $state
	 * @return SWB_Page_SystemMessage 
	 */
	public function setState($state) {
		
		$this->messageState = $state;
		return $this;
		
	}		
	
	/**
	 * @return string $this->message
	 */
	public function getMessage() {
	
		if (isset($this->message)) {
			
			return $this->message;
			
		} else {
			
			return false;
			
		}
	
	}
	
	/**
	 * @return int $this->messageState 
	 */
	public function getState() {
	
		if (isset($this->messageState)) {
			
			return $this->messageState;
			
		} else {
			
			return false;
			
		}
	
	}	
	
}