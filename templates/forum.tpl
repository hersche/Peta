{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"} {include file="forum_menu.tpl"}
<h1>Forum</h1>

{if $threads}
<ul>
{section name=forum loop=$threads}
<table border="1">
<li><tr><td><a
	href="forum.php?action=showthread&amp;threadid={$threads[forum]->getId()}">{$threads[forum]->getTitle()}</a></td><td>{$threads[forum]->getSubThreadCounter()} posts are there</td></tr></li>
</table>
{/section}

</ul>
{/if}
 {include file="footer.tpl"}
