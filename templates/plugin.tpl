{include file="header.tpl" title="Mainpage"} {include file="menu.tpl"} {include file="messagebox.tpl"}
<span>
    {section name=id loop=$plugins}
    <a class="button" href="plugin.php?plugin={$plugins[id]->getId()}">{$plugins[id]->getPluginName()}</a>
    {/section}
</span>


<div id="rawPlugin">
{if $rawPlugin}
{if $instancedPlugin}
<h1>{$rawPlugin->getName()}</h1>
<h1>{$rawPlugin->getPath()}</h1>
<h1>{$instancedPlugin->getPluginName()}</h1>
<h1>{$instancedPlugin->getDependensies()}</h1>
    <form action="" method="post">
		{foreach from=$instancedPluginList key=instancedPlugin item=instancedPlugin}
			<label for={$instancedPlugin->getName()}</label>
			<input type="text" name="instancePluginName" value={$instancedPlugin->getName()} size="50"/>
		{/foreach}
		
		<input type="submit" value="Submit" />
    </form>



{/if}{/if}

<form action="plugin.php" method="get">
	<select name="rawPluginName">
		{html_options values=$rawPluginNames output=$rawPluginNames}
	</select>
	<input type="hidden" value="getPluginEdit" name="action" />
	<input type="submit" value="Send it!" />
</form>

{if $getPluginEdit}
<h1>Plugin erstellen</h1>
<form action="plugin.php" method="get">
		
		<label for="name">Name</label><input value="{$getPluginEdit['name']}" disabled  /><br />
		<label for="Path">Path</label><input value="{$getPluginEdit['path']}" disabled  /><br />
		<label for="description">Description</label>
		<textarea name="description"></textarea>
		<input type="hidden" value="createInstancedPlugin" name="action" />
	<input type="submit" value="Submit" />
</form>
{/if}


<div>
{if ($plugin) }
<h1>{$plugin->getPluginName()} {$plugin->getIdentifier()}</h1>
{$plugin->start()} {else}
<ul>
    {section name=id loop=$plugins}
    <li>
        <a href="plugin.php?plugin={$plugins[id]->getId()}">{$plugins[id]->getPluginName()}</a>
    </li>
    {/section}
</ul>
</div>
{/if} {$content} {include file="footer.tpl"}
