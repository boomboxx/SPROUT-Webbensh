<?php
session_start();
include('../core/sprout.php');
include('../libs/autoloader.php');

// Init variables
$pageAlias							= SWB_Config_System::DEFAULT_STARTPAGE;
$page								= null;
$pageTemplate						= null;
$pageTitle							= null;
$pageFilesJS						= array();
$pageFilesCSS						= array();
$pageRequest						= $_REQUEST;

// Reset system message
$_SESSION['systemMessageText'] = '';
$_SESSION['systemMessageType'] = '';

// Set $pageToLoad if GET
if (isset($_REQUEST['page'])) {
	$pageAlias = $_REQUEST['page'];
}

// Set PDO connection
$mysqlConfig = new SWB_Config_Mysql();
$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
$pdoConnect->setUtf8();

// Load Page
$page = SWB_Page_Page::getPageByAlias($pageAlias);
$pageTemplate = $page->getTemplate();
$pageTitle = utf8_encode($page->getTitle());
$pagePhpFile = $page->getPhpFile();
$pageFilesJS = $page->getFilesJs();
$pageFilesCSS = $page->getFilesCss();

// Load menu
$menuCategories = array();
$apiCategories = new SWB_Page_Menu_MenuCategoryApi($pdoConnect);
$apiItems = new SWB_Page_Menu_MenuItemApi($pdoConnect);

$categeories = $apiCategories->getMenuCategories();
foreach($categeories as $category) {
	
	$key = $category->getTitle();
	$menuCategories[$key]['title'] = $category->getTitle();
	$menuCategories[$key]['items'] = $apiItems->getMenuItemsByCategoryId($category->getId());
	
}

// Include module PHP
if (!empty($pagePhpFile) && file_exists('../modules/'.$pagePhpFile.'.php')) {

	include_once ('../modules/'.$pagePhpFile.'.php');

}

$smarty->assign('sproutVersion', SWB_Config_System::SWB_VERSION);
$smarty->assign('title','SPROUT Webbench '.SWB_Config_System::SWB_VERSION.' : '.$pageTitle);
$smarty->assign('pageHeadline', $pageTitle);
$smarty->assign('filesJS', $pageFilesJS);
$smarty->assign('filesCSS', $pageFilesCSS);
$smarty->assign('pageRequest', $pageRequest);
$smarty->assign('pageContentSize', SWB_Config_System::PAGE_CONTENTSIZE);
$smarty->assign('template', $pageTemplate);
$smarty->assign('menuCategories', $menuCategories);
$smarty->display('index.tpl');