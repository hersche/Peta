{include file="header.tpl" title="Mainpage"} {include file="menu.tpl"} {include file="messagebox.tpl"}
<span>
    {section name=id loop=$plugins}
    <a class="button" href="plugin.php?plugin={$plugins[id]->getId()}" title="{$plugins[id]->getDescription()}">{$plugins[id]->getName()}</a>
    {/section}
</span>

<form action="plugin.php" method="get">
<label>RawPlugins</label>
	<select name="rawPluginName">
		{html_options values=$rawPluginNames output=$rawPluginNames}
	</select>
	<input type="hidden" value="getPluginEdit" name="action" />
	<input type="submit" value="Choose RawPlugin!" />
</form>
<div id="rawPlugin">
{if $rawPlugin}
	<h2>Your used rawPlugin: {$rawPlugin->getPath()}</h2>
	<h3>List of instanced plugins</h3>


		<ul>
			{foreach from=$instancedPluginList key=i item=instancedPlugin}
				<li><form action="plugin.php?action=editPluginInstance&pluginId={$instancedPlugin->getId()}" method="post">
					<label for={$instancedPlugin->getName()}></label>
					<label>Name</label><input type="text" name="instancePluginName" value="{$instancedPlugin->getName()}"/>
					<input type="submit" class="button edit" value="Edit" />
					<a href="plugin.php?action=pluginInstanceDelete&plugId={$instancedPlugin->getId()}" class="button delete">Delete</a> 
					<a href="plugin.php?plugin={$instancedPlugin->getId()}" class="button">Show Plug</a>
					
					<br /><label for="description">Description</label><textarea height="40px" name="instancePluginDescription">{$instancedPlugin->getDescription()}</textarea>
					
					<hr />
				</form></li>
			{/foreach}
		</ul>	

{/if}



{if $getPluginEdit}
<h1>Plugin erstellen</h1>
<form action="plugin.php" method="get">
		<table>
		
		<tr><td><label for="className">rawPluginName </label></td><td><input value="{$getPluginEdit['className']}" type="text" disabled  /></td></tr>
		<tr><td><label for="Path">rawPluginPath </label></td><td><input value="{$getPluginEdit['path']}" type="text" disabled  /></td></tr>
		<tr><td><label for="description">rawPluginDescription</label></td>
		<td><textarea name="rawPluginDescription" disabled>{$rawPluginDescription}</textarea></td></tr>
		
		</table>
		<hr />
		<table>
		<tr><td><label for="name">Name</label></td><td><input value="{$getPluginEdit['name']}" type="text" name="name" /></td></tr>

		<tr><td><label for="Active">Active</label></td><td><input value="1" name="active" type="checkbox" checked  /></td></tr>
		<tr><td><label for="description">Description</label></td>
		<td><textarea name="description"></textarea></td></tr>
		</table>
		<input type="hidden" value="createInstancedPlugin" name="action" />
		<input type="hidden" value="{$getPluginEdit['path']}" name="path" />
		<input type="hidden" value="{$getPluginEdit['className']}" name="className" />
	<input type="submit" value="Create instancedPlugin" />
</form>
{/if}
{/if} {$content} {include file="footer.tpl"}
