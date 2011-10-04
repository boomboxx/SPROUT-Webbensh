<div class="content-head"><a href="index.php?page=customerProjects&customerId={$customer.id}" title="Alle Projekte des Kunden">{$customer.title}</a> – {$project.title} ({$project.jobnumber})</div>
<table>
	<tr>
		<td><span class="text-bold">Projektleitung:</span> {$project.manager->getSurname()}, {$project.manager->getName()}</td>
		<td width="30"></td>
		<td><span class="text-bold">Angelegt von:</span> {$project.setup->getSurname()}, {$project.setup->getName()}</td>
	</tr>
</table>
{* show budget and tracking only when admin *}
{if $smarty.session.userIsAdmin == true}
	<br />
	<br />
	<h3>Budget und Tracking</h3>
	<table>
		<tr>
			<td><span class="text-bold">Budget:</span> {$usedSum} von {$project.budget|intval} Euro</td>
			<td width="30"></td>
			<td><span class="budget-view text-bold">Aktuelle Budget-Auslastung:</span> <span class="percentage-view-red" style="width:{$percentRed}px"></span><span class="percentage-view-green" style="width:{$percentGreen}px"></span> {$percent} %</td>
		</tr>
	</table>
{/if}
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
	{foreach item=task from=$tasks}
		<tr class="resultset-result-row">
			<td>{$task.categoryTitle}</td>
			<td>{$task.title}</td>
			<td>{$task.hours}</td>
			<td>{$states[$task.stateId]['title']}</td>
			<td>
				{* get assigned user *}
				{$task.assignedUser->getSurname()}, {$task.assignedUser->getName()}
			</td>			
			<td class="resultset-result-row-icons"><a href = "index.php?page=projectsDetails&customerID={$customer.id}&projectId={$project.id}"><img src="../gfx/icons/famfam/book_edit.png" title="Task bearbeiten" /></a></td>
		</tr>	
	{/foreach}
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
					{foreach item=category from=$categories}
						<option value="{$category.id}">{$category.title}</option>
					{/foreach}
				</select><br /><br />
				<span class="text-bold">Zugewiesen an:</span><br />
				<select name="taskAssignedUserId">
					{foreach item=user from=$userlist}
						<option value="{$user.id}">{$user.name}</option>
					{/foreach}
				</select><br /><br />				
			</td>
			<td style="width:30px"></td>
			<td valign="top">
				<span class="text-bold">Erstellt am:</span><br />
				<input type="text" name="taskDateCreated" class="datepicker-init" maxlength="10" value="{$dateToday}" /><br /><br />
				<span class="text-bold">Erledigt am:</span><br />
				<input type="text" name="taskDateDone" class="datepicker-init" maxlength="10" value="{$dateToday}" /><br /><br />			
				<span class="text-bold">Stundenaufwand:</span><br />
				<input type="text" name="taskHours" maxlength="6" /><br /><br /><br />
				<input type="submit" name="taskSubmit" value="Task speichern" class="task-form-button" />
			</td>			
		</tr>
	</table>
	{* hidden fields *}
	<input type="hidden" name="page" value="{$smarty.request.page}" />
	<input type="hidden" name="customerId" value="{$smarty.request.customerId}" />
	<input type="hidden" name="projectId" value="{$smarty.request.projectId}" />
</form>