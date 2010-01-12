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

</table>
		<h3>Statistic-Chart: How many was this question wrong answered and how
		many times was it right?</h3>
		<div><b>The answer was {$rightAnswered}  times right answered and
		{$wrongAnswered} times wrong answered (0.1 means the answer is never answered!)</b></div>
		<div dojoType="dojox.charting.widget.Chart2D" id="chart4"
			theme="dojox.charting.themes.PurpleRain"
			style="width: 300px; height: 300px;">

		<div class="plot" name="default" type="Pie" radius="100"
			fontColor="black" labelOffset="-20"></div>

		<div class="series" name="serie1"
			data="{$rightAnswered}, {$wrongAnswered}"
			legend="&lt;em&gt;Custom&lt;/em&gt; legend"></div>
		<div class="action" type="Tooltip"></div>
		<div class="action" type="MoveSlice" shift="2"></div>
		</div>

</form>

{include file="footer.tpl"}
