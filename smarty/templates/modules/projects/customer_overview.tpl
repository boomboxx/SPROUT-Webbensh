<h1>{$pageHeadline}</h1>
<br />
<br />
<table class="resultset-table">
	<tr class="resultset-head">
		<td>Firma</td>
		<td>Bemerkung</td>
		<td>Aktiv</td>
		<td>&nbsp;</td>
	</tr>
	{foreach item=customer from=$results}
		<tr class="resultset-result-row">
			<td>{$customer.title}</td>
			<td>{$customer.notes}</td>
			<td>
				{if $customer.active==1}ja{else}nein{/if}
			</td>
			<td class="resultset-result-row-icons"><a href = "index.php?page=customerProjects&customerId={$customer.id}"><img src="../gfx/icons/famfam/book_go.png" title="Projekte des Kunden" /></a></td>
		</tr>	
	{/foreach}
</table>