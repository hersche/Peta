{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"} {include file="forum_menu.tpl"}
<h1>Hallo Forum :)</h1>
<h3>{$threadTitle}</h3>
<div>{$threadText}</div>
<div>Posted by {$username}</div>
<h4>Last change on {$threadage}</h4>
<a href="forum.php?action=reply&amp;threadid={$threadid}">Reply to this
topic!</a>
{section name=id loop=$subthreads}
<h4>{$subthreads[id]->getTitle()}</h4>
<div>{$subthreads[id]->getText()}</div>
<div><a href="forum.php?action=reply&amp;threadid={$subthreads[id]->getId()}">Reply to this post</a></div>
<div>Posted by {$subthreads[id]->getUsername()}</div>
{/section} {include file="footer.tpl"}
