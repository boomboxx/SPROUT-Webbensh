<?php
class SWB_Page_Menu_MenuItemApi {
	
	protected $dataProvider			= null;
	
	public function __construct(SWB_Mysql_PDOConnect $pdoConnect) {
		
		$this->dataProvider = new SWB_Page_Menu_MenuItemDataProvider($pdoConnect);
		
	}
	
	/**
	 * 
	 * Returns an array of SWB_Page_MenuItemModel
	 * @param integer $categoryId
	 * @return array of SWB_Page_Menu_MenuItemModel
	 */
	public function getMenuItemsByCategoryId($categoryId) {
		
		$items = $this->dataProvider->getMenuItemsByCategoryId($categoryId);
		return $items;
		
	}
	
	public function getMenuItemsById($id) {
		
		$items = $this->dataProvider->getMenuItemsById($id);
		return $items;
		
	}	
	
}