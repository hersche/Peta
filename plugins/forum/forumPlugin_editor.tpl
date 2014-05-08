<script type="text/javascript">
    require([
    "dijit/Editor",
    "dijit/_editor/plugins/FontChoice", // 'fontName','fontSize','formatBlock'
    "dijit/_editor/plugins/TextColor", "dijit/_editor/plugins/LinkDialog", "dijit/_editor/plugins/AlwaysShowToolbar"
]);
</script>
<style type="text/css">
@import "js/dojo/dojox/editor/plugins/resources/css/Preview.css";
</style>
<table>
    <form action="plugin.php?plugin={$pluginId}&amp;action=savethread&amp;savemethod={$savemethod}&amp;threadid={$threadid}" method="post">
        <tr>
            <td>Your title</td>
            <td>
                <input type="text" name="topictitle" value="{$title}" />
            </td>
        </tr>
     <tr>
       <td>Text</td>
       <td>
		<input type="hidden" name="topictext" id='editorSend' />
		<div data-dojo-type="dijit/Editor" class="editor" id="editor" data-dojo-props="{literal}extraPlugins:['foreColor','hiliteColor',{name:'dijit/_editor/plugins/FontChoice', command:'fontName', generic:true},'createLink', 'unlink', 'insertImage', 'dijit/_editor/plugins/AlwaysShowToolbar','preview'],onChange:function(){document.getElementById('editorSend').value = this.getValue();}"{/literal}>
			<p>{$text}</p>
		</div>
      </td>
    </tr>
        {if $admin}
        <tr>
            <td>Forumstate</td>
            <td>
                <select name="state" size="1">
                    <option value="0">Active</option>
                    <option value="1">Hidden</option>
                    <option value="2">Read only</option>
                </select>
            </td>
        </tr>
        {/if}
        <tr>
            <td>
                <input type="submit" value="Send it!"/>
            </td>
        </tr>
    </form>
</table>
