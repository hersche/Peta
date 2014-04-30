{include file="{$folder}templates/cardPlugin_menu.tpl"}
<h1>{$cardsettitle}</h1>&nbsp;
<a href="plugin.php?plugin={$pluginId}&action=editcardset&setid={$setid}" class="button edit">Edit questionset</a>
&nbsp;
<a href="plugin.php?plugin={$pluginId}&action=deletecardset&setid={$setid}" class="button delete">Delete questionset</a>
<a href="plugin.php?plugin={$pluginId}&action=singlecardset&amp;setid={$setid}&amp;nextquestion={$nextquestion}&amp;random=yes">Random start</a>
<a href="plugin.php?plugin={$pluginId}&action=singlecardset&amp;setid={$setid}&amp;nextquestion={$nextquestion}&amp;random=no">Random stop</a>
<p>{$cardsetdescription}</p>

<form action="plugin.php?plugin={$pluginId}&amp;action=singlecardset&amp;setid={$setid}&amp;nextquestion={$nextquestion}&amp;random={$random}" method="post">
    <table>
        <tr>
            <td>{$question}</td>
            <td>
                <input TYPE="text" SIZE="40" NAME="answer" value="" autofocus />
            </td>
        </tr>

        <tr>
            <td>
                <input type="submit" value="Give me a answer!" />
            </td>
            <td>
                <a href="plugin.php?plugin={$pluginId}&amp;action=editquestion&amp;setid={$setid}&amp;questionid={$questionid}">
                    <img alt="Edit question" src="img/edit.png" />
                </a>
                <a href="plugin.php?plugin={$pluginId}&amp;action=deletequestion&amp;setid={$setid}&amp;questionid={$questionid}">
                    <img "alt="Delete question " src="img/delete.png " /></a></td>
	</tr>

</table>
		<h3>Statistic-Chart</h3>
		{if $rightAnswered != 0.1 || $wrongAnswered !=0.1 }
		<div><b>The answer was {$rightAnswered}  times right answered and
		{$wrongAnswered} times wrong answered</b></div>
		<div dojoType="dojox.charting.widget.Chart2D" id="chart4"
			theme="dojox.charting.themes.Tom"
			style="width: 250px; height:250px;">

		<div class="plot" name="default" type="Pie" radius="150"
			fontColor="black" labelOffset="-12"></div>

		<div class="series" name="serie1"
			data="{$rightAnswered}, {$wrongAnswered}"
			legend="Where is the legend used?"></div>
		<div class="action" type="Tooltip"></div>
		<div class="action" type="MoveSlice" shift="2 "></div>
		</div>
		{else}
		<h2>Question not answered till now. Answer it!</h2>
		{/if}

</form>
