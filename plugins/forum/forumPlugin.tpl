{include file="{$folder}forumPlugin_menu.tpl"}
<h1>Forum-Plugin</h1>

{if $threads}
<ul>
{section name=forum loop=$threads}
<table border="1">
<li><tr><td><a
	href="plugin.php?plugin={$pluginId}&amp;action=showthread&amp;threadid={$threads[forum]->getId()}">{$threads[forum]->getTitle()}</a></td><td>{$threads[forum]->getSubThreadCounter()} posts are there</td></tr></li>
</table>
{/section}

</ul>
{/if}
