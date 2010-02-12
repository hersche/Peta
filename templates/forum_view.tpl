{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"} {include file="forum_menu.tpl"}
<h1>Forum</h1>
<div class="mainThread">
<h3>{$threadTitle}</h3>
<div>{$threadText}</div>
<div>Posted by {$username}</div>
<h4>Last change on {$threadage}</h4>
<a href="forum.php?action=reply&amp;threadid={$threadid}">Reply to this
topic!</a>
</div>
{section name=id loop=$subthreads}
<div class="subThread" style="margin-left: {$subthreads[id]->getPosition()}px;">
<h4>{$subthreads[id]->getTitle()}</h4>
<div>{$subthreads[id]->getText()}</div>
<div><a href="forum.php?action=reply&amp;threadid={$subthreads[id]->getId()}">Reply to this post</a></div>
<div>Posted by {$subthreads[id]->getUsername()}{$subthreads[id]->getPosition()}</div>
</div>
{/section} {include file="footer.tpl"}
