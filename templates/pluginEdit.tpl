{include file="header.tpl" title="Mainpage"} {include file="menu.tpl"} {include file="messagebox.tpl"}
<div id="content">
{if $admin}
<form action="pluginEdit.php" method="get">
    <label>RawPlugins</label>
    <select name="rawPluginName">
        {html_options values=$rawPluginNames output=$rawPluginNames selected=$smarty.get.rawPluginName }
    </select>
    <input type="submit" value="Choose RawPlugin!" />
</form>
{/if}

{if $admin eq True or $allowedAccess eq "Admin"}
{if $rawPlugin}
<div id="rawPlugin">
    <h2>Your used rawPlugin: {$rawPlugin->getPath()}</h2>
    {/if}
{if $instancedPluginList}
    <h3>List of instanced plugins</h3>
    <ul>

        {foreach from=$instancedPluginList item=instPlugin}
        <li>
            <table>
                <form action="pluginEdit.php?action=editPluginInstance&pluginId={$instPlugin->getId()}&rawPluginName={$rawPlugin->getName()}" method="post">
                    <tr>
                        <td><label for={$instPlugin->getName()}></label><label>Name</label><td>
                        <input type="text" name="instancePluginName" value="{$instPlugin->getName()}" class="dijitInputField"/>
                        </td>
                    </tr>
                        {if $rawPlugin->getPath()!=$instPlugin->getPath()}
                           <tr><td><input type="hidden" value="{$rawPlugin->getPath()}" name="editPath" /><p>pluginPath seems to be changed, restore with                               save</p></td></tr>
                        {/if}
                    <tr>
                        <td><label for="description">Description</label></td><td>                        <textarea class="dijitTextArea" height="40px" name="instancePluginDescription">{$instPlugin->getDescription()}</textarea></td>
                    </tr>

                    {foreach from=$instPlugin->getUsedRoles() item=usedRole}
                    <tr>
                        <td>{$usedRole->getRole()}</td>
                        <td>
                        <input type="checkbox" name="role_{$usedRole->getId()}" value="{$usedRole->getId()}" checked="checked" class="dijitCheckBox">
                        <select name="access_{$usedRole->getId()}" class="dijitSelect">
                            {html_options values=$usedRole->getAccessStringList() output=$usedRole->getAccessStringList() selected="{$usedRole->getAccesRightsString()}"}
                        </select></td>
                    </tr>
                    {/foreach}

                    {foreach from=$instPlugin->getRestRoles() item=restRole}
                    <tr>
                        <td>{$restRole->getRole()}</td>
                        <td>
                        <input type="checkbox" name="role_{$restRole->getId()}" value="{$restRole->getId()}" class="dijitCheckBox">
                        <select name="access_{$restRole->getId()}" class="dijitSelect">
                            {html_options values=$restRole->getAccessStringList() output=$restRole->getAccessStringList()}
                        </select></td>
                    </tr>
                    
                    {/foreach}
            <tr>
                <td><label for="Active">Active</label></td><td>
                {if $instPlugin->getActive()==1}
                    <input value="1" name="editActive" type="checkbox" checked  />
                {else}
                    <input value="1" name="editActive" type="checkbox"  />
                {/if}
                </td>
            </tr>
                    <tr>
                        <td>
                        <input type="submit" class="button edit" value="Edit" />
                        </td>
                        <td><a href="pluginEdit.php?action=pluginInstanceDelete&amp;plugId={$instPlugin->getId()}&amp;rawPluginName={$rawPlugin->getName()}" class="button delete">Delete</a></td>
                        <td><a href="plugin.php?plugin={$instPlugin->getId()}" class="button">Show Plug</a></td>
                    </tr>
                    <tr>
                        <td>
                        <hr />
                        </td>
                    </tr>
                </form>
            </table>

        </li>

        {/foreach}
    </ul>
    {/if}
    {if $rawPlugin}
    <h1>Plugin erstellen</h1>
    <form action="pluginEdit.php?rawPluginName={$rawPlugin->getName()}" method="post">
        <table>
            <tr>
                <td><label for="className">rawPluginName </label></td><td>
                <input value="{$rawPlugin->getName()}" type="text" disabled style="width:100%" />
                </td>
            </tr>
            <tr>
                <td><label for="Path">rawPluginPath </label></td><td>
                <input value="{$rawPlugin->getPath()}" type="text" style="width:100%" disabled  />
                </td>
            </tr>
            <tr>
                <td><label for="description">rawPluginDescription</label></td>
                <td>                <textarea name="rawPluginDescription" disabled>{$rawPluginDescription}</textarea></td>
            </tr>

        </table>
        <hr />
        <table>
            <tr>
                <td><label for="name">Name</label></td><td>
                <input value="" type="text" name="createName" placeholder="{$rawPlugin->getName()}" />
                </td>
            </tr>
            <tr>
                <td><label for="Active">Active</label></td><td>
                <input value="1" name="createActive" type="checkbox" checked  />
                </td>
            </tr>
            <tr>
                <td><label for="description">Description</label></td>
                <td>                <textarea name="createDescription"></textarea></td>
            </tr>
        </table>
        <input type="hidden" value="createInstancedPlugin" name="action" />
        <input type="hidden" value="{$rawPlugin->getPath()}" name="createPath" />
        <input type="hidden" value="{$rawPlugin->getName()}" name="createClassName" />
        <input type="submit" value="Create instancedPlugin" />
    </form>
    {/if}
    
    {/if}
    {if $instancedPlugin}
    <table>
        <form action="pluginEdit.php?action=editPluginInstance&pluginId={$instancedPlugin->getId()}&editPluginId={$instancedPlugin->getId()}&rawPluginName={$rawPlugin->getName()}" method="post">
            <tr>
                <td><label for={$instancedPlugin->getName()}></label><label>Name</label><td>
                <input type="text" name="instancePluginName" value="{$instancedPlugin->getName()}"/>
                </td>
            </tr>
            <tr>
                <td><label for="description">Description</label></td><td>                <textarea class="dijitTextArea" height="40px" name="instancePluginDescription">{$instancedPlugin->getDescription()}</textarea></td>
            </tr>

            {foreach from=$instancedPlugin->getUsedRoles() key=i item=usedRole}
            <tr>
                <td>{$usedRole->getRole()}</td>
                <td>
                <input type="checkbox" name="role_{$usedRole->getId()}" value="{$usedRole->getId()}" checked="checked">
                <select name="access_{$usedRole->getId()}">
                    {html_options values=$usedRole->getAccessStringList() output=$usedRole->getAccessStringList() selected="{$usedRole->getAccesRightsString()}"}
                </select></td>
            </tr>
            {/foreach}

            {foreach from=$instancedPlugin->getRestRoles() key=i item=restRole}
            <tr>
                <td>{$restRole->getRole()}</td>
                <td>
                <input type="checkbox" name="role_{$restRole->getId()}" value="{$restRole->getId()}">
                <select name="access_{$restRole->getId()}">
                    {html_options values=$restRole->getAccessStringList() output=$restRole->getAccessStringList()}
                </select></td>
            </tr>
            {/foreach}

            <tr>
                <td>
                <input type="submit" class="dijitButtonNode edit" value="Edit" />
                </td>
                <td><a href="pluginEdit.php?action=pluginInstanceDelete&plugId={$instancedPlugin->getId()}" class="button delete">Delete</a></td>
                <td><a href="plugin.php?plugin={$instancedPlugin->getId()}" class="button">Show Plug</a></td>
            </tr>
            <tr>
                <td>
                <hr />
                </td>
            </tr>
        </form>
    </table>
    {/if}
    {$content} {include file="footer.tpl"}
</div>