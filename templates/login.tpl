{include file="header.tpl" title=Login}
{include file="messagebox.tpl"}

<form method="POST" action="login.php">
<input type="text" name="username" />
<input type="password" name="password" />
<input type="submit" value="Login" />
</form>
<a href="login.php?action=register">Register</a>

{include file="footer.tpl"}