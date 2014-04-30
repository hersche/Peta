
<div class="menu">
    <span style="width: 80%;">
    <a href="index.php" class="button home" style="margin-left:5px">Home</a>
	{foreach item=pI from=$allowedPluginInstances}
    {if $pI->getActive() == 1}
		<a class="button" href="plugin.php?plugin={$pI->getId()}" title="{$pI->getDescription()}">{$pI->getName()}</a>
    {/if}
    {/foreach}
    </span>
	{if {$user->getUsername()} != "Public"}
        <table style="float: right;">
		<tr><td><a href="profile.php" class="button profile">Profile</a></td>
		{if $admin}
			<td><a href="pluginEdit.php" class="button edit">Plugins</a></td></tr>
			<tr><td><a href="admin/index.php" class="button admin">Admin</a></td>
		{/if}
		<td><a href="login.php?action=logout" class="button logout">Logout</a></td></tr>
        </table>
	{/if}

</div>
    
