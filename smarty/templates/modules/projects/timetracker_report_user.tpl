<h1>{$pageHeadline}</h1>
<br />
<br />
<form method="post" action="index.php?page=timetrackerReportUser" accept-charset="utf-8">
	<img src="/gfx/icons/famfam/clock_add.png" alt="sprout" title="Tracking erfassen" id="trackingAddIcon" /> Datum: <input type="text" name="trackreportUserDate" class="trackreportUserDate datepickerUi" value="{if isset($pageRequest.trackreportUserDate)}{$pageRequest.trackreportUserDate}{else}{$module->getDateToday()}{/if}" />
	<input type="submit" name="trackerreportDateSumbit" value="senden" /><br />
	<!-- TRACKING ADD / EDIT -->
	<div class="tracker-add-wrap">
		<div class="tracker-add-row-wrap">
			<span style="color:#ff0000">HINWEIS: Als Datum wird das oben darüber angegebene verwendet</span><br /><br />
			Jobnummer:
			<select name="trackingAddCustomerId" class="trackingAddCustomerId">
				{assign var="items" value=$module->getActiveProjectsAndCustomer()}
				{foreach $items as $item}
					<option value="{$item.projectid}">{$item.jobnumber} - {$item.jobtitle}</option>
				{/foreach}
			</select>		
			Kategorie: 
			<select name="trackingAddCategoryId" class="trackingAddCategoryId">
				{assign var="items" value=$module->getCategories()}
				{foreach $items as $item}
					<option value="{$item.id}">{$item.title}</option>
				{/foreach}
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
{* User ausgeben *}
{assign var="users" value=$module->getActiveUsers()}
{foreach item=user from=$users}
	<div class="tracking-report-user-wrap">
		<div class="tracking-report-user-head-wrap">
			<div class="tracking-report-user-name">{$user->getSurname()}, {$user->getName()}</div>
			<div class="tracking-report-project-head-hours-wrap">
				<div class="tracking-report-project-head-hours">Std.</div>
				<div class="tracking-report-project-head-hours">OB</div>
				<div class="tracking-report-project-head-hours">KV</div>
				<div class="tracking-report-project-head-hours">Netto</div>
			</div>					
		</div>
		{* Get all trackings for specified date *}
		{assign var="trackings" value=$module->getTrackingsByUserId($user->getId())}
		{foreach $trackings as $tracking}
			{assign var="project" value=$module->getProjectById($tracking.projectId)}
			{assign var="customer" value=$module->getCustomerById($project.customerId)}
			{assign var="category" value=$module->getCategoryById($tracking.categoryId)}
			
			{* Edit tracking *}
			{if $smarty.request.action == "edit" && $smarty.request.trackingId == $tracking.id}
				<a name="tracking{$tracking.id}"></a>
				<form method="post" action="index.php?page=timetrackerReportUser" accept-charset="utf-8">
					<div class="tracking-report-user-tracking-wrap tracking-edit-green">
						<div class="tracking-report-user-tracking-details-wrap">
							<div class="tracking-report-user-tracking-project-edit">
								<select name="trackingEditCustomerId" class="trackingEditCustomerId">
									{assign var="items" value=$module->getActiveProjectsAndCustomer()}
									{foreach $items as $item}
										<option value="{$item.projectid}"{if $item.projectid == $tracking.projectId} selected="selected"{/if}>{$item.jobnumber} - {$item.jobtitle}</option>
									{/foreach}
								</select>							
							</div>
							<div class="tracking-report-user-tracking-category">
								<select name="trackingEditCategoryId" class="trackingEditCategoryId">
									{assign var="items" value=$module->getCategories()}
									{foreach $items as $item}
										<option value="{$item.id}"{if $tracking.categoryId == $item.id} selected="selected"{/if}>{$item.title}</option>
									{/foreach}
								</select>							
							</div>
							<div class="tracking-report-project-tracking-edit-hours-wrap">
								Stunden/Minuten: 
								{assign var="hoursMinutes" value=$module->getHoursAndMinutesByNettoSeconds({$tracking.nettoSeconds})}
								<input type="text" maxlength="2" name="trackingEditHoursHours" class="trackingAddUsed" value="{$hoursMinutes.hours}" /><input type="text" maxlength="2" name="trackingEditHoursMinutes" class="trackingAddUsed" value="{$hoursMinutes.minutes}" />
								Berechnung:
								<select name="trackingEditType" class="trackingAddType">
									<option value="std"{if $tracking.hoursUsed > 0} selected="selected"{/if}>Std.</option>
									<option value="ob"{if $tracking.hoursOB > 0} selected="selected"{/if}>OB</option>
									<option value="kv"{if $tracking.hoursKV > 0} selected="selected"{/if}>KV</option>
								</select>		
							</div>
							<input type="hidden" name="trackingEditId" value="{$tracking.id}" />					
						</div>
						<div class="tracking-report-user-tracking-notice">
							<textarea name="trackingEditComment" class="trackingEditComment">{$tracking.notice}</textarea>
						</div>
						<br />
						<input type="submit" name="trackingEditSubmit" value="speichern" />	<input type="button"  value="abbrechen" id="trackingEditCancel" />												
						<div class="tracking-actions-wrap">
							{if $smarty.session.userIsAdmin || $smarty.session.userId == $tracking.userId}
								<a href="index.php?page=timetrackerReportUser&amp;trackingId={$tracking.id}&amp;action=edit#tracking{$tracking.id}"><img src="/gfx/icons/famfam/clock_edit.png" alt="sprout" title="Tracking editieren" /></a>
							{/if}
							{if $smarty.session.userIsAdmin}
								<img src="/gfx/icons/famfam/clock_delete.png" alt="sprout" title="Tracking löschen" onclick="trackingDelete({$tracking.id})" />
							{/if}					
						</div>
					</div>
				</form>
			{else}
			
				{* Just displaying tracking *}
				<div class="tracking-report-user-tracking-wrap">
					<div class="tracking-report-user-tracking-details-wrap">
						<div class="tracking-report-user-tracking-customer"><a href="index.php?page=timetrackerReportCustomer&amp;customerId={$customer.id}">{$customer.title}</a></div>
						<div class="tracking-report-user-tracking-project"><a href="index.php?page=timetrackerReportProject&amp;projectId={$project.id}">{$project.jobnumber} - {$project.title}</a></div>
						<div class="tracking-report-user-tracking-category">{$category.title}</div>
						<div class="tracking-report-project-tracking-hours-wrap"{if $tracking.hoursCheckedUserId < 1}style="background-color:#e1b0e0"{/if}>
							<div class="tracking-report-project-tracking-hours">{if $tracking.hoursUsed > 0}{$tracking.hoursUsed}{else}-{/if}</div>
							<div class="tracking-report-project-tracking-hours">{if $tracking.hoursOB > 0}{$tracking.hoursOB}{else}-{/if}</div>
							<div class="tracking-report-project-tracking-hours">{if $tracking.hoursKV > 0}{$tracking.hoursKV}{else}-{/if}</div>							
							<div class="tracking-report-project-tracking-hours">{$module->getNettoSecondsFormatted($tracking.nettoSeconds)}</div>			
						</div>					
					</div>
					<div class="tracking-report-user-tracking-notice">{$tracking.notice|nl2br}</div>
					<div class="tracking-actions-wrap">
						{if $smarty.session.userIsAdmin || $smarty.session.userId == $tracking.userId}
							<a href="index.php?page=timetrackerReportUser&amp;trackingId={$tracking.id}&amp;action=edit#tracking{$tracking.id}"><img src="/gfx/icons/famfam/clock_edit.png" alt="sprout" title="Tracking editieren" /></a>
						{/if}
						{if $smarty.session.userIsAdmin}
							<img src="/gfx/icons/famfam/clock_delete.png" alt="sprout" title="Tracking löschen" class="trackingDeleteIcon" onclick="trackingDelete({$tracking.id})" />
						{/if}					
					</div>
				</div>
			{/if}			
		{/foreach}
		<div class="tracking-report-user-summary-wrap">
			<div class="tracking-report-project-sum">{$module->getTrackingSumStd($user->getId())}</div>
			<div class="tracking-report-project-sum">{$module->getTrackingSumOb($user->getId())}</div>
			<div class="tracking-report-project-sum">{$module->getTrackingSumKv($user->getId())}</div>
			<div class="tracking-report-project-sum">{$module->getTrackingSumSecondsNetto($user->getId())}</div>
		</div>
	</div>

{/foreach}
