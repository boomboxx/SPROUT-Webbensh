<?php /* Smarty version Smarty-3.0.7, created on 2011-06-27 16:48:09
         compiled from "C:/xampp/htdocs/Projekte/000_001-autoactiva-zeittracker/Dev/smarty/templates\modules/projects/customer_overview.tpl" */ ?>
<?php /*%%SmartyHeaderCode:266754e0898292a2556-45097017%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00e9089a659eb2e7702269f7ed8498a2c873c9d7' => 
    array (
      0 => 'C:/xampp/htdocs/Projekte/000_001-autoactiva-zeittracker/Dev/smarty/templates\\modules/projects/customer_overview.tpl',
      1 => 1309184033,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '266754e0898292a2556-45097017',
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
		<td>Firma</td>
		<td>Bemerkung</td>
		<td>Aktiv</td>
		<td>&nbsp;</td>
	</tr>
	<?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('results')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
?>
		<tr class="resultset-result-row">
			<td><?php echo $_smarty_tpl->tpl_vars['customer']->value['title'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['customer']->value['notes'];?>
</td>
			<td>
				<?php if ($_smarty_tpl->tpl_vars['customer']->value['active']==1){?>ja<?php }else{ ?>nein<?php }?>
			</td>
			<td class="resultset-result-row-icons"><a href = "index.php?page=customerProjects&customerId=<?php echo $_smarty_tpl->tpl_vars['customer']->value['id'];?>
"><img src="../gfx/icons/famfam/book_go.png" title="Projekte des Kunden" /></a></td>
		</tr>	
	<?php }} ?>
</table>