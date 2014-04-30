
<div class="menu">
    <a href="index.php" class="button home">Home</a>
	
	{foreach item=pI from=$allowedPluginInstances}
    {if $pI->getActive() == 1}
		<a class="button" href="plugin.php?plugin={$pI->getId()}" title="{$pI->getDescription()}">{$pI->getName()}</a>
    {/if}
    {/foreach}
	{if {$user->getUsername()} != "Public"}
		<a href="profile.php" class="button profile">Profile</a>
		{if $admin}
			<a href="pluginEdit.php" class="button edit">Plugins</a>
			<a href="admin/index.php" class="button admin" style="float: right;">Admin</a>
		{/if}
		<a href="login.php?action=logout" class="button logout" style="float: right;">Logout</a>
	{/if}

</div>
    
