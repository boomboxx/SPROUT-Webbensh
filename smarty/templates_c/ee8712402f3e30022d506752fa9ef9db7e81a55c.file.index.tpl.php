<?php /* Smarty version Smarty-3.0.7, created on 2011-09-22 01:36:33
         compiled from "F:/XAMPP/xampp/htdocs/projekte/BBX - Boomboxx/BBX1103-SWB - Sprout 0.2/Dev/smarty/templates\index.tpl" */ ?>
<?php /*%%SmartyHeaderCode:236574e7a7501b288b8-57126350%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee8712402f3e30022d506752fa9ef9db7e81a55c' => 
    array (
      0 => 'F:/XAMPP/xampp/htdocs/projekte/BBX - Boomboxx/BBX1103-SWB - Sprout 0.2/Dev/smarty/templates\\index.tpl',
      1 => 1316648166,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '236574e7a7501b288b8-57126350',
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
	<div class="head-wrap">
		<div class="content-inner" style="left:50%; margin-left:-<?php echo ($_smarty_tpl->getVariable('pageContentSize')->value/2)-30;?>
px; width:<?php echo $_smarty_tpl->getVariable('pageContentSize')->value-30;?>
px">
			<div id="sprout-menu-button"><img src="../gfx/default/sprout-menu-button.png" alt="SPROUT Module" /></div>
			<div id="sprout-usermenu-wrap">
				<a href="index.php?page=logout"><img src="../gfx/icons/gui/logout.png" alt="Logout" title="Logout" /></a>
			</div>
		</div>
	</div>
	<div class="head-sub">
		<div class="content-inner" style="left:50%; margin-left:-<?php echo ($_smarty_tpl->getVariable('pageContentSize')->value/2)-30;?>
px; width:<?php echo $_smarty_tpl->getVariable('pageContentSize')->value-30;?>
px">
			<div class="head-sub-module"><?php echo $_smarty_tpl->getVariable('pageHeadline')->value;?>
</div>
		</div>
	</div>
	<div id="sprout-menu" class="sprout-menu">
		<?php  $_smarty_tpl->tpl_vars['menuCategory'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('menuCategories')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['menuCategory']->key => $_smarty_tpl->tpl_vars['menuCategory']->value){
?>
			<div class="sprout-menu-category">
				<strong><?php echo $_smarty_tpl->tpl_vars['menuCategory']->value['title'];?>
</strong>
				<ul>
					<?php  $_smarty_tpl->tpl_vars['menuItem'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['menuCategory']->value['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['menuItem']->key => $_smarty_tpl->tpl_vars['menuItem']->value){
?>
						<li><a href="index.php?page=<?php echo $_smarty_tpl->getVariable('menuItem')->value->getPageAlias();?>
"><?php echo $_smarty_tpl->getVariable('menuItem')->value->getTitle();?>
</a></li>
					<?php }} ?>
				</ul>
			</div>
		<?php }} ?>
	</div>
	<div id="content-wrap" class="content-inner" style="left:50%; margin-left:-<?php echo ($_smarty_tpl->getVariable('pageContentSize')->value/2)-30;?>
px; width:<?php echo $_smarty_tpl->getVariable('pageContentSize')->value-30;?>
px">
		<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('template')->value).".tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
	</div>
	<!-- SYSTEM MESSAGE -->
	<div id="head-system-message"<?php if (!empty($_SESSION['systemMessageText'])){?> style="display:inline"<?php }?>>
		<div id="head-system-message-float" style="background-color:#<?php if ($_SESSION['systemMessageType']=="passed"){?>168f0a<?php }else{ ?>e72020<?php }?>">
			<?php if (!empty($_SESSION['systemMessageText'])){?><?php echo $_SESSION['systemMessageText'];?>
<?php }?>
		</div>
	</div>	
</body>
</html>