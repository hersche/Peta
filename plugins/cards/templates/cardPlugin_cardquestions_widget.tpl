
<form method="post"
	action="cards.php?action=editquestion&amp;setid={$setid}&amp;nrofquestions={$nrofquestions}">
<table>
	{section name=questions loop=$nrofquestions }
	<tr>
		<td>Question</td>
		<td><input name="question{$smarty.section.questions.index}" value=""
			type="text" /></td>
		<td>Answer</td>
		<td><input name="answer{$smarty.section.questions.index}" value=""
			type="text" /></td>
	</tr>
	{/section}
</table>
<input type="submit" value="Send!" /></form>
<a href="plugin.php?plugin={$pluginId}&action=create&amp;nrofquestions={$nrofquestions+1}">+</a>
<a href="plugin.php?plugin={$pluginId}&action=create&amp;nrofquestions={$nrofquestions-1}">-</a>