{include file="messagebox.tpl"}
<script type="text/javascript">
    {section name=dojo loop=$dojorequire}
    dojo.require("{$dojorequire[dojo]}"); {/section}
</script>
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
                <input TYPE="text" SIZE="40" NAME="answer" value="" />
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
                <a href="plugin.php?plugin={$pluginId}&amp;action=deletequestion&setid={$setid}&questionid={$questionid}">
                    <img "alt="Delete question " src="img/delete.png " /></a></td>
	</tr>

</table>
		<h3>Statistic-Chart: How many was this question wrong answered and how
		many times was it right?</h3>
		{if $rightAnswered != "0.1 " || $wrongAnswered !="0.1 "}
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
		<div class="action" type="MoveSlice" shift="2 "></div>
		</div>
		{/if}
		{if $rightAnswered == "0.1" && $wrongAnswered =="0.1"}
		<h2>No Question answerd..</h2>
		{/if}

</form>
