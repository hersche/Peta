{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"} {include file="forum_menu.tpl"}
<h1>Forum</h1>

{if $threads}
<ul>
{section name=forum loop=$threads}

<li><a
	href="forum.php?action=showthread&amp;threadid={$threads[forum]->getId()}">{$threads[forum]->getTitle()}</a></li>
{/section}
</ul>
{/if}
 {include file="footer.tpl"}
