{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"} {include file="cards_menu.tpl"}
<h1>Add a question to {$setname}</h1>
<form action="cards.php?action=addquestion" method="post">
<table>
	<tr>
		<td>{t}Question{/t}</td>
		<td><input TYPE="text" SIZE="40" NAME="question1" value="" /></td>
	</tr>
	<tr>
		<td>{t}Answer{/t}</td>
		<td><input TYPE="text" SIZE="40" NAME="answer1" value="" /></td>
	</tr>
	<tr>
		<td>{t}Add to set{/t}</td>
		<td><select name="cardset" size="1">
			{section name=set loop=$cardsets}
			<option value="{$cardsets[set]->getSetId()}">{$cardsets[set]->getSetName()}</option>
			{/section}
		</select></td>
	</tr>
	<tr>
		<td><input type="submit" value="{t}Add now!{/t}" /></td>

</table>

</form>
{include file="footer.tpl"}
