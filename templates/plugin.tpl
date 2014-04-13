{include file="header.tpl" title="Mainpage"} {include file="menu.tpl"}
{include file="messagebox.tpl"}
<span>
{section name=id loop=$plugins} 
		<a href="plugin.php?plugin={$plugins[id]->getId()}">{$plugins[id]->getPluginName()}</a>
		 {/section}
</span>

{if ($plugin) } 
<h1>{$plugin->getPluginName()}</h1>
{$plugin->start()}
 {else}
  <ul>
 {section name=id loop=$plugins} 
	<li>	<a href="plugin.php?plugin={$plugins[id]->getId()}">{$plugins[id]->getPluginName()}</a></li>
		 {/section}
		  </ul>
 {/if}



{$content}
{include file="footer.tpl"}
