{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"} {include file="forum_menu.tpl"}
<h1>Hallo Forum :)</h1>
<h3>{$threadTitle}</h3>
<div>{$threadText}</div>
<h4>Last change on {$threadage}</h4>
<a href="forum.php?action=reply&amp;threadid={$threadid}">Reply to this topic!</a>
{include file="footer.tpl"}
