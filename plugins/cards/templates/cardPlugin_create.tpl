{include file="messagebox.tpl"} {include file="{$folder}templates/cardPlugin_menu.tpl"}
<form action="plugin.php?plugin={$pluginId}&action=mkcreatecardset&amp;nrofquestions={$nrofquestions}" method="post">
    {include file="{$folder}templates/cardPlugin_cardsetmodify_widget.tpl"}
    <table>
        {section name=questions loop=$nrofquestions }
        <tr>
            <td>Question</td>
            <td>
                <input name="question{$smarty.section.questions.index}" value="" type="text" />
            </td>
            <td>Answer</td>
            <td>
                <input name="answer{$smarty.section.questions.index}" value="" type="text" />
            </td>
        </tr>
        {/section}
    </table>
    <a href="plugin.php?plugin={$pluginId}&action=create&amp;nrofquestions={$nrofquestions+1}">+</a>
    <a href="plugin.php?plugin={$pluginId}&action=create&amp;nrofquestions={$nrofquestions-1}">-</a>
</form>



