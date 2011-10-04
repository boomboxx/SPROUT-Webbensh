<?php /* Smarty version Smarty-3.0.7, created on 2011-07-14 12:30:15
         compiled from "C:/xampp/htdocs/Projekte/000_001-autoactiva-zeittracker/Dev/smarty/templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:22834e1ec537de5295-18670621%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ceaa3969976ce3a79174aa85c475a2edab17ef51' => 
    array (
      0 => 'C:/xampp/htdocs/Projekte/000_001-autoactiva-zeittracker/Dev/smarty/templates\\index.tpl',
      1 => 1310639412,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22834e1ec537de5295-18670621',
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
	<?php  $_smarty_tpl->tpl_vars['file'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('filesCSS')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['file']->key => $_smarty_tpl->tpl_vars['file']->value){
?>
		<link type="text/css" rel="stylesheet" href="../css/<?php echo $_smarty_tpl->tpl_vars['file']->value;?>
" />
	<?php }} ?>	
	<script type="text/javascript" src="../js/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.8.13.custom.min.js"></script>
	<script type="text/javascript" src="../js/gui/gui.js"></script>
	<?php  $_smarty_tpl->tpl_vars['file'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('filesJS')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['file']->key => $_smarty_tpl->tpl_vars['file']->value){
?>
		<script type="text/javascript" src="../js/<?php echo $_smarty_tpl->tpl_vars['file']->value;?>
"></script>
	<?php }} ?>
</head>
<body>
	<div id="head-wrap">
		<div id="sprout-menu-button"><img src="../gfx/default/sprout-menu-button.png" alt="SPROUT Module" /></div>
	</div>
	<div id="sprout-menu-wrap" class="sprout-menu-wrap">
		<div class="sprout-menu-top">
			<a href="index.php?page=customerOverview" title="kunden">Kunden Übersicht</a><br /><br />
			<a href="index.php?page=projectsOverview" title="projekte">Projekte Übersicht</a><br /><br />
			<a href="index.php?page=timetrackerReportUser" title="projekte">Timetracker Report nach Mitarbeiter</a>
		</div>
		<div class="sprout-menu-bottom"></div>
	</div>
	<div id="content-wrap">
		<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('template')->value).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
	</div>
</body>
</html>