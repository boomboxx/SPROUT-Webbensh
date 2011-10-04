<?php /* Smarty version Smarty-3.0.7, created on 2011-06-29 12:09:49
         compiled from "C:/xampp/htdocs/Projekte/000_001-autoactiva-zeittracker/Dev/smarty/templates\modules/projects/projects_details.tpl" */ ?>
<?php /*%%SmartyHeaderCode:171474e0af9ed3271c3-27268713%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ddb0c9d303227164a14e431ff4485ce30ae6af9c' => 
    array (
      0 => 'C:/xampp/htdocs/Projekte/000_001-autoactiva-zeittracker/Dev/smarty/templates\\modules/projects/projects_details.tpl',
      1 => 1309342182,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '171474e0af9ed3271c3-27268713',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div class="content-head"><a href="index.php?page=customerProjects&customerId=<?php echo $_smarty_tpl->getVariable('customer')->value['id'];?>
" title="Alle Projekte des Kunden"><?php echo $_smarty_tpl->getVariable('customer')->value['title'];?>
</a> – <?php echo $_smarty_tpl->getVariable('project')->value['title'];?>
 (<?php echo $_smarty_tpl->getVariable('project')->value['jobnumber'];?>
)</div>
<table>
	<tr>
		<td><span class="text-bold">Projektleitung:</span> <?php echo $_smarty_tpl->getVariable('project')->value['manager']->getSurname();?>
, <?php echo $_smarty_tpl->getVariable('project')->value['manager']->getName();?>
</td>
		<td width="30"></td>
		<td><span class="text-bold">Angelegt von:</span> <?php echo $_smarty_tpl->getVariable('project')->value['setup']->getSurname();?>
, <?php echo $_smarty_tpl->getVariable('project')->value['setup']->getName();?>
</td>
	</tr>
</table>
<?php if ($_SESSION['userIsAdmin']==true){?>
	<br />
	<br />
	<h3>Budget und Tracking</h3>
	<table>
		<tr>
			<td><span class="text-bold">Budget:</span> <?php echo $_smarty_tpl->getVariable('usedSum')->value;?>
 von <?php echo intval($_smarty_tpl->getVariable('project')->value['budget']);?>
 Euro</td>
			<td width="30"></td>
			<td><span class="budget-view text-bold">Aktuelle Budget-Auslastung:</span> <span class="percentage-view-red" style="width:<?php echo $_smarty_tpl->getVariable('percentRed')->value;?>
px"></span><span class="percentage-view-green" style="width:<?php echo $_smarty_tpl->getVariable('percentGreen')->value;?>
px"></span> <?php echo $_smarty_tpl->getVariable('percent')->value;?>
 %</td>
		</tr>
	</table>
<?php }?>
<br />
<br />
<h3>Task-Übersicht</h3>
<table class="resultset-table" cellspacing="0" cellpadding="0">
	<tr class="resultset-head">
		<td>Kategorie</td>
		<td>Bezeichnung / Aufgabe</td>
		<td>Stunden</td>
		<td>Status</td>
		<td>Zugew. an</td>
		<td>&nbsp;</td>
	</tr>
	<?php  $_smarty_tpl->tpl_vars['task'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('tasks')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['task']->key => $_smarty_tpl->tpl_vars['task']->value){
?>
		<tr class="resultset-result-row">
			<td><?php echo $_smarty_tpl->tpl_vars['task']->value['categoryTitle'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['task']->value['title'];?>
</td>
			<td><?php echo $_smarty_tpl->tpl_vars['task']->value['hours'];?>
</td>
			<td><?php echo $_smarty_tpl->getVariable('states')->value[$_smarty_tpl->tpl_vars['task']->value['stateId']]['title'];?>
</td>
			<td>
				<?php echo $_smarty_tpl->getVariable('task')->value['assignedUser']->getSurname();?>
, <?php echo $_smarty_tpl->getVariable('task')->value['assignedUser']->getName();?>

			</td>			
			<td class="resultset-result-row-icons"><a href = "index.php?page=projectsDetails&customerID=<?php echo $_smarty_tpl->getVariable('customer')->value['id'];?>
&projectId=<?php echo $_smarty_tpl->getVariable('project')->value['id'];?>
"><img src="../gfx/icons/famfam/book_edit.png" title="Task bearbeiten" /></a></td>
		</tr>	
	<?php }} ?>
</table>
<br />
<h3>Neuer Task</h3><br />
<form name="taskForm" id="taskForm" method="post" accept-charset="utf-8" action="index.php">
	<table>
		<tr>
			<td valign="top">
				<span class="text-bold">Bez./Aufgabe:</span><br /><input type="text" name="taskTitle" maxlength="255" style="width:400px" /><br /><br />
				<span class="text-bold">Notiz:</span><br /><textarea  name="taskNotice" rows="5"style="width:400px" /></textarea><br />
			</td>
			<td style="width:30px"></td>
			<td valign="top">
				<span class="text-bold">Kategorie:</span><br />
				<select name="taskCategoryId">
					<?php  $_smarty_tpl->tpl_vars['category'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categories')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['category']->key => $_smarty_tpl->tpl_vars['category']->value){
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['category']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['category']->value['title'];?>
</option>
					<?php }} ?>
				</select><br /><br />
				<span class="text-bold">Zugewiesen an:</span><br />
				<select name="taskAssignedUserId">
					<?php  $_smarty_tpl->tpl_vars['user'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('userlist')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['user']->key => $_smarty_tpl->tpl_vars['user']->value){
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['user']->value['id'];?>
"><?php echo $_smarty_tpl->tpl_vars['user']->value['name'];?>
</option>
					<?php }} ?>
				</select><br /><br />				
			</td>
			<td style="width:30px"></td>
			<td valign="top">
				<span class="text-bold">Erstellt am:</span><br />
				<input type="text" name="taskDateCreated" class="datepicker-init" maxlength="10" value="<?php echo $_smarty_tpl->getVariable('dateToday')->value;?>
" /><br /><br />
				<span class="text-bold">Erledigt am:</span><br />
				<input type="text" name="taskDateDone" class="datepicker-init" maxlength="10" value="<?php echo $_smarty_tpl->getVariable('dateToday')->value;?>
" /><br /><br />			
				<span class="text-bold">Stundenaufwand:</span><br />
				<input type="text" name="taskHours" maxlength="6" /><br /><br /><br />
				<input type="submit" name="taskSubmit" value="Task speichern" class="task-form-button" />
			</td>			
		</tr>
	</table>
	<input type="hidden" name="page" value="<?php echo $_REQUEST['page'];?>
" />
	<input type="hidden" name="customerId" value="<?php echo $_REQUEST['customerId'];?>
" />
	<input type="hidden" name="projectId" value="<?php echo $_REQUEST['projectId'];?>
" />
</form>