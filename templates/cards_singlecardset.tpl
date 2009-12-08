{include file="header.tpl" title=Cards}
{include file="messagebox.tpl"}
{include file="menu.tpl"}
{include file="cards_menu.tpl"}
<h1>{$cardsettitle}</h1>
<p>{$cardsetdescription}</p>
<form action="cards.php?action=singlecardset&setid={$setid}&nextquestion={$nextquestion}" method="post">
<table>
	<tr>
		<td>{$question}</td>
		<td><input TYPE="text" SIZE="40" NAME="answer" value="" /></td>
	</tr>

	<tr>
		<td><input type="submit" value="Give me a answer!" /></td></tr>

</table>

</form>
{include file="footer.tpl"}