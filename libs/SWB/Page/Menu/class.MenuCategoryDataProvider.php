<?php
class SWB_Page_Menu_MenuCategoryDataProvider {
	
	protected $pdoConnect			= null;
	
	public function __construct(SWB_Mysql_PDOConnect $pdoConnect) {
		
		$this->pdoConnect = $pdoConnect;
		
	}
	
	/**
	 * 
	 * Returns array of SWB_Page_Menu_MenuCategoryModel
	 * @param boolean $admin
	 * @return array of SWB_Page_Menu_MenuCategoryModel
	 */
	public function getMenuCategories($admin) {
		
		// Add WHERE-clause if $admin
		$whereClause = '';
		if ($admin === true) {
			$whereClause = ' AND admin=1';
		}
		
		$pdoQuery = new SWB_Mysql_PDOQuery($this->pdoConnect);
		$pdoQuery->setQuery('SELECT * FROM swb_menu_categories'.$whereClause.' ORDER BY position');
		$results = $pdoQuery->fetchAll();
		$items = array();
		
		foreach($results as $result) {
			
			$transferObject = new SWB_Page_Menu_MenuCategoryTransferObject();
			$transferObject->id = $result['id'];
			$transferObject->title = $result['title'];
			$transferObject->position = $result['position'];
			$transferObject->admin = $result['admin'];
			
			$model = new SWB_Page_Menu_MenuCategoryModel();
			$model->injectTransferObject($transferObject);

			$items[] = $model;
		}
		return $items;
		
	}
	
}