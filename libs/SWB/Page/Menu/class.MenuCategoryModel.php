<?php
class SWB_Page_Menu_MenuCategoryModel {
	
	protected $id 					= null;
	protected $title				= '';
	protected $position				= null;
	protected $admin				= null;
	protected $transferObject		= null;
	
	public function __construct() {
		
	}
	
	/**
	 * Injects a transfer object into modell
	 * @param SWB_Page_Menu_MenuCategoryTransferObject $transferObject
	 */
	public function injectTransferObject(SWB_Page_Menu_MenuCategoryTransferObject $transferObject) {
		
		$this->id = $transferObject->id;
		$this->title = $transferObject->title;
		$this->position = $transferObject->position;
		$this->admin = $transferObject->admin;
		$this->transferObject = $transferObject;
		
	}
	
	public function getId() {
		return $this->id;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
}