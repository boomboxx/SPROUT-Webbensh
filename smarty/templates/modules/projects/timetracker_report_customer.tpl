{* get customer details *}
{assign var="customer" value=$module->getCustomerById({$smarty.request.customerId})}
<h1>{$pageHeadline} - {$customer.title}</h1>
<br />
<br />
<form method="post" action="index.php?page=timetrackerReportProject">
	Kunde: <select name="customerId" class="tracking-report-project-select-projects">
		{* get all active customer and display *}
		{assign var="customerList" value=$module->getActiveCustomer()}
		{foreach $customerList as $customerInList}
			<option value="{$customerInList.id}"{if $customerInList.id == $smarty.request.customerId} selected="selected"{/if}>{$customerInList.title}</option>
		{/foreach}
	</select>
	Zeitraum: <input type="text" name="trackreportProjectDateFrom" class="trackreportUserDate datepickerUi" value="" /> - <input type="text" name="trackreportProjectDateTill" class="trackreportUserDate datepickerUi" value="" />
	<input type="submit" value="aktualisieren" name=""trackingReportProjectSubmit" /> 
</form>
<br />
{* get all projects for customer and list them *}
{assign var="projects" value=$module->getProjectsByCustomerId({$customer.id})}
{foreach $projects as $project}
<br />
<div class="tracking-report-project-wrap">
	<div class="tracking-report-head-title"><a href="index.php?page=timetrackerReportProject&amp;projectId={$project.id}" title="Trackings zu diesem Project">{$project.jobnumber} - {$project.title}</a></div>
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
	{* Trackings ausgeben *}
	{assign var="trackings" value=$module->getTrackingsByProjectId({$project.id})}
	{foreach item=tracking from=$trackings}
		<div class="tracking-report-project-tracking-wrap">
		{assign var="user" value=$module->getUserById({$tracking.userId})}
		{assign var="category" value=$module->getCategoryById($tracking.categoryId)}
			<div class="tracking-report-project-tracking-date">{$module->getDateFormatted({$tracking.moment})}</div>
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
		<div class="tracking-report-project-sum">{$module->getTrackingSumStd($project.id)}</div>
		<div class="tracking-report-project-sum">{$module->getTrackingSumOb($project.id)}</div>
		<div class="tracking-report-project-sum">{$module->getTrackingSumKv($project.id)}</div>
		<div class="tracking-report-project-sum">{$module->getTrackingSumSecondsNetto($project.id)}</div>
	</div>
</div>
{/foreach}