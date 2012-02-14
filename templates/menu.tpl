<div class="menu"><a href="index.php" class="button" >Home</a><a href="cards.php" class="button">Cards</a><a href="forum.php" class="button">Forum</a><a href="profile.php" class="button">My Profile</a><a
	href="login.php?action=logout" class="button">Logout</a>{if $admin}<a
	href="admin/index.php">Admin</a>{/if}		{section name=id loop=$plugins} 
		<a href="index.php?plugin={$plugins[id]->getId()}">{$plugins[id]->getPluginName()}</a>
		 {/section}</div>
