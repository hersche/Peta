{include file="header.tpl" title="Mainpage"} {include file="menu.tpl"} {include file="messagebox.tpl"}
{* <span> {section name=id loop=$plugins} <a class="button" href="plugin.php?plugin={$plugins[id]->getId()}" title="{$plugins[id]->getDescription()}">{$plugins[id]->getName()}</a> {/section} </span> *}

<div id="content">
    {if ($plugin) }
    <h1>{$pluginInstance->getName()} </h1><h5>{if $allowedAccess == "Admin"}<a class="button edit" href="pluginEdit.php?rawPluginName={$pluginInstance->getClassName()}&editPluginId={$pluginInstance->getId()}">"Edit Plugin (your admin here)</a>{/if}</h5>
    {$pluginContent}
</div>
{/if} {$content} {include file="footer.tpl"}
