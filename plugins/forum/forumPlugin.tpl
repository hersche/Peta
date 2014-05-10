{include file="{$folder}forumPlugin_menu.tpl"} {if $threads}
<div style="margin-top:1%;">
	<table style="border: 1px solid gray;">	
		<tr><th>Topic</th><th>PostCounter</th></tr>
		{foreach $threads as $thread}

                <tr>
                    <td>
                        <a href="plugin.php?plugin={$pluginId}&amp;action=showthread&amp;threadid={$thread->getId()}">{$thread->getTitle()}</a>
                    </td>
                    <td>{$thread->getSubThreadCounter()} posts</td>
                </tr>
        {/foreach}
	</table>
</div>
{/if}
