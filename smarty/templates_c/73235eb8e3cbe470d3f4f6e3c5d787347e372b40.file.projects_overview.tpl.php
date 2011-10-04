<?php /* Smarty version Smarty-3.0.7, created on 2011-07-28 16:18:27
         compiled from "/pub/www/vhosts/sprout/smarty/templates/modules/projects/projects_overview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8300423364e316fb3016934-11464550%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '73235eb8e3cbe470d3f4f6e3c5d787347e372b40' => 
    array (
      0 => '/pub/www/vhosts/sprout/smarty/templates/modules/projects/projects_overview.tpl',
      1 => 1309344099,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8300423364e316fb3016934-11464550',
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