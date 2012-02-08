<table>
	<tr>
		<td>Name:</td>
		<td><input TYPE="text" SIZE="40" NAME="cardsetname" value="{$cardsetname}" /></td>
	</tr>
	<tr>
		<td>Description:</td>
		<td><textarea rows="5" cols="20" name="cardsetdescripton" wrap="physical">{$cardsetdescription}</textarea></td>
	</tr>
	<tr>
		<td>Mode</td>
		<td><select name="mode" size="1">
			<option value="0">Text</option>
			<option value="1">Radio</option>
			<option value="2">Multiple answers</option>
		</select></td>
	</tr>
	<tr>
		<td>Realy want to create that set?</td>
		<td><input type="checkbox" name="sure" /></td>
	</tr>
	<tr>
		<td><input type="submit" value="Create now!" />
	
	</tr>
</table>