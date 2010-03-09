<table>
	<form
		action="forum.php?action=savethread&amp;savemethod={$savemethod}&amp;threadid={$threadid}"
		method="post">
	<tr>
		<td>Your title</td>
		<td><input type="text" name="topictitle" value="{$title}" /></td>
	</tr>
	<tr>
		<td>Text</td>
		<td>
		<div style="border: 1px solid #ccc"><textarea dojoType="dijit.Editor"
			styleSheets="dojo/dojo/resources/dojo.css" name="topictext">{$text}
  </textarea></div>
		</td>
	</tr>
	<tr>
		<td><input type="submit" value="Send it!" /></td>
	</tr>
	</form>
</table>
