{include file="header.tpl" title=Usermanagement} {include
file="menu.tpl"} {include file="messagebox.tpl"}
<form action="user.php?action=mkedit&userid={$userid}" method="post">
<table>

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
	<td><ul>
{section name=role loop=$roles}
{section name=srole loop=$selectedRoles}
{if $selectedRoles[srole] eq $roles[role]}
<li>{$roles[role]->getRole()} DEBUG-ID's:{$roles[role]->getId()}<input type="checkbox" name="role_{$roles[role]->getId()}" value="{$roles[role]->getId()}" checked="checked"></li>
{else}
<li>{$roles[role]->getRole()}  DEBUG-ID's:{$roles[role]->getId()}<input type="checkbox" name="role_{$roles[role]->getId()}" value="{$roles[role]->getId()}"></li>
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
