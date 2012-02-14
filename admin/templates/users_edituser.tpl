{include file="header.tpl" title=Usermanagement} {include
file="menu.tpl"} {include file="messagebox.tpl"}
<form action="user.php?action=mkedit&userid={$userid}" method="post">
<table>
	<tr>
		<td>Name:</td>
		<td><input TYPE="text" SIZE="40" NAME="name" value="{$name}" /></td>
	</tr>
	<tr>
		<td>Username:</td>
		<td><input TYPE="text" SIZE="40" NAME="username" readonly="readonly"
			value="{$username}" /></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input TYPE="password" SIZE="40" NAME="password" /></td>
	</tr>
	<tr>
		<td>Password validation:</td>
		<td><input TYPE="password" SIZE="40" NAME="password2" /></td>
	</tr>
	<td>Userrole: </td>
	<td><select name="role" size="5">
		{section name=role loop=$roles} 
		  {section name=srole loop=$selectedRoles}
		    {if $selectedRoles[srole] eq $roles[role]}
		<option selected value="{$roles[role]->getId()}">{$roles[role]->getRole()}</option>
		{else}
		<option value="{$roles[role]->getId()}>{$roles[role]->getRole()}</option>
		{/if} {/section} {/section}
	</select>

	</tr>
	
	
	<tr>
		<td>Realy want to edit the user?</td>
		<td><input type="checkbox" name="sure" /></td>
	</tr>
	<tr>
		<td><input type="submit" value="Edit now!" /></td>
	
	</tr>
</table>

</form>
{include file="footer.tpl"}
