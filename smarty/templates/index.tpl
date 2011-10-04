<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="de">
<head>
	<title>{$title}</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<link href="../css/base.css" rel="stylesheet" type="text/css" />
	<link href="../css/smoothness/jquery-ui-1.8.13.custom.css" rel="stylesheet" type="text/css" />
	{* load CSS files *}
	{foreach item=file from=$filesCSS}
		<link type="text/css" rel="stylesheet" href="../css/{$file}" />
	{/foreach}	
	<script type="text/javascript" src="../js/jquery-1.6.1.min.js"></script>
	<script type="text/javascript" src="../js/jquery-ui-1.8.13.custom.min.js"></script>
	<script type="text/javascript" src="../js/gui/gui.js"></script>
	{* load JS files *}
	{foreach item=file from=$filesJS}
		<script type="text/javascript" src="../js/{$file}"></script>
	{/foreach}
</head>
<body>
	<div class="head-wrap">
		<div class="content-inner" style="left:50%; margin-left:-{($pageContentSize/2)-30}px; width:{$pageContentSize-30}px">
			<div id="sprout-menu-button"><img src="../gfx/default/sprout-menu-button.png" alt="SPROUT Module" /></div>
			<div id="sprout-usermenu-wrap">
				<a href="index.php?page=logout"><img src="../gfx/icons/gui/logout.png" alt="Logout" title="Logout" /></a>
			</div>
		</div>
	</div>
	<div class="head-sub">
		<div class="content-inner" style="left:50%; margin-left:-{($pageContentSize/2)-30}px; width:{$pageContentSize-30}px">
			<div class="head-sub-module">{$pageHeadline}</div>
		</div>
	</div>
	<div id="sprout-menu" class="sprout-menu">
		{foreach from=$menuCategories item=menuCategory}
			<div class="sprout-menu-category">
				<strong>{$menuCategory.title}</strong>
				<ul>
					{foreach from=$menuCategory.items item=menuItem}
						<li><a href="index.php?page={$menuItem->getPageAlias()}">{$menuItem->getTitle()}</a></li>
					{/foreach}
				</ul>
			</div>
		{/foreach}
	</div>
	<div id="content-wrap" class="content-inner" style="left:50%; margin-left:-{($pageContentSize/2)-30}px; width:{$pageContentSize-30}px">
		{* include subtemplate *}
		{include file="{$template}.tpl"}
	</div>
	<!-- SYSTEM MESSAGE -->
	<div id="head-system-message"{if !empty($smarty.session.systemMessageText)} style="display:inline"{/if}>
		<div id="head-system-message-float" style="background-color:#{if $smarty.session.systemMessageType == "passed"}168f0a{else}e72020{/if}">
			{if !empty($smarty.session.systemMessageText)}{$smarty.session.systemMessageText}{/if}
		</div>
	</div>	
</body>
</html>