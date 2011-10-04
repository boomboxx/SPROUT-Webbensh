<?php /* Smarty version Smarty-3.0.7, created on 2011-06-28 22:53:50
         compiled from "F:/xamppWin7/xampp/htdocs/Projekte/000.100 - Sprout 0.2/Dev/smarty/templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:74684e0a3f5ecf0762-91998268%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6359821e2131b534c80587953830d6614e23d47e' => 
    array (
      0 => 'F:/xamppWin7/xampp/htdocs/Projekte/000.100 - Sprout 0.2/Dev/smarty/templates\\index.tpl',
      1 => 1309271268,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '74684e0a3f5ecf0762-91998268',
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
	<link href="../css/base.css" rel="stylesheet" type="text/css" />
	<link href="../css/smoothness/jquery-ui-1.8.13.custom.css" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="../js/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.8.13.custom.min.js"></script>
	<script type="text/javascript" src="../js/gui/gui.js"></script>
	
</head>
<body>
	<div id="head-wrap">
		<div id="sprout-menu-button"><img src="../gfx/default/sprout-menu-button.png" alt="SPROUT Module" /></div>
	</div>
	<div id="sprout-menu-wrap" class="sprout-menu-wrap">
		<div class="sprout-menu-top">
			<a href="index.php?page=customerOverview" title="kunden">Kunden Übersicht</a>
		</div>
		<div class="sprout-menu-bottom"></div>
	</div>
	<div id="content-wrap">
		<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('template')->value).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
	</div>
</body>
</html>