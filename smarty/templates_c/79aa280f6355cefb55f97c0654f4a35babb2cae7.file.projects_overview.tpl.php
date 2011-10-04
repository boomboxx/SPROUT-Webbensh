<?php /* Smarty version Smarty-3.0.7, created on 2011-06-29 12:41:41
         compiled from "C:/xampp/htdocs/Projekte/000_001-autoactiva-zeittracker/Dev/smarty/templates\modules/projects/projects_overview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:286494e0b016506bd18-96209980%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '79aa280f6355cefb55f97c0654f4a35babb2cae7' => 
    array (
      0 => 'C:/xampp/htdocs/Projekte/000_001-autoactiva-zeittracker/Dev/smarty/templates\\modules/projects/projects_overview.tpl',
      1 => 1309344098,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '286494e0b016506bd18-96209980',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('pageHeadline')->value;?>
</h1>
<br />
<br />
<table class="resultset-table">
	<tr class="resultset-head">
		<td>Jobnummer</td>
		<td>Kunde</td>
		<td>Projektleitung</td>
		<td>&nbsp;</td>
	</tr>
	<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('projects')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value){
?>
		<tr class="resultset-result-row">
			<td><?php echo $_smarty_tpl->tpl_vars['project']->value['jobnumber'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['project']->value['customerTitle'];?>
</td>
			<td>&nbsp;</td>
			<td class="resultset-result-row-icons"><a href = "index.php?page=projectsDetails&customerId=<?php echo $_smarty_tpl->tpl_vars['project']->value['customerId'];?>
&projectId=<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
"><img src="../gfx/icons/famfam/book_go.png" title="Projekte des Kunden" /></a></td>
		</tr>	
	<?php }} ?>
</table>