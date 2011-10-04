<?php /* Smarty version Smarty-3.0.7, created on 2011-06-26 23:53:33
         compiled from "F:/xamppWin7/xampp/htdocs/Projekte/000.100 - Sprout 0.2/Dev/smarty/templates\start/startpage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:117824e07aa5d24bc29-72711650%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e59744f37238ccabbc6a4d4b9a3737db58970baf' => 
    array (
      0 => 'F:/xamppWin7/xampp/htdocs/Projekte/000.100 - Sprout 0.2/Dev/smarty/templates\\start/startpage.tpl',
      1 => 1309124938,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '117824e07aa5d24bc29-72711650',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="de">
<head>
	<title><?php echo $_smarty_tpl->getVariable('title')->value;?>
</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link href="index.css" rel="stylesheet" type="text/css" />   
	<script type="text/javascript" src="js/jquery-1.5.js"></script>
</head>
<body>
	<?php if ($_smarty_tpl->getVariable('errorMessage')->value==true){?>
	<div id="loginErrorWrap">
		errorMessage
	</div>
	<?php }?>
	<?php echo $_smarty_tpl->getVariable('title')->value;?>

</body>
</html>