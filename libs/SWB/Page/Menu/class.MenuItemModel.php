<?php
class SWB_Page_Menu_MenuItemModel {
	
	protected $id 					= null;
	protected $parentId				= null;
	protected $title				= '';
	protected $pageAlias			= '';
	protected $position				= null;
	protected $transferObject		= null;
	
	public function __construct() {
		
	}
	
	/**
	 * Injects a transfer object into modell
	 * @param SWB_Page_Menu_MenuItemTransferObject $transferObject
	 */
	public function injectTransferObject(SWB_Page_Menu_MenuItemTransferObject $transferObject) {
		
		$this->id = $transferObject->id;
		$this->parentId = $transferObject->parentId;
		$this->title = $transferObject->title;
		$this->pageAlias = $transferObject->pageAlias;
		$this->position = $transferObject->position;
		$this->transferObject = $transferObject;
		
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function getPageAlias() {
		return $this->pageAlias;
	}
	
}