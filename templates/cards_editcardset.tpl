{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"} {include file="cards_menu.tpl"}
<form action="cards.php?action=editcardset&setid={$setid}" method="post">
<table>
	<tr>
		<td>Name:</td>
		<td><input TYPE="text" SIZE="40" NAME="cardsetname" value="{$cardsetname}" /></td>
	</tr>
	<tr>
		<td>Description:</td>
		<td><textarea rows="5" cols="20" name="cardsetdescripton" wrap="physical">{$cardsetdescription}</textarea></td>
	</tr>
	
		<tr>
		<td>Realy want to edit the cardset?</td>
		<td><input type="checkbox" name="sure" /></td>
	</tr>
	<tr>
		<td><input type="submit" value="Edit now!" />
	
	</tr>
</table>

</form>

{if $questions}
<h2>Edit questions of cardset {$cardsetname}</h2>
<ul>
{section name=question loop=$questions}
<li><a href="cards.php?action=editquestion&setid={$setid}&questionid={$questions[question]->getQuestionId()}" >Edit {$questions[question]->getQuestion()}</a></li>
{/section}
</ul>
{/if}
{include file="footer.tpl"}	
	