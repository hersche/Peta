{include file="messagebox.tpl"} {include file="{$folder}templates/cardPlugin_menu.tpl"}
<h1>Add a question to {$setname}</h1>
<form action="plugin.php?plugin={$pluginId}&action=addquestion" method="post">
    <table>
        <tr>
            <td>Question</td>
            <td>
                <input TYPE="text" SIZE="40" NAME="question1" value="" />
            </td>
        </tr>
        <tr>
            <td>Answer</td>
            <td>
                <input TYPE="text" SIZE="40" NAME="answer1" value="" />
            </td>
        </tr>
        <tr>
            <td>Add to set</td>
            <td>
                <select name="cardset" size="1">
                    {section name=set loop=$cardsets}
                    <option value="{$cardsets[set]->getSetId()}">{$cardsets[set]->getSetName()}</option>
                    {/section}
                </select>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" value="Add now!" />
            </td>

    </table>

</form>
