{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"}
<h1>Profile</h1>
<h2>Name: {$name}</h2>
<h2>Username: {$username}</h2>
{if $own}
<p>Your roles:</p>
<ul>
		{section name=role loop=$roles} 
		<li>{$roles[role]}</li>
		 {/section}
</ul>
<h2><a href="profile.php?action=edit">Edit</a></h2>
{/if}

{include file="footer.tpl"}