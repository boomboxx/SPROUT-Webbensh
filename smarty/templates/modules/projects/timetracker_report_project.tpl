{* get project details *}
{assign var="project" value=$module->getProjectById({$smarty.request.projectId})}
{assign var="customer" value=$module->getCustomerById({$project.customerId})}
<h1>{$pageHeadline} - {$project.jobnumber} - {$project.title} // <a href="index.php?page=timetrackerReportCustomer&amp;customerId={$customer.id}">{$customer.title}</a></h1>
<br />
<br />
<form method="post" action="index.php?page=timetrackerReportProject">
	Projekt: <select name="projectId" class="tracking-report-project-select-projects">
		{* get all active projects and display *}
		{assign var="projects" value=$module->getActiveProjects()}
		{foreach $projects as $project}
			<option value="{$project.id}"{if $project.id == $smarty.request.projectId} selected="selected"{/if}>{$project.jobnumber} - {$project.title}</option>
		{/foreach}
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
			<div class="tracking-report-project-head-hours">Netto</div>
		</div>
	</div>
	{* Trackings ausgeben *}
	{assign var="trackings" value=$module->getTrackingsByProjectId({$smarty.request.projectId})}
	{foreach item=tracking from=$trackings}
		<div class="tracking-report-project-tracking-wrap">
		{assign var="user" value=$module->getUserById({$tracking.userId})}
		{assign var="category" value=$module->getCategoryById($tracking.categoryId)}
			<div class="tracking-report-project-tracking-date"><a href="index.php?page=timetrackerReportUser&amp;trackreportUserDate={$module->getDateFormatted({$tracking.moment})}">{$module->getDateFormatted({$tracking.moment})}</a></div>
			<div class="tracking-report-project-tracking-user">{$user->getSurname()}, {$user->getName()}</div>
			<div class="tracking-report-project-tracking-category">{$category.title}</div>
			<div class="tracking-report-project-tracking-notice">{$tracking.notice|nl2br}</div>
			<div class="tracking-report-project-tracking-hours-wrap"{if $tracking.hoursCheckedUserId < 1}style="background-color:#e1b0e0"{/if}>
				<div class="tracking-report-project-tracking-hours">{if $tracking.hoursUsed > 0}{$tracking.hoursUsed}{else}-{/if}</div>
				<div class="tracking-report-project-tracking-hours">{if $tracking.hoursOB > 0}{$tracking.hoursOB}{else}-{/if}</div>
				<div class="tracking-report-project-tracking-hours">{if $tracking.hoursKV > 0}{$tracking.hoursKV}{else}-{/if}</div>		
				<div class="tracking-report-project-tracking-hours">{$module->getNettoSecondsFormatted($tracking.nettoSeconds)}</div>			
			</div>
		</div>
	{/foreach}
	<div class="tracking-report-project-summary-wrap">
		<div class="tracking-report-project-sum">{$module->getTrackingSumStd()}</div>
		<div class="tracking-report-project-sum">{$module->getTrackingSumOb()}</div>
		<div class="tracking-report-project-sum">{$module->getTrackingSumKv()}</div>
		<div class="tracking-report-project-sum">{$module->getTrackingSumSecondsNetto($user->getId())}</div>
	</div>
</div>