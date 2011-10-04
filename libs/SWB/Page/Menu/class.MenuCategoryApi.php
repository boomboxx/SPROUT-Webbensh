<?php
class SWB_Page_Menu_MenuCategoryApi {
	
	protected $dataProvider			= null;
	
	public function __construct(SWB_Mysql_PDOConnect $pdoConnect) {
		
		$this->dataProvider = new SWB_Page_Menu_MenuCategoryDataProvider($pdoConnect);
		
	}
	
	/**
	 * 
	 * Returns an array of SWB_Page_Menu_MenuCategoryModel. $admin = true includes categories that needs admin flag
	 * @param boolean $admin
	 * @return array of SWB_Page_Menu_MenuCategoryModel
	 */
	public function getMenuCategories($admin = false) {
		
		$items = $this->dataProvider->getMenuCategories($admin); 
		return $items;
		
	}
	
	/**
	 * 
	 * Returns an array of SWB_Page_Menu_MenuCategoryModel
	 * @param int $categoryId
	 * @return array of SWB_Page_Menu_MenuCategoryModel
	 */
	public function getMenuCategoryById(int $categoryId) {
		
		$items = $this->dataProvider->getMenuCategoryById($categoryId);
		return $items;
		
	}
	
}