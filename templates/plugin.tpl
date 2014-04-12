{include file="header.tpl" title="Mainpage"} {include file="menu.tpl"}
{include file="messagebox.tpl"}
<span>
{section name=id loop=$plugins} 
		<a href="plugin.php?plugin={$plugins[id]->getId()}">{$plugins[id]->getPluginName()}</a>
		 {/section}
</span>
<h1>Welcome to the plugin-stuff</h1>
{if ($plugin) } 
<ul><li>Name: {$plugin->getPluginName()}</li>
<li>Start/Content: {$plugin->start()}</li>
<li>Deps: {$plugin->getDependensies()}</li>
</ul>
 {/if}
</ul>
{$content}
{include file="footer.tpl"}
