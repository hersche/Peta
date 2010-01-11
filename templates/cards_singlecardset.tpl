{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"} {include file="cards_menu.tpl"}
<h1>{$cardsettitle}</h1><h2><a href="cards.php?action=editcardset&setid={$setid}">(edit)</a></h2><h2><a href="cards.php?action=deletecardset&setid={$setid}">(delete)</a></h2>
<p>{$cardsetdescription}</p>
<form
	action="cards.php?action=singlecardset&setid={$setid}&nextquestion={$nextquestion}"
	method="post">
<table>
	<tr>
		<td>{$question}<a href="cards.php?action=editquestion&setid={$setid}&questionid={$questionid}">(edit)</a><a href="cards.php?action=deletequestion&setid={$setid}&questionid={$questionid}">(delete)</a></td>
		<td><input TYPE="text" SIZE="40" NAME="answer" value="" /></td>
	</tr>
	<tr>
		<td>Answer was {$right} times right and {$wrong} times wrong.</td>
	</tr>
	<tr>
		<td><input type="submit" value="Give me a answer!" /></td>
	</tr>

</table>

</form>
{include file="footer.tpl"}
