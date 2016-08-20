{include file="header.tpl" title=Cards} {include file="messagebox.tpl"} {include file="menu.tpl"} 
<div id="content">
<h1>Profile</h1>
<h2>Username: {$username}</h2>
Customfields:
<ol class="customfieldlist">
    {foreach item=cm from=$customfields}
    <li class="customfield">
        {$cm->getKey()}: {$cm->getValue()}
    </li>
    {/foreach}
</ol>
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
    </div>
{/if} {include file="footer.tpl"}