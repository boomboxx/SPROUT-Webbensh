<h1>Projekte für {$customer.title}</h1>
<br />
<br />
<table class="resultset-table">
	<tr class="resultset-head">
		<td>Jobnummer</td>
		<td>Bezeichnung</td>
		<td>Projektleitung</td>
		<td>Aktiv</td>
		<td>&nbsp;</td>
	</tr>
	{foreach item=project from=$projects}
		<tr class="resultset-result-row">
			<td>{$project.jobnumber}</td>
			<td>{$project.title}</td>
			<td>
				{* get user *}
				{$project.manager->getSurname()}, {$project.manager->getName()}
			</td>
			<td>
				{if $project.active==1}ja{else}nein{/if}
			</td>
			<td class="resultset-result-row-icons"><a href = "index.php?page=projectsDetails&customerId={$customer.id}&projectId={$project.id}"><img src="../gfx/icons/famfam/book_go.png" title="Details zum Projekt" /></a></td>
		</tr>	
	{/foreach}
</table>