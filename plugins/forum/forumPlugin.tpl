{include file="{$folder}forumPlugin_menu.tpl"} {if $threads}
<div style="margin-top:60px;">
    <ul>
        {section name=forum loop=$threads}
        <li>
            <table border="1">
                <tr>
                    <td>
                        <a href="plugin.php?plugin={$pluginId}&amp;action=showthread&amp;threadid={$threads[forum]->getId()}">{$threads[forum]->getTitle()}</a>
                    </td>
                    <td>{$threads[forum]->getSubThreadCounter()} posts are there</td>
                </tr>
            </table>
        </li>
        {/section}

    </ul>
</div>
{/if}
