<?php /* Smarty version Smarty-3.0.7, created on 2011-07-15 18:04:12
         compiled from "C:/xampp/htdocs/Projekte/000_001-autoactiva-zeittracker/Dev/smarty/templates\modules/projects/timetracker_report_project.tpl" */ ?>
<?php /*%%SmartyHeaderCode:171854e2064fc280fd9-66128621%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cededd3163d827412925dadf8c5ec6de2706607d' => 
    array (
      0 => 'C:/xampp/htdocs/Projekte/000_001-autoactiva-zeittracker/Dev/smarty/templates\\modules/projects/timetracker_report_project.tpl',
      1 => 1310745848,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '171854e2064fc280fd9-66128621',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<?php ob_start();?><?php echo $_REQUEST['projectId'];?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["project"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getProjectById($_tmp1), null, null);?>
<?php ob_start();?><?php echo $_smarty_tpl->getVariable('project')->value['customerId'];?>
<?php $_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["customer"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getCustomerById($_tmp2), null, null);?>
<h1><?php echo $_smarty_tpl->getVariable('pageHeadline')->value;?>
 - <?php echo $_smarty_tpl->getVariable('project')->value['jobnumber'];?>
 - <?php echo $_smarty_tpl->getVariable('project')->value['title'];?>
 // <a href="index.php?page=timetrackerReportCustomer&amp;customerId=<?php echo $_smarty_tpl->getVariable('customer')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('customer')->value['title'];?>
</a></h1>
<br />
<br />
<form method="post" action="index.php?page=timetrackerReportProject">
	Projekt: <select name="projectId" class="tracking-report-project-select-projects">
		<?php $_smarty_tpl->tpl_vars["projects"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getActiveProjects(), null, null);?>
		<?php  $_smarty_tpl->tpl_vars['project'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('projects')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['project']->key => $_smarty_tpl->tpl_vars['project']->value){
?>
			<option value="<?php echo $_smarty_tpl->tpl_vars['project']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['project']->value['id']==$_REQUEST['projectId']){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['project']->value['jobnumber'];?>
 - <?php echo $_smarty_tpl->tpl_vars['project']->value['title'];?>
</option>
		<?php }} ?>
	</select>
	Zeitraum: <input type="text" name="trackreportProjectDateFrom" class="trackreportUserDate datepickerUi" value="" /> - <input type="text" name="trackreportProjectDateTill" class="trackreportUserDate datepickerUi" value="" />
	<input type="submit" value="aktualisieren" name=""trackingReportProjectSubmit" /> 
</form>
<br />
<br />
<div class="tracking-report-project-wrap">
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
	<?php ob_start();?><?php echo $_REQUEST['projectId'];?>
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
			<div class="tracking-report-project-tracking-date"><a href="index.php?page=timetrackerReportUser&amp;trackreportUserDate=<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['tracking']->value['moment'];?>
<?php $_tmp5=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('module')->value->getDateFormatted($_tmp5);?>
"><?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['tracking']->value['moment'];?>
<?php $_tmp6=ob_get_clean();?><?php echo $_smarty_tpl->getVariable('module')->value->getDateFormatted($_tmp6);?>
</a></div>
			<div class="tracking-report-project-tracking-user"><?php echo $_smarty_tpl->getVariable('user')->value->getSurname();?>
, <?php echo $_smarty_tpl->getVariable('user')->value->getName();?>
</div>
			<div class="tracking-report-project-tracking-category"><?php echo $_smarty_tpl->getVariable('category')->value['title'];?>
</div>
			<div class="tracking-report-project-tracking-notice"><?php echo nl2br($_smarty_tpl->tpl_vars['tracking']->value['notice']);?>
</div>
			<div class="tracking-report-project-tracking-hours-wrap"<?php if ($_smarty_tpl->tpl_vars['tracking']->value['hoursCheckedUserId']<1){?>style="background-color:#e1b0e0"<?php }?>>
				<div class="tracking-report-project-tracking-hours"><?php echo $_smarty_tpl->tpl_vars['tracking']->value['hoursUsed'];?>
</div>
				<div class="tracking-report-project-tracking-hours"><?php echo $_smarty_tpl->tpl_vars['tracking']->value['hoursOB'];?>
</div>
				<div class="tracking-report-project-tracking-hours"><?php echo $_smarty_tpl->tpl_vars['tracking']->value['hoursKV'];?>
</div>			
			</div>
		</div>
	<?php }} ?>
	<div class="tracking-report-project-summary-wrap">
		<div class="tracking-report-project-sum"><?php echo $_smarty_tpl->getVariable('module')->value->getTrackingSumStd();?>
</div>
		<div class="tracking-report-project-sum"><?php echo $_smarty_tpl->getVariable('module')->value->getTrackingSumOb();?>
</div>
		<div class="tracking-report-project-sum"><?php echo $_smarty_tpl->getVariable('module')->value->getTrackingSumKv();?>
</div>
	</div>
</div>