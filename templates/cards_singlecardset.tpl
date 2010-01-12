{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"} {include file="cards_menu.tpl"}
<h1>{$cardsettitle}</h1>
<h2><a href="cards.php?action=editcardset&setid={$setid}">(edit)</a></h2>
<h2><a href="cards.php?action=deletecardset&setid={$setid}">(delete)</a></h2>
<p>{$cardsetdescription}</p>
<form
	action="cards.php?action=singlecardset&amp;setid={$setid}&amp;nextquestion={$nextquestion}"
	method="post">
<table>
	<tr>
		<td>{$question}<a
			href="cards.php?action=editquestion&amp;setid={$setid}&amp;questionid={$questionid}">(edit)</a><a
			href="cards.php?action=deletequestion&setid={$setid}&questionid={$questionid}">(delete)</a></td>
		<td><input TYPE="text" SIZE="40" NAME="answer" value="" /></td>
	</tr>

	<tr>
		<td><input type="submit" value="Give me a answer!" /></td>
	</tr>
	<tr>
		<td>
		<h3>Statistic-Chart: How many was this question wrong answered and how
		many times was it right?</h3>
		<div id="wrongRightChart"
			style="width: 300px; height: 300px; margin-left: 40%;">
		
		</td>
	</tr>

</table>

</form>
{include file="footer.tpl"}
