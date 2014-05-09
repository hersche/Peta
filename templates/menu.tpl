
<div class="menu">
    <div class="left">
    <a href="index.php" class="button home" style="margin-left:5px">Home</a>
	{foreach item=pI from=$allowedPluginInstances}
    {if $pI->getActive() == 1}
		<a class="button" href="plugin.php?plugin={$pI->getId()}" title="{$pI->getDescription()}">{$pI->getName()}</a>
    {/if}
    {/foreach}
    </div>
	{if {$user->getUsername()} != "Public"}
    <div class="right">
		<a href="profile.php" class="button profile">Profile</a>
		{if $admin}
			<a href="pluginEdit.php" class="button edit">Plugins</a>
			<a href="admin/index.php" class="button admin">Admin</a>
		{/if}
		<a href="login.php?action=logout" class="button logout">Logout</a>
	</div>
	{/if}
	<div class="clear"></div>
</div>
    
