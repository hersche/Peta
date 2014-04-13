{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"} {include file="cards_menu.tpl"}
<h1>Modify Cardset</h1>
<h2>Add question</h2>
<form action="cards.php?action=addquestion" method="post">
<table>
	<tr>
		<td>Question</td>
		<td><input TYPE="text" SIZE="40" NAME="question1" value="" /></td>
	</tr>
	<tr>
		<td>Answer</td>
		<td><input TYPE="text" SIZE="40" NAME="answer1" value="" /></td>
	</tr>
	<tr>
		<td>Add to set</td>
		<td><select name="cardset" size="1">
			{section name=set loop=$cardsets}
			<option value="{$cardsets[set]->getSetId()}">{$cardsets[set]->getSetName()}</option>
			{/section}
		</select></td>
	</tr>
	<tr>
		<td><input type="submit" value="Add now!" /></td>

</table>

</form>

<h2>Change name & description of a cardset</h2>
<form action="cards.php?action=editcardset" method="post"><select
	name="setid" size="1">
	{section name=set loop=$cardsets}
	<option value="{$cardsets[set]->getSetId()}">{$cardsets[set]->getSetName()}</option>
	{/section}
</select> <input type="submit" value="Edit cardset" /></form>

{include file="footer.tpl"}
