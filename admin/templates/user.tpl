{include file="header.tpl" title=Usermanagement}
{include file="menu.tpl"}
{include file="messagebox.tpl"}
    <select name="top5" size="1">
{section name=user loop=$users}
      <option>{$users[user]}</option>
{/section}
    </select>
{include file="footer.tpl"}