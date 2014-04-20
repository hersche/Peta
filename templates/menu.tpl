<div class="menu">
    <a href="index.php" class="button home">Home</a>
	
	{section name=id loop=$allowedPluginInstances}
		<a class="button" href="plugin.php?plugin={$allowedPluginInstances[id]->getId()}" title="{$allowedPluginInstances[id]->getDescription()}">{$allowedPluginInstances[id]->getName()}</a>
    {/section}
	{if {$user->getUsername()} != "Public"}
		<a href="profile.php" class="button profile">Profile</a>
		{if $admin}
			<a href="pluginEdit.php" class="button edit">Plugins</a>
			<a href="admin/index.php" class="button admin" style="float: right;">Admin</a>
		{/if}
		<a href="login.php?action=logout" class="button logout" style="float: right;">Logout</a>
	{/if}

</div>
    
