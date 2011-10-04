<?php /* Smarty version Smarty-3.0.7, created on 2011-09-10 13:16:23
         compiled from "F:/uwamp/www/projekte/BBX - Boomboxx/BBX1103-SWB - Sprout 0.2/Dev/smarty/templates\modules/projects/timetracker_report_default.tpl" */ ?>
<?php /*%%SmartyHeaderCode:165334e6b4707d6b876-12642046%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4ba97ad088bd623c6dc5cd2c6528a7fbef91e99a' => 
    array (
      0 => 'F:/uwamp/www/projekte/BBX - Boomboxx/BBX1103-SWB - Sprout 0.2/Dev/smarty/templates\\modules/projects/timetracker_report_default.tpl',
      1 => 1314183021,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '165334e6b4707d6b876-12642046',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php $_smarty_tpl->tpl_vars["datesArray"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getDates(), null, null);?>
<h1><?php echo $_smarty_tpl->getVariable('pageHeadline')->value;?>
</h1>
<br />
<br />
<form method="post" action="index.php?page=timetrackerReportDefault">
	Datum:
	<input type="text" name="filterDateFrom" class="datepickerUi" value="<?php echo $_smarty_tpl->getVariable('datesArray')->value['fromForm'];?>
" /> bis <input type="text" name="filterDateTo" class="datepickerUi" value="<?php echo $_smarty_tpl->getVariable('datesArray')->value['toForm'];?>
" />
	Kunde: 
	<?php $_smarty_tpl->tpl_vars["customerList"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getCustomerList(), null, null);?>
	<select name="filterCustomer">
		<option value="">-</option>
		<?php  $_smarty_tpl->tpl_vars['customer'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('customerList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['customer']->key => $_smarty_tpl->tpl_vars['customer']->value){
?>
		<option value="<?php echo $_smarty_tpl->tpl_vars['customer']->value['id'];?>
"<?php if ($_REQUEST['filterCustomer']==$_smarty_tpl->tpl_vars['customer']->value['id']){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['customer']->value['acronym'];?>
 - <?php echo $_smarty_tpl->tpl_vars['customer']->value['title'];?>
</option>
		<?php }} ?>
	</select>
	Projekt: 
	<?php $_smarty_tpl->tpl_vars["projectsList"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getProjectsList(), null, null);?>
	<select name="filterProjects">
		<option value="">-</option>
		<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('projectsList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value){
?>
		<option value="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
"<?php if ($_REQUEST['filterProjects']==$_smarty_tpl->tpl_vars['project']->value['id']){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['project']->value['jobnumber'];?>
 - <?php echo $_smarty_tpl->tpl_vars['project']->value['title'];?>
</option>
		<?php }} ?>
	</select>
	Mitarbeiter: 
	<?php $_smarty_tpl->tpl_vars["usersList"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getActiveUsers(), null, null);?>
	<select name="filterUsers">
		<option value="">-</option>
		<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('usersList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>	
		<option value="<?php echo $_smarty_tpl->getVariable('user')->value->getId();?>
"<?php if ($_REQUEST['filterUsers']==$_smarty_tpl->getVariable('user')->value->getId()){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->getVariable('user')->value->getSurname();?>
, <?php echo $_smarty_tpl->getVariable('user')->value->getName();?>
</option>
		<?php }} ?>
	</select>	
	Kategorie: 
	<?php $_smarty_tpl->tpl_vars["categoriesList"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getCategoriesList(), null, null);?>
	<select name="filterCategories">
		<option value="">-</option>
		<?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categoriesList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
?>
		<option value="<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
"<?php if ($_REQUEST['filterCategories']==$_smarty_tpl->tpl_vars['category']->value['id']){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['category']->value['title'];?>
</option>
		<?php }} ?>
	</select>
	


	
	
	
	<input type="submit" value="aktualisieren" name=""trackingReportProjectSubmit" /> 
</form>
<br />
<table class="tracking-report-list-table">
	<tr class="tracking-report-list-table-head">
		<td>
			Kunde			
		</td>
		<td>
			Job - Projekt
		</td>
		<td>
			Datum
		</td>
		<td>
			Mitarbeiter
		</td>
		<td>
			Kategorie
		</td>
		<td class="right-align">
			Std.
		</td>
		<td class="right-align">
			OB
		</td>
		<td class="right-align">
			KV
		</td>
		<td class="right-align">
			Netto
		</td>
	</tr>
	<!-- ##### AUSGABE TRACKINGS ##### -->
	<?php $_smarty_tpl->tpl_vars["trackings"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getTrackings(), null, null);?>
	<?php  $_smarty_tpl->tpl_vars['tracking'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('trackings')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['tracking']->key => $_smarty_tpl->tpl_vars['tracking']->value){
?>
		<?php $_smarty_tpl->tpl_vars["project"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getProject($_smarty_tpl->tpl_vars['tracking']->value['projectId']), null, null);?>
		<?php $_smarty_tpl->tpl_vars["category"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getCategory($_smarty_tpl->tpl_vars['tracking']->value['categoryId']), null, null);?>
	<tr title="<?php echo $_smarty_tpl->tpl_vars['tracking']->value['id'];?>
">
		<td>
			<?php echo $_smarty_tpl->tpl_vars['tracking']->value['customerAcronym'];?>
 - <?php echo $_smarty_tpl->tpl_vars['tracking']->value['customerTitle'];?>
			
		</td>
		<td>
			<?php echo $_smarty_tpl->tpl_vars['tracking']->value['projectJobnumber'];?>
 - <?php echo $_smarty_tpl->tpl_vars['tracking']->value['projectTitle'];?>

		</td>
		<td>
			<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['tracking']->value['moment'];?>
<?php $_tmp1=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('module')->value->getDateFormatted($_tmp1);?>

		</td>
		<td>
			<?php $_smarty_tpl->tpl_vars["user"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getUser($_smarty_tpl->tpl_vars['tracking']->value['userId']), null, null);?>
			<?php echo $_smarty_tpl->getVariable('user')->value->getSurname();?>
, <?php echo $_smarty_tpl->getVariable('user')->value->getName();?>

		</td>
		<td>
			<?php echo $_smarty_tpl->tpl_vars['tracking']->value['categoryTitle'];?>

		</td>
		<td class="right-align">
			<?php if ($_smarty_tpl->tpl_vars['tracking']->value['hoursUsed']>0){?><?php echo $_smarty_tpl->tpl_vars['tracking']->value['hoursUsed'];?>
<?php }else{ ?>-<?php }?>
		</td>
		<td class="right-align">
			<?php if ($_smarty_tpl->tpl_vars['tracking']->value['hoursOB']>0){?><?php echo $_smarty_tpl->tpl_vars['tracking']->value['hoursOB'];?>
<?php }else{ ?>-<?php }?>
		</td>
		<td class="right-align">
			<?php if ($_smarty_tpl->tpl_vars['tracking']->value['hoursKV']>0){?><?php echo $_smarty_tpl->tpl_vars['tracking']->value['hoursKV'];?>
<?php }else{ ?>-<?php }?>
		</td>
		<td class="right-align">
			<?php echo $_smarty_tpl->getVariable('module')->value->getNettoSecondsFormatted($_smarty_tpl->tpl_vars['tracking']->value['nettoSeconds']);?>

		</td>
	</tr>
	<?php }} ?>
	<?php $_smarty_tpl->tpl_vars["trackingsSums"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getTrackingsSums(), null, null);?>
	<tr class="tracking-report-list-table-allover">
		<td>
			GESAMT
		</td>
		<td>
		</td>
		<td>
		</td>
		<td>
		</td>
		<td>
		</td>
		<td class="right-align">
			<?php if ($_smarty_tpl->getVariable('trackingsSums')->value['sumUsed']>0){?><?php echo $_smarty_tpl->getVariable('trackingsSums')->value['sumUsed'];?>
<?php }else{ ?>-<?php }?>
		</td>
		<td class="right-align">
			<?php if ($_smarty_tpl->getVariable('trackingsSums')->value['sumOB']>0){?><?php echo $_smarty_tpl->getVariable('trackingsSums')->value['sumOB'];?>
<?php }else{ ?>-<?php }?>
		</td>
		<td class="right-align">
			<?php if ($_smarty_tpl->getVariable('trackingsSums')->value['sumKV']>0){?><?php echo $_smarty_tpl->getVariable('trackingsSums')->value['sumKV'];?>
<?php }else{ ?>-<?php }?>
		</td>
		<td class="right-align">
			<?php if ($_smarty_tpl->getVariable('trackingsSums')->value['sumNettoSeconds']>0){?><?php echo $_smarty_tpl->getVariable('module')->value->getNettoSecondsFormattedSum($_smarty_tpl->getVariable('trackingsSums')->value['sumNettoSeconds']);?>
<?php }else{ ?>-<?php }?>
			
		</td>
	</tr>	
</table>
