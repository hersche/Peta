{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"} {include file="forum_menu.tpl"}
<h1>Hallo Forum :)</h1>
{$show} {section name=forum loop=$threads}
<li><a
	href="forum.php?action=showthread&amp;setid={$threads[forum]->getId()}">{$threads[forum]->getTitle()}</a></li>
{/section} {include file="footer.tpl"}
