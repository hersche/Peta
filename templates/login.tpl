{include file="header.tpl" title=Login} {include file="menu.tpl"} {include file="messagebox.tpl"}
<table>
<h1>Welcome to LearnCards. For full posibillitys, please log in!</h1>
	<form method="POST" action="login.php">
	
	
	<tr>
		<td>Username</td>
		<td><input type="text" name="username" /></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input type="password" name="password" /></td>
	</tr>
	<tr>
		<td><input type="submit" value="Login" /></td>
	</tr>


	</form>
</table>
<a onclick="showHide('register')" class="button" >Register</a>
<table id="register" style="display:none">
	<form method="POST" action="login.php?action=register">

	<tr>
		<td>Username:</td>
		<td><input type="text" name="username" /></td>
	</tr>
	<tr>
		<td>E-Mail:</td>
		<td><input type="text" name="email" /></td>
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
<a href="README">See details</a>
{include file="footer.tpl"}
