<?php /* Smarty version Smarty-3.0.7, created on 2011-09-10 13:16:19
         compiled from "F:/uwamp/www/projekte/BBX - Boomboxx/BBX1103-SWB - Sprout 0.2/Dev/smarty/templates\modules/projects/timetracker_report_user.tpl" */ ?>
<?php /*%%SmartyHeaderCode:267004e6b47032644a3-78669089%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '61348f01ef214a38720b5a27b9b2c37845b228a6' => 
    array (
      0 => 'F:/uwamp/www/projekte/BBX - Boomboxx/BBX1103-SWB - Sprout 0.2/Dev/smarty/templates\\modules/projects/timetracker_report_user.tpl',
      1 => 1311948805,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '267004e6b47032644a3-78669089',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<h1><?php echo $_smarty_tpl->getVariable('pageHeadline')->value;?>
</h1>
<br />
<br />
<form method="post" action="index.php?page=timetrackerReportUser" accept-charset="utf-8">
	<img src="/gfx/icons/famfam/clock_add.png" alt="sprout" title="Tracking erfassen" id="trackingAddIcon" /> Datum: <input type="text" name="trackreportUserDate" class="trackreportUserDate datepickerUi" value="<?php if (isset($_smarty_tpl->getVariable('pageRequest',null,true,false)->value['trackreportUserDate'])){?><?php echo $_smarty_tpl->getVariable('pageRequest')->value['trackreportUserDate'];?>
<?php }else{ ?><?php echo $_smarty_tpl->getVariable('module')->value->getDateToday();?>
<?php }?>" />
	<input type="submit" name="trackerreportDateSumbit" value="senden" /><br />
	<!-- TRACKING ADD / EDIT -->
	<div class="tracker-add-wrap">
		<div class="tracker-add-row-wrap">
			<span style="color:#ff0000">HINWEIS: Als Datum wird das oben darüber angegebene verwendet</span><br /><br />
			Jobnummer:
			<select name="trackingAddCustomerId" class="trackingAddCustomerId">
				<?php $_smarty_tpl->tpl_vars["items"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getActiveProjectsAndCustomer(), null, null);?>
				<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['projectid'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['jobnumber'];?>
 - <?php echo $_smarty_tpl->tpl_vars['item']->value['jobtitle'];?>
</option>
				<?php }} ?>
			</select>		
			Kategorie: 
			<select name="trackingAddCategoryId" class="trackingAddCategoryId">
				<?php $_smarty_tpl->tpl_vars["items"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getCategories(), null, null);?>
				<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
					<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</option>
				<?php }} ?>
			</select>		
			Stunden/Minuten: 
			<input type="text" maxlength="2" name="trackingAddHoursHours" class="trackingAddUsed" /><input type="text" maxlength="2" name="trackingAddHoursMinutes" class="trackingAddUsed" />
			Berechnung:
			<select name="trackingAddType" class="trackingAddType">
				<option value="std">Std.</option>
				<option value="ob">OB</option>
				<option value="kv">KV</option>
			</select>		
			<br /><br />
			Kommentar:<br />
			<textarea name="trackingAddComment" class="trackingAddComment"></textarea><br /><br />
			<input type="submit" name="trackingAddSubmit" value="speichern" />
		</div>
	</div>
</form>
<br />
<br />
<?php $_smarty_tpl->tpl_vars["users"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getActiveUsers(), null, null);?>
<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('users')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
	<div class="tracking-report-user-wrap">
		<div class="tracking-report-user-head-wrap">
			<div class="tracking-report-user-name"><?php echo $_smarty_tpl->getVariable('user')->value->getSurname();?>
, <?php echo $_smarty_tpl->getVariable('user')->value->getName();?>
</div>
			<div class="tracking-report-project-head-hours-wrap">
				<div class="tracking-report-project-head-hours">Std.</div>
				<div class="tracking-report-project-head-hours">OB</div>
				<div class="tracking-report-project-head-hours">KV</div>
				<div class="tracking-report-project-head-hours">Netto</div>
			</div>					
		</div>
		<?php $_smarty_tpl->tpl_vars["trackings"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getTrackingsByUserId($_smarty_tpl->getVariable('user')->value->getId()), null, null);?>
		<?php  $_smarty_tpl->tpl_vars['tracking'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('trackings')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['tracking']->key => $_smarty_tpl->tpl_vars['tracking']->value){
?>
			<?php $_smarty_tpl->tpl_vars["project"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getProjectById($_smarty_tpl->tpl_vars['tracking']->value['projectId']), null, null);?>
			<?php $_smarty_tpl->tpl_vars["customer"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getCustomerById($_smarty_tpl->getVariable('project')->value['customerId']), null, null);?>
			<?php $_smarty_tpl->tpl_vars["category"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getCategoryById($_smarty_tpl->tpl_vars['tracking']->value['categoryId']), null, null);?>
			
			<?php if ($_REQUEST['action']=="edit"&&$_REQUEST['trackingId']==$_smarty_tpl->tpl_vars['tracking']->value['id']){?>
				<a name="tracking<?php echo $_smarty_tpl->tpl_vars['tracking']->value['id'];?>
"></a>
				<form method="post" action="index.php?page=timetrackerReportUser" accept-charset="utf-8">
					<div class="tracking-report-user-tracking-wrap tracking-edit-green">
						<div class="tracking-report-user-tracking-details-wrap">
							<div class="tracking-report-user-tracking-project-edit">
								<select name="trackingEditCustomerId" class="trackingEditCustomerId">
									<?php $_smarty_tpl->tpl_vars["items"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getActiveProjectsAndCustomer(), null, null);?>
									<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['projectid'];?>
"<?php if ($_smarty_tpl->tpl_vars['item']->value['projectid']==$_smarty_tpl->tpl_vars['tracking']->value['projectId']){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['jobnumber'];?>
 - <?php echo $_smarty_tpl->tpl_vars['item']->value['jobtitle'];?>
</option>
									<?php }} ?>
								</select>							
							</div>
							<div class="tracking-report-user-tracking-category">
								<select name="trackingEditCategoryId" class="trackingEditCategoryId">
									<?php $_smarty_tpl->tpl_vars["items"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getCategories(), null, null);?>
									<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
										<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id'];?>
"<?php if ($_smarty_tpl->tpl_vars['tracking']->value['categoryId']==$_smarty_tpl->tpl_vars['item']->value['id']){?> selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['item']->value['title'];?>
</option>
									<?php }} ?>
								</select>							
							</div>
							<div class="tracking-report-project-tracking-edit-hours-wrap">
								Stunden/Minuten: 
								<?php ob_start();?><?php echo $_smarty_tpl->tpl_vars['tracking']->value['nettoSeconds'];?>
<?php $_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["hoursMinutes"] = new Smarty_variable($_smarty_tpl->getVariable('module')->value->getHoursAndMinutesByNettoSeconds($_tmp1), null, null);?>
								<input type="text" maxlength="2" name="trackingEditHoursHours" class="trackingAddUsed" value="<?php echo $_smarty_tpl->getVariable('hoursMinutes')->value['hours'];?>
" /><input type="text" maxlength="2" name="trackingEditHoursMinutes" class="trackingAddUsed" value="<?php echo $_smarty_tpl->getVariable('hoursMinutes')->value['minutes'];?>
" />
								Berechnung:
								<select name="trackingEditType" class="trackingAddType">
									<option value="std"<?php if ($_smarty_tpl->tpl_vars['tracking']->value['hoursUsed']>0){?> selected="selected"<?php }?>>Std.</option>
									<option value="ob"<?php if ($_smarty_tpl->tpl_vars['tracking']->value['hoursOB']>0){?> selected="selected"<?php }?>>OB</option>
									<option value="kv"<?php if ($_smarty_tpl->tpl_vars['tracking']->value['hoursKV']>0){?> selected="selected"<?php }?>>KV</option>
								</select>		
							</div>
							<input type="hidden" name="trackingEditId" value="<?php echo $_smarty_tpl->tpl_vars['tracking']->value['id'];?>
" />					
						</div>
						<div class="tracking-report-user-tracking-notice">
							<textarea name="trackingEditComment" class="trackingEditComment"><?php echo $_smarty_tpl->tpl_vars['tracking']->value['notice'];?>
</textarea>
						</div>
						<br />
						<input type="submit" name="trackingEditSubmit" value="speichern" />	<input type="button"  value="abbrechen" id="trackingEditCancel" />												
						<div class="tracking-actions-wrap">
							<?php if ($_SESSION['userIsAdmin']||$_SESSION['userId']==$_smarty_tpl->tpl_vars['tracking']->value['userId']){?>
								<a href="index.php?page=timetrackerReportUser&amp;trackingId=<?php echo $_smarty_tpl->tpl_vars['tracking']->value['id'];?>
&amp;action=edit#tracking<?php echo $_smarty_tpl->tpl_vars['tracking']->value['id'];?>
"><img src="/gfx/icons/famfam/clock_edit.png" alt="sprout" title="Tracking editieren" /></a>
							<?php }?>
							<?php if ($_SESSION['userIsAdmin']){?>
								<img src="/gfx/icons/famfam/clock_delete.png" alt="sprout" title="Tracking löschen" onclick="trackingDelete(<?php echo $_smarty_tpl->tpl_vars['tracking']->value['id'];?>
)" />
							<?php }?>					
						</div>
					</div>
				</form>
			<?php }else{ ?>
			
				<div class="tracking-report-user-tracking-wrap">
					<div class="tracking-report-user-tracking-details-wrap">
						<div class="tracking-report-user-tracking-customer"><a href="index.php?page=timetrackerReportCustomer&amp;customerId=<?php echo $_smarty_tpl->getVariable('customer')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('customer')->value['title'];?>
</a></div>
						<div class="tracking-report-user-tracking-project"><a href="index.php?page=timetrackerReportProject&amp;projectId=<?php echo $_smarty_tpl->getVariable('project')->value['id'];?>
"><?php echo $_smarty_tpl->getVariable('project')->value['jobnumber'];?>
 - <?php echo $_smarty_tpl->getVariable('project')->value['title'];?>
</a></div>
						<div class="tracking-report-user-tracking-category"><?php echo $_smarty_tpl->getVariable('category')->value['title'];?>
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
					<div class="tracking-report-user-tracking-notice"><?php echo nl2br($_smarty_tpl->tpl_vars['tracking']->value['notice']);?>
</div>
					<div class="tracking-actions-wrap">
						<?php if ($_SESSION['userIsAdmin']||$_SESSION['userId']==$_smarty_tpl->tpl_vars['tracking']->value['userId']){?>
							<a href="index.php?page=timetrackerReportUser&amp;trackingId=<?php echo $_smarty_tpl->tpl_vars['tracking']->value['id'];?>
&amp;action=edit#tracking<?php echo $_smarty_tpl->tpl_vars['tracking']->value['id'];?>
"><img src="/gfx/icons/famfam/clock_edit.png" alt="sprout" title="Tracking editieren" /></a>
						<?php }?>
						<?php if ($_SESSION['userIsAdmin']){?>
							<img src="/gfx/icons/famfam/clock_delete.png" alt="sprout" title="Tracking löschen" class="trackingDeleteIcon" onclick="trackingDelete(<?php echo $_smarty_tpl->tpl_vars['tracking']->value['id'];?>
)" />
						<?php }?>					
					</div>
				</div>
			<?php }?>			
		<?php }} ?>
		<div class="tracking-report-user-summary-wrap">
			<div class="tracking-report-project-sum"><?php echo $_smarty_tpl->getVariable('module')->value->getTrackingSumStd($_smarty_tpl->getVariable('user')->value->getId());?>
</div>
			<div class="tracking-report-project-sum"><?php echo $_smarty_tpl->getVariable('module')->value->getTrackingSumOb($_smarty_tpl->getVariable('user')->value->getId());?>
</div>
			<div class="tracking-report-project-sum"><?php echo $_smarty_tpl->getVariable('module')->value->getTrackingSumKv($_smarty_tpl->getVariable('user')->value->getId());?>
</div>
			<div class="tracking-report-project-sum"><?php echo $_smarty_tpl->getVariable('module')->value->getTrackingSumSecondsNetto($_smarty_tpl->getVariable('user')->value->getId());?>
</div>
		</div>
	</div>

<?php }} ?>
