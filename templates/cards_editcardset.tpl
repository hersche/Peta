{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"} {include file="cards_menu.tpl"}
<form action="cards.php?action=editcardset&amp;setid={$setid}" method="post">
{include file="cards_cardsetmodify_widget.tpl"}

</form>

{if $questions}
<h2>Edit questions of cardset {$cardsetname}</h2>
<ul>
{section name=question loop=$questions}
<li><a href="cards.php?action=editquestion&amp;setid={$setid}&amp;questionid={$questions[question]->getQuestionId()}" >Edit {$questions[question]->getQuestion()}</a></li>
{/section}
</ul>
{/if}
{include file="footer.tpl"}	
	