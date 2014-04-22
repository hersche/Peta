{include file="header.tpl" title="Mainpage"} {include file="menu.tpl"} {include file="messagebox.tpl"}
{* <span>
    {section name=id loop=$plugins}
    <a class="button" href="pluginEdit.php?plugin={$plugins[id]->getId()}" title="{$plugins[id]->getDescription()}">{$plugins[id]->getName()}</a>
    {/section}
</span> *}
{if $admin}
<form action="pluginEdit.php" method="get">
<label>RawPlugins</label>
	<select name="rawPluginName">
		{html_options values=$rawPluginNames output=$rawPluginNames}
	</select>
	<input type="submit" value="Choose RawPlugin!" />
</form>
{/if}

{if $instancedPluginList}
{if $rawPlugin and $admin}
<div id="rawPlugin">
	<h2>Your used rawPlugin: {$rawPlugin->getPath()}</h2>

	<h3>List of instanced plugins</h3>
		<ul>
		

			{foreach from=$instancedPluginList item=instancedPlugin}
				<li>
				<table>
				<form action="pluginEdit.php?action=editPluginInstance&pluginId={$instancedPlugin->getId()}&rawPluginName={$rawPlugin->getName()}" method="post">
					<tr><td><label for={$instancedPlugin->getName()}></label><label>Name</label><td><input type="text" name="instancePluginName" value="{$instancedPlugin->getName()}" class="dijitInputField"/></td></tr>
					<tr><td><label for="description">Description</label></td><td><textarea class="dijitTextArea" height="40px" name="instancePluginDescription">{$instancedPlugin->getDescription()}</textarea></td></tr>
				
					
						{foreach from=$instancedPlugin->getUsedRoles() item=usedRole}
							<tr><td>{$usedRole->getRole()}</td>
								<td><input type="checkbox" name="role_{$usedRole->getId()}" value="{$usedRole->getId()}" checked="checked" class="dijitCheckBox">
								<select name="access_{$usedRole->getId()}" class="dijitSelect">
									{html_options values=$usedRole->getAccessStringList() output=$usedRole->getAccessStringList() selected="{$usedRole->getAccesRightsString()}"}
								</select></td></tr>
						{/foreach}
			
						{foreach from=$instancedPlugin->getRestRoles() item=restRole}
							<tr><td>{$restRole->getRole()}</td>
								<td><input type="checkbox" name="role_{$restRole->getId()}" value="{$restRole->getId()}" class="dijitCheckBox">
								<select name="access_{$restRole->getId()}" class="dijitSelect">
									{html_options values=$restRole->getAccessStringList() output=$restRole->getAccessStringList()}
								</select></td></tr>
						{/foreach} 
					
						
					<tr><td><input type="submit" class="button edit" value="Edit" /></td>
					<td><a href="pluginEdit.php?action=pluginInstanceDelete&plugId={$instancedPlugin->getId()}" class="button delete">Delete</a> </td>
					<td><a href="plugin.php?plugin={$instancedPlugin->getId()}" class="button">Show Plug</a></td></tr>
				<tr><td><hr /></td></tr>
			</form>	
			</table>
			
		</li>

				
	{/foreach}	
</ul>	
		<h1>Plugin erstellen</h1>
			<form action="pluginEdit.php" method="get">
				<table>
					<tr><td><label for="className">rawPluginName </label></td><td><input value="{$getPluginEdit['className']}" type="text" disabled  /></td></tr>
					<tr><td><label for="Path">rawPluginPath </label></td><td><input value="{$instancedPlugin->getPath()}" type="text" disabled  /></td></tr>
					<tr><td><label for="description">rawPluginDescription</label></td>
					<td><textarea name="rawPluginDescription" disabled>{$rawPluginDescription}</textarea></td></tr>
		
				</table>
				<hr />
				<table>
					<tr><td><label for="name">Name</label></td><td><input value="{$instancedPlugin->getClassName()}" type="text" name="name" /></td></tr>
					<tr><td><label for="Active">Active</label></td><td><input value="1" name="active" type="checkbox" checked  /></td></tr>
					<tr><td><label for="description">Description</label></td>
					<td><textarea name="description"></textarea></td></tr>
				</table>
				<input type="hidden" value="createInstancedPlugin" name="action" />
				<input type="hidden" value="{$instancedPlugin->getPath()}" name="path" />
				<input type="hidden" value="{$instancedPlugin->getClassName()}" name="className" />
				<input type="submit" value="Create instancedPlugin" />
			</form>
{/if}
{/if}
{if $instancedPlugin}
				<table>
				<form action="pluginEdit.php?action=editPluginInstance&pluginId={$instancedPlugin->getId()}&editPluginId={$instancedPlugin->getId()}&rawPluginName={$rawPlugin->getName()}" method="post">
					<tr><td><label for={$instancedPlugin->getName()}></label><label>Name</label><td><input type="text" name="instancePluginName" value="{$instancedPlugin->getName()}"/></td></tr>
					<tr><td><label for="description">Description</label></td><td><textarea class="dijitTextArea" height="40px" name="instancePluginDescription">{$instancedPlugin->getDescription()}</textarea></td></tr>
				
					
						{foreach from=$instancedPlugin->getUsedRoles() key=i item=usedRole}
							<tr><td>{$usedRole->getRole()}</td>
								<td><input type="checkbox" name="role_{$usedRole->getId()}" value="{$usedRole->getId()}" checked="checked">
								<select name="access_{$usedRole->getId()}">
									{html_options values=$usedRole->getAccessStringList() output=$usedRole->getAccessStringList() selected="{$usedRole->getAccesRightsString()}"}
								</select></td></tr>
						{/foreach}
			
						{foreach from=$instancedPlugin->getRestRoles() key=i item=restRole}
							<tr><td>{$restRole->getRole()}</td>
								<td><input type="checkbox" name="role_{$restRole->getId()}" value="{$restRole->getId()}">
								<select name="access_{$restRole->getId()}">
									{html_options values=$restRole->getAccessStringList() output=$restRole->getAccessStringList()}
								</select></td></tr>
						{/foreach} 
					
						
					<tr><td><input type="submit" class="dijitButtonNode edit" value="Edit" /></td>
					<td><a href="pluginEdit.php?action=pluginInstanceDelete&plugId={$instancedPlugin->getId()}" class="button delete">Delete</a> </td>
					<td><a href="plugin.php?plugin={$instancedPlugin->getId()}" class="button">Show Plug</a></td></tr>
				<tr><td><hr /></td></tr>
			</form>	
			</table>
{/if}
 {$content} {include file="footer.tpl"}
