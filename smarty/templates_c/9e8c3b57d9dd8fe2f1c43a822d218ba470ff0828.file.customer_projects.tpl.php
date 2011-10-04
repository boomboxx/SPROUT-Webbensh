<?php /* Smarty version Smarty-3.0.7, created on 2011-07-29 10:40:51
         compiled from "/pub/www/vhosts/sprout/smarty/templates/modules/projects/customer_projects.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4261264264e327213459e60-19496997%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9e8c3b57d9dd8fe2f1c43a822d218ba470ff0828' => 
    array (
      0 => '/pub/www/vhosts/sprout/smarty/templates/modules/projects/customer_projects.tpl',
      1 => 1309186194,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '4261264264e327213459e60-19496997',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1>Projekte für <?php echo $_smarty_tpl->getVariable('customer')->value['title'];?>
</h1>
<br />
<br />
<table class="resultset-table">
	<tr class="resultset-head">
		<td>Jobnummer</td>
		<td>Bezeichnung</td>
		<td>Projektleitung</td>
		<td>Aktiv</td>
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
			<td><?php echo $_smarty_tpl->tpl_vars['project']->value['title'];?>
</td>
			<td>
				<?php echo $_smarty_tpl->getVariable('project')->value['manager']->getSurname();?>
, <?php echo $_smarty_tpl->getVariable('project')->value['manager']->getName();?>

			</td>
			<td>
				<?php if ($_smarty_tpl->tpl_vars['project']->value['active']==1){?>ja<?php }else{ ?>nein<?php }?>
			</td>
			<td class="resultset-result-row-icons"><a href = "index.php?page=projectsDetails&customerId=<?php echo $_smarty_tpl->getVariable('customer')->value['id'];?>
&projectId=<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
"><img src="../gfx/icons/famfam/book_go.png" title="Details zum Projekt" /></a></td>
		</tr>	
	<?php }} ?>
</table>