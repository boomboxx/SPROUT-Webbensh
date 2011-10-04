{* get customer details *}
{assign var="datesArray" value=$module->getDates()}
<form method="post" action="index.php?page=timetrackerReportDefault">
	Datum:
	<input type="text" name="filterDateFrom" class="datepickerUi" value="{$datesArray.fromForm}" /> bis <input type="text" name="filterDateTo" class="datepickerUi" value="{$datesArray.toForm}" />
	Kunde: 
	{assign var="customerList" value=$module->getCustomerList()}
	<select name="filterCustomer">
		<option value="">-</option>
		{foreach $customerList as $customer}
		<option value="{$customer.id}"{if $smarty.request.filterCustomer == $customer.id} selected="selected"{/if}>{$customer.acronym} - {$customer.title}</option>
		{/foreach}
	</select>
	Projekt: 
	{assign var="projectsList" value=$module->getProjectsList()}
	<select name="filterProjects">
		<option value="">-</option>
		{foreach $projectsList as $project}
		<option value="{$project.id}"{if $smarty.request.filterProjects == $project.id} selected="selected"{/if}>{$project.jobnumber} - {$project.title}</option>
		{/foreach}
	</select>
	Mitarbeiter: 
	{assign var="usersList" value=$module->getActiveUsers()}
	<select name="filterUsers">
		<option value="">-</option>
		{foreach item=user from=$usersList}	
		<option value="{$user->getId()}"{if $smarty.request.filterUsers == $user->getId()} selected="selected"{/if}>{$user->getSurname()}, {$user->getName()}</option>
		{/foreach}
	</select>	
	Kategorie: 
	{assign var="categoriesList" value=$module->getCategoriesList()}
	<select name="filterCategories">
		<option value="">-</option>
		{foreach $categoriesList as $category}
		<option value="{$category.id}"{if $smarty.request.filterCategories == $category.id} selected="selected"{/if}>{$category.title}</option>
		{/foreach}
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
	{assign var="trackings" value=$module->getTrackings()}
	{foreach $trackings as $tracking}
		{assign var="project" value=$module->getProject($tracking.projectId)}
		{assign var="category" value=$module->getCategory($tracking.categoryId)}
	<tr title="{$tracking.id}">
		<td>
			{$tracking.customerAcronym} - {$tracking.customerTitle}			
		</td>
		<td>
			{$tracking.projectJobnumber} - {$tracking.projectTitle}
		</td>
		<td>
			{$module->getDateFormatted({$tracking.moment})}
		</td>
		<td>
			{assign var="user" value=$module->getUser($tracking.userId)}
			{$user->getSurname()}, {$user->getName()}
		</td>
		<td>
			{$tracking.categoryTitle}
		</td>
		<td class="right-align">
			{if $tracking.hoursUsed > 0}{$tracking.hoursUsed}{else}-{/if}
		</td>
		<td class="right-align">
			{if $tracking.hoursOB > 0}{$tracking.hoursOB}{else}-{/if}
		</td>
		<td class="right-align">
			{if $tracking.hoursKV > 0}{$tracking.hoursKV}{else}-{/if}
		</td>
		<td class="right-align">
			{$module->getNettoSecondsFormatted($tracking.nettoSeconds)}
		</td>
	</tr>
	{/foreach}
	{assign var="trackingsSums" value=$module->getTrackingsSums()}
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
			{if $trackingsSums.sumUsed > 0}{$trackingsSums.sumUsed}{else}-{/if}
		</td>
		<td class="right-align">
			{if $trackingsSums.sumOB > 0}{$trackingsSums.sumOB}{else}-{/if}
		</td>
		<td class="right-align">
			{if $trackingsSums.sumKV > 0}{$trackingsSums.sumKV}{else}-{/if}
		</td>
		<td class="right-align">
			{if $trackingsSums.sumNettoSeconds > 0}{$module->getNettoSecondsFormattedSum($trackingsSums.sumNettoSeconds)}{else}-{/if}
			
		</td>
	</tr>	
</table>
