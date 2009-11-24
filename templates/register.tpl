{include file="header.tpl" title=Register}
{include file="messagebox.tpl"}

<form method="POST" action="login.php?action=register">
Name: <input type="text" name="name" /><br />
Username: <input type="text" name="username" /><br />
Password: <input type="password" name="password" /><br />
Confirm password: <input type="password" name="password2" /><br />
<input type="submit" value="Register" />
</form>
<a href="login.php">Login</a>

{include file="footer.tpl"}