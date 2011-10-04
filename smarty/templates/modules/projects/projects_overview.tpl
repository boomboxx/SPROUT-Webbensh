<h1>{$pageHeadline}</h1>
<br />
<br />
<table class="resultset-table">
	<tr class="resultset-head">
		<td>Jobnummer</td>
		<td>Kunde</td>
		<td>Projektleitung</td>
		<td>&nbsp;</td>
	</tr>
	{foreach item=project from=$projects}
		<tr class="resultset-result-row">
			<td>{$project.jobnumber}</td>
			<td>{$project.customerTitle}</td>
			<td>&nbsp;</td>
			<td class="resultset-result-row-icons"><a href = "index.php?page=projectsDetails&customerId={$project.customerId}&projectId={$project.id}"><img src="../gfx/icons/famfam/book_go.png" title="Projekte des Kunden" /></a></td>
		</tr>	
	{/foreach}
</table>