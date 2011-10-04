<?php /* Smarty version Smarty-3.0.7, created on 2011-07-28 16:47:01
         compiled from "/pub/www/vhosts/sprout/smarty/templates/modules/projects/timetracker_report_customer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1107934534e317665068e41-36106015%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3820b0c8f0531f6ffe67fe230cbccdd954e5e557' => 
    array (
      0 => '/pub/www/vhosts/sprout/smarty/templates/modules/projects/timetracker_report_customer.tpl',
      1 => 1311691561,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1107934534e317665068e41-36106015',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php ob_start();?><?php echo $_REQUEST['customerId'];?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["customer"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getCustomerById($_tmp1), null, null);?>
<h1><?php echo $_smarty_tpl->getVariable('pageHeadline')->value;?>
 - <?php echo $_smarty_tpl->getVariable('customer')->value['title'];?>
</h1>
<br />
<br />
<form method="post" action="index.php?page=timetrackerReportProject">
	Kunde: <select name="customerId" class="tracking-report-project-select-projects">
		<?php $_smarty_tpl->tpl_vars["customerList"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getActiveCustomer(), null, null);?>
		<?php  $_smarty_tpl->tpl_vars['customerInList'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('customerList')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['customerInList']->key => $_smarty_tpl->tpl_vars['customerInList']->value){
?>
			<option value="<?php echo $_smarty_tpl->tpl_vars['customerInList']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['customerInList']->value['id']==$_REQUEST['customerId']){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['customerInList']->value['title'];?>
</option>
		<?php }} ?>
	</select>
	Zeitraum: <input type="text" name="trackreportProjectDateFrom" class="trackreportUserDate datepickerUi" value="" /> - <input type="text" name="trackreportProjectDateTill" class="trackreportUserDate datepickerUi" value="" />
	<input type="submit" value="aktualisieren" name=""trackingReportProjectSubmit" /> 
</form>
<br />
<?php ob_start();?><?php echo $_smarty_tpl->getVariable('customer')->value['id'];?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["projects"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getProjectsByCustomerId($_tmp2), null, null);?>
<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('projects')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value){
?>
<br />
<div class="tracking-report-project-wrap">
	<div class="tracking-report-head-title"><a href="index.php?page=timetrackerReportProject&amp;projectId=<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
" title="Trackings zu diesem Project"><?php echo $_smarty_tpl->tpl_vars['project']->value['jobnumber'];?>
 - <?php echo $_smarty_tpl->tpl_vars['project']->value['title'];?>
</a></div>
	<div class="tracking-report-project-head-wrap">
		<div class="tracking-report-project-head-date">Datum</div>
		<div class="tracking-report-project-head-user">Mitarbeiter</div>
		<div class="tracking-report-project-head-category">Kategorie</div>
		<div class="tracking-report-project-head-notice">Notiz</div>
		<div class="tracking-report-project-head-hours-wrap">
			<div class="tracking-report-project-head-hours">Std.</div>
			<div class="tracking-report-project-head-hours">OB</div>
			<div class="tracking-report-project-head-hours">KV</div>
		</div>
	</div>
	<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
<?php $_tmp3=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["trackings"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getTrackingsByProjectId($_tmp3), null, null);?>
	<?php  $_smarty_tpl->tpl_vars['tracking'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('trackings')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['tracking']->key => $_smarty_tpl->tpl_vars['tracking']->value){
?>
		<div class="tracking-report-project-tracking-wrap">
		<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['tracking']->value['userId'];?>
<?php $_tmp4=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["user"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getUserById($_tmp4), null, null);?>
		<?php $_smarty_tpl->tpl_vars["category"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getCategoryById($_smarty_tpl->tpl_vars['tracking']->value['categoryId']), null, null);?>
			<div class="tracking-report-project-tracking-date"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['tracking']->value['moment'];?>
<?php $_tmp5=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('module')->value->getDateFormatted($_tmp5);?>
</div>
			<div class="tracking-report-project-tracking-user"><?php echo $_smarty_tpl->getVariable('user')->value->getSurname();?>
, <?php echo $_smarty_tpl->getVariable('user')->value->getName();?>
</div>
			<div class="tracking-report-project-tracking-category"><?php echo $_smarty_tpl->getVariable('category')->value['title'];?>
</div>
			<div class="tracking-report-project-tracking-notice"><?php echo nl2br($_smarty_tpl->tpl_vars['tracking']->value['notice']);?>
</div>
			<div class="tracking-report-project-tracking-hours-wrap"<?php if ($_smarty_tpl->tpl_vars['tracking']->value['hoursCheckedUserId']<1){?>style="background-color:#e1b0e0"<?php }?>>
				<div class="tracking-report-project-tracking-hours"><?php if ($_smarty_tpl->tpl_vars['tracking']->value['hoursUsed']>0){?><?php echo $_smarty_tpl->tpl_vars['tracking']->value['hoursUsed'];?>
<?php }else{ ?>-<?php }?></div>
				<div class="tracking-report-project-tracking-hours"><?php if ($_smarty_tpl->tpl_vars['tracking']->value['hoursOB']>0){?><?php echo $_smarty_tpl->tpl_vars['tracking']->value['hoursOB'];?>
<?php }else{ ?>-<?php }?></div>
				<div class="tracking-report-project-tracking-hours"><?php if ($_smarty_tpl->tpl_vars['tracking']->value['hoursKV']>0){?><?php echo $_smarty_tpl->tpl_vars['tracking']->value['hoursKV'];?>
<?php }else{ ?>-<?php }?></div>							
				<div class="tracking-report-project-tracking-hours"><?php echo $_smarty_tpl->getVariable('module')->value->getNettoSecondsFormatted($_smarty_tpl->tpl_vars['tracking']->value['nettoSeconds']);?>
</div>				
			</div>
		</div>
	<?php }} ?>
	<div class="tracking-report-project-summary-wrap">
		<div class="tracking-report-project-sum"><?php echo $_smarty_tpl->getVariable('module')->value->getTrackingSumStd($_smarty_tpl->tpl_vars['project']->value['id']);?>
</div>
		<div class="tracking-report-project-sum"><?php echo $_smarty_tpl->getVariable('module')->value->getTrackingSumOb($_smarty_tpl->tpl_vars['project']->value['id']);?>
</div>
		<div class="tracking-report-project-sum"><?php echo $_smarty_tpl->getVariable('module')->value->getTrackingSumKv($_smarty_tpl->tpl_vars['project']->value['id']);?>
</div>
		<div class="tracking-report-project-sum"><?php echo $_smarty_tpl->getVariable('module')->value->getTrackingSumSecondsNetto($_smarty_tpl->tpl_vars['project']->value['id']);?>
</div>
	</div>
</div>
<?php }} ?>