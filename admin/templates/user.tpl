{include file="header.tpl" title=Usermanagement}
{include file="menu.tpl"}
{include file="messagebox.tpl"}
<h2>Edit a user</h2>
<p>But please respect all the users which hasn't so much rights like you!</p>
<form action="user.php?action=edituser" method="post">
    <select name="editusername" size="1">
{section name=user loop=$users}
      <option>{$users[user]}</option>
{/section}
    </select>
    <input type="submit" value="Edit" />
    </form>
{include file="footer.tpl"}