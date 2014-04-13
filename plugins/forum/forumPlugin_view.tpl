{include file="{$folder}forumPlugin_menu.tpl"}
<link rel="stylesheet" type="text/css" href="{$folder}css/speech.css" />
<div class="example-right" style="margin-bottom:100px;" >
<table border="1">
<tr><td colspan="2"><h3>{$threadTitle}</h3></td >{if (($admin)||($ownuserid eq $userid))}<td><h3><a  class="button edit" href="forum.php?action=editthread&amp;threadid={$threadid}">Edit</a></h3></td>{/if}</tr>
<tr><td colspan="3">{$threadText}</td></tr>
<hr />
<tr><td>Posted by <a href="profile.php?userid={$userid}">{$username}</a></td><td><a href="plugin.php?plugin={$pluginId}&amp;action=reply&amp;threadid={$threadid}">Reply to this
topic!</a></td><td>Last change on {$threadage}</td></tr>
</table>

</div>
<div class="subThreads">
{section name=id loop=$subthreads}
<div class="example-commentheading"
	style="margin-left: {$subthreads[id]->getPosition()}px; margin-top: 20px;">
<table border="2">
	<tr>
		{if $subthreads[id]->getTitle() neq ""}<td colspan="2"><h3>{$subthreads[id]->getTitle()}</h3></td>{/if}
		{if (($admin)||($ownuserid eq $subthreads[id]->getUserId()))}<td> <a class="button edit"
			href="plugin.php?plugin={$pluginId}&amp;action=editthread&amp;threadid={$subthreads[id]->getId()}">
		Edit</a> </td>{/if}
	</tr>
	<tr>
		<td colspan="3">{$subthreads[id]->getText()}</td>
	</tr>
	<tr>
		<td>Posted by <a href="profile.php?userid={$subthreads[id]->getUserId()}">{$subthreads[id]->getUsername()}</a></td>
		<td><a
			href="plugin.php?plugin={$pluginId}&amp;action=reply&amp;threadid={$subthreads[id]->getId()}">Reply
		to this post</a></td>
		<td>{$subthreads[id]->getEditCounter()} times editet!</td>
	</tr>
</table>

</div>
{/section}
</div>
