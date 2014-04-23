{include file="header.tpl" title=Cards} {include file="messagebox.tpl"} {include file="menu.tpl"} <h1>Profile</h1>
<h2>Username: {$username}</h2>
Customfields:
<ul>
    {foreach item=cm from=$customfields}
    <li>
        {$cm->getKey()}: {$cm->getValue()}
    </li>
    {/foreach}
</ul>
{if $own}
<p>
    Your roles:
</p>
<ul>
    {foreach item=role from=$roles}
    <li>
        {$role->getRole()}
    </li>
    {/foreach}
</ul>
<h2><a href="profile.php?action=edit" class="button edit" >Edit</a></h2>
{/if} {include file="footer.tpl"}