{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"}
<form action="profile.php?action=edit" method="post">
<h1>Profile</h1>
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
		<td>Password (blank = no change):</td>
		<td><input TYPE="password" SIZE="40" NAME="password" /></td>
	</tr>
	<tr>
		<td>Password validation:</td>
		<td><input TYPE="password" SIZE="40" NAME="confirmpassword" /></td>
	</tr>
</table>
<input type="submit" value="Edit now!" />
</form>
<p>Your roles:</p>
<ul>
		{section name=role loop=$roles} 
		<li>{$roles[role]}</li>
		 {/section}
</ul>
<h2><a href="profile.php">View Profile</a></h2>

{include file="footer.tpl"}