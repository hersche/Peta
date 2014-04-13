{include file="messagebox.tpl"}
{include file="{$folder}templates/cardPlugin_menu.tpl"}
<form action="plugin.php?plugin={$pluginId}&action=editcardset&amp;setid={$setid}" method="post">
{include file="{$folder}templates/cardPlugin_cardsetmodify_widget.tpl"}

</form>

{if $questions}
<h2>Edit questions of cardset {$cardsetname}</h2>
<ul>
{section name=question loop=$questions}
<li><a href="plugin.php?plugin={$pluginId}&action=editquestion&amp;setid={$setid}&amp;questionid={$questions[question]->getQuestionId()}" >Edit {$questions[question]->getQuestion()}</a></li>
{/section}
</ul>
{/if}
	