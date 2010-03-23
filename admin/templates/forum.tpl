{include file="header.tpl" title=Forummanagement}
{include file="menu.tpl"}
{include file="messagebox.tpl"}
<h2>Manage Forum</h2>
{section name=forum loop=$threads}
<li><a
	href="forum.php?action=showthread&amp;threadid={$threads[forum]->getId()}">{$threads[forum]->getTitle()}</a><a href="">Delete</a></li>
{/section}
{include file="footer.tpl"}