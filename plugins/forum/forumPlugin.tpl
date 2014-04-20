{include file="{$folder}forumPlugin_menu.tpl"} {if $threads}
<div style="margin-top:60px;">
	            <table border="1">
				
			<tr><th>Topic</th><th>PostCounter</th></tr>
		{foreach $threads as $thread}

                <tr>
                    <td>
                        <a href="plugin.php?plugin={$pluginId}&amp;action=showthread&amp;threadid={$thread->getId()}">{$thread->getTitle()}</a>
                    </td>
                    <td>{$thread->getSubThreadCounter()} posts are there</td>
                </tr>
        {/foreach}
</table>
</div>
{/if}
