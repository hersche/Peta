{include file="header.tpl" title=Mainpage}
{include file="messagebox.tpl"}

<form method="POST" action="login.php">
<input type="text" name="username" />
<input type="password" name="password" />
<input type="submit" value="Login" />
</form>

{include file="footer.tpl"}