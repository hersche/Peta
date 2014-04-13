 {include file="messagebox.tpl"}
 {include file="{$folder}templates/cardPlugin_menu.tpl"}
<form action="plugin.php?plugin={$pluginId}&action=editquestion&amp;setid={$setid}&amp;questionid={$questionid}" method="post">
<table>
	<tr>
		<td>Question:</td>
		<td><input TYPE="text" SIZE="40" NAME="question"
			value="{$question}" /></td>
	</tr>

	<tr>
		<td>Realy want to edit the question?</td>
		<td><input type="checkbox" name="sure" /></td>
	</tr>
	<tr>
		<td><input type="submit" value="Edit now!" />
	
	</tr>
</table>

</form>