{include file="header.tpl" title=Cards}
{include file="messagebox.tpl"}
{include file="menu.tpl"}
{include file="cards_menu.tpl"}
<form action="cards.php?action=mkcreate" method="post">
<table>
	<tr>
		<td>{t}Cardset name:{/t}</td>
		<td><input TYPE="text" SIZE="40" NAME="cardsetname" value="" /></td>
	</tr>
	<tr>
		<td>{t}Cardset description:{/t}</td>
		<td><textarea NAME="cardsetdescription" value="" ></textarea></td>
	</tr>
	<tr>
		<td>{t}Question{/t}</td>
		<td><input TYPE="text" SIZE="40" NAME="question1" value="" /></td>
	</tr>
	<tr>
		<td>{t}Answer{/t}</td>
		<td><input TYPE="text" SIZE="40" NAME="answer1" value="" /></td>
	</tr>	
	<tr>
		<td>{t}Realy want to create that set?{/t}</td>
		<td><input type="checkbox" name="sure" /></td>
	</tr>
	<tr>
		<td><input type="submit" value="Create now!" />
	
	</tr>
</table>

</form>

{include file="footer.tpl"}