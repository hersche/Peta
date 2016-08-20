{include file="{$folder}templates/cardPlugin_menu.tpl"} {if $cardsets}
<ul>
    {section name=set loop=$cardsets}
    <li>
        <a class="button" href="plugin.php?plugin={$pluginId}&amp;action=singlecardset&amp;setid={$cardsets[set]->getSetId()}">{$cardsets[set]->getSetName()}</a>
    </li>
    {/section}
</ul>
{/if}
