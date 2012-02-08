{include file="header.tpl" title=Register} {include
file="messagebox.tpl"}
<table>
	<form method="POST" action="login.php?action=register">
	<tr>
		<td>Name:</td>
		<td><input type="text" name="name" /></td>
	</tr>
	<tr>
		<td>Username:</td>
		<td><input type="text" name="username" /></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input type="password" name="password" /></td>
	</tr>
	<tr>
		<td>Confirm password:</td>
		<td><input type="password" name="password2" /></td>
	</tr>
	<tr>
		<td><input type="submit" value="Register" /></td>
	</tr>
	</form>
</table>
<a href="login.php">Login</a>

{include file="footer.tpl"}
