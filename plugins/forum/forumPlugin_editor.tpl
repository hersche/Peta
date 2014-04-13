<script type="text/javascript">
{section name=dojo loop=$dojorequire}
dojo.require("{$dojorequire[dojo]}");
{/section}
</script>

<table>
	<form
		action="plugin.php?plugin={$pluginId}&amp;action=savethread&amp;savemethod={$savemethod}&amp;threadid={$threadid}"
		method="post">
	<tr>
		<td>Your title</td>
		<td><input type="text" name="topictitle" value="{$title}" /></td>
	</tr>
	<tr>
		<td>Text</td>
		<td>
		<div style="border: 1px solid #ccc"><textarea dojoType="dijit.Editor"
		lalalal
			styleSheets="js/dojo/dojo/resources/dojo.css" name="topictext">{$text}
  </textarea></div>
		</td>
	</tr>
	{if $admin}
	<tr>
		<td>Forumstate</td>
		<td><select name="state" size="1">
		<option value="0">Active</option>
		<option value="1">Hidden</option>
		<option value="2">Read only</option>
		</select></td>
	</tr>
	{/if}
	<tr>
		<td><input type="submit" value="Send it!" /></td>
	</tr>
	</form>
</table>
