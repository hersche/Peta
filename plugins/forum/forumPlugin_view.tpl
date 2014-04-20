{include file="{$folder}forumPlugin_menu.tpl"}
<link rel="stylesheet" type="text/css" href="{$folder}css/speech.css" />
<div class="example-right" style="margin-bottom:100px;">
    <table border="1" style="width:100%;">
        <tr>
            <td>
                <h3>{$threadTitle}</h3>
            </td>{if (($admin)||($ownuserid eq $userid))}
            <td colspan="2">
                   <a class="button edit" style="float: right;" href="plugin.php?plugin={$pluginId}&amp;action=editthread&amp;threadid={$threadid}">Edit</a>
            </td>{/if}</tr>
        <tr>
            <td colspan="3">{$threadText}</td>
        </tr>
        <hr />
        <tr>
            <td>Posted by
                <a href="profile.php?userid={$userid}">{$username}</a>
            </td>
            <td>
                <a href="plugin.php?plugin={$pluginId}&amp;action=reply&amp;threadid={$threadid}" class="button write">Reply to this topic!
                </a>
            </td>
            <td style="float: right;">Last change on {$threadage}</td>
        </tr>
    </table>

</div>
<div class="subThreads">
    {section name=id loop=$subthreads}
    <div class="rectangle-speech-border " style="margin-left: {$subthreads[id]->getPosition()}px; margin-top: 20px;">
        <table border="2" style="width:100%;">
            <tr>
                {if $subthreads[id]->getTitle() neq ""}
                <td>
                    <h3>{$subthreads[id]->getTitle()}</h3>
                </td>{/if} {if (($admin)||($ownuserid eq $subthreads[id]->getUserId()))}
                <td colspan="2">
                    <a style="float:right;" class="button edit" href="plugin.php?plugin={$pluginId}&amp;action=editthread&amp;threadid={$subthreads[id]->getId()}">
                        Edit</a>
                </td>{/if}
            </tr>
            <tr>
                <td colspan="3">{$subthreads[id]->getText()}</td>
            </tr>
            <tr>
                <td>Posted by
                    <a href="profile.php?userid={$subthreads[id]->getUserId()}">{$subthreads[id]->getUsername()}</a>
                </td>
                <td>
                    <a href="plugin.php?plugin={$pluginId}&amp;action=reply&amp;threadid={$subthreads[id]->getId()}" class="button write">Reply to this post</a>
                </td>
                <td>{$subthreads[id]->getEditCounter()} times editet!</td>
            </tr>
        </table>

    </div>
    {/section}
</div>
