<?php
class SWB_Page_Menu_MenuItemDataProvider {
	
	protected $pdoConnect			= null;
	
	public function __construct(SWB_Mysql_PDOConnect $pdoConnect) {
		
		$this->pdoConnect = $pdoConnect;
		
	}
	
	/**
	 * 
	 * Returns array of SWB_Page_Menu_MenuItemModel
	 * @param integer $parentId
	 * @return array $items
	 */
	public function getMenuItemsByCategoryId($parentId) {
		
		$pdoQuery = new SWB_Mysql_PDOQuery($this->pdoConnect);
		$pdoQuery->setQuery('SELECT * FROM swb_menu_items WHERE parentId=:parentId');
		$pdoQuery->bindInteger('parentId',$parentId);
		$results = $pdoQuery->fetchAll();
		$items = array();
		
		foreach($results as $result) {
			
			$transferObject = new SWB_Page_Menu_MenuItemTransferObject();
			$transferObject->id = $result['id'];
			$transferObject->parentId = $result['parentId'];
			$transferObject->title = $result['title'];
			$transferObject->pageAlias = $result['pageAlias'];
			$transferObject->position = $result['position'];
			
			$model = new SWB_Page_Menu_MenuItemModel();
			$model->injectTransferObject($transferObject);

			$items[] = $model;
		}
		return $items;
		
	}
	
	/**
	 * 
	 * Returns object of type SWP_Page_MenuItemModel
	 * @param integer $id
	 * @return SWB_Page_Menu_MenuItemModel
	 */
	public function getMenuItemsById($id) {
		
		$pdoQuery = new SWB_Mysql_PDOQuery($this->pdoConnect);
		$pdoQuery->setQuery('SELECT * FROM swb_menu_items WHERE id=:id');
		$pdoQuery->bindInteger('id',$id);
		$results = $pdoQuery->fetchObject('SWB_Page_Menu_MenuItemModel');
		$items = array();
		
		foreach($results as $result) {
			
			$transferObject = new SWB_Page_Menu_MenuItemTransferObject();
			$transferObject->id = $result['id'];
			$transferObject->parentId = $result['parentId'];
			$transferObject->title = $result['title'];
			$transferObject->pageAlias = $result['pageAlias'];
			$transferObject->position = $result['position'];
			
			$model = new SWB_Page_Menu_MenuItemModel();
			$model->injectTransferObject($transferObject);

			$items[] = $model;
		}
		return $items;
		
	}
	
}