{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"}
<script type="text/javascript">
        require(["dojo/parser", "dijit/Editor", "dijit/_editor/plugins/FontChoice", // 'fontName','fontSize','formatBlock'
    "dijit/_editor/plugins/TextColor", "dijit/_editor/plugins/LinkDialog", "dijit/_editor/plugins/AlwaysShowToolbar", "dijit/_editor/plugins/ViewSource", "dijit/_editor/plugins/FullScreen"]);

    function updateCustomfieldList() {
        var xhrArgs = {
            form : dojo.byId('customfieldsOrderForm'),
            handleAs : "text",
            preventCache : true
        }
        var deferred = dojo.xhrPost(xhrArgs);
    }
</script>
<form action="profile.php?action=edit" method="post">
    <h1>Profile</h1>
    <table>
        <tr>
            <td>Username:</td>
            <td>
            <input TYPE="text" SIZE="40" NAME="username" readonly="readonly" value="{$username}" />
            </td>
        </tr>
        <tr>
            <td>Password (blank = no change):</td>
            <td>
            <input TYPE="password" SIZE="40" NAME="password" value="" />
            </td>
        </tr>
        <tr>
            <td>Password validation:</td>
            <td>
            <input TYPE="password" SIZE="40" NAME="password2" value="" />
            </td>
        </tr>
    </table>
    <input type="submit" value="Edit now!" />
</form>
<p>
    Your roles:
</p>
<ul>
    {foreach item=role from=$roles}
    <li>
        {$role->getRole()}
    </li>
    {/foreach}
</ul>
Customfields:
<form action="profile.php?doOrder=do" method="post" id="customfieldsOrderForm">
    <ol dojoType="dojo.dnd.Source" data-dojo-id="customfieldList" class="customfieldlist">
        {foreach item=cm from=$customfields}
        <li class="dojoDndItem customfield">
            {$cm->getKey()}: {$cm->getValue()} <a href="profile.php?action=edit&amp;editId={$cm->getId()}" class="button edit">Edit</a><a href="profile.php?deleteId={$cm->getId()}" class="button delete">Delete</a>
            <input type="hidden" name="customfieldsOrder[]" value="{$cm->getId()}" />
        </li>
        
        {/foreach}
    </ol>
</form>

<a href="profile.php" class="button view">View Profile</a>
<hr />
{if $editCustomField}
<h3>Edit Customfield</h3>
<form action="profile.php?action=edit&amp;actionEditId={$editCustomField->getId()}" id="editCustomfieldForm" method="POST">
    <table width="90%">
        <tr>
            <td colspan="1">Customfieldname</td><td>
            <input type="text" name="editKey" style="width:50%;" placeholder="Hobbys/Music/Contact..." value="{$editCustomField->getKey()}" />
            </td>
        </tr>
        <tr>
            <td>Text</td>
            <td>
            <input type="hidden" name="editValue" id='editorEditSend' />
            <div class="editor" data-dojo-type="dijit/Editor" id="editCustomfieldEditor" data-dojo-props="{literal}extraPlugins:['foreColor','hiliteColor',{name:'dijit/_editor/plugins/FontChoice', command:'fontName', generic:true},'createLink','unlink', 'insertImage','viewsource', 'findreplace','fullscreen','dijit/_editor/plugins/AlwaysShowToolbar','preview'],onChange:function(){document.getElementById('editorSend2').value = this.getValue();}"{/literal}>
                <p>
                    {$editCustomField->getValue()}
                </p>
            </div></td>
        </tr>
        <tr>
            <td><button id="submit"></button>
            <script>
                require(["dijit/form/Button", "dojo/domReady!"], function(Button) {
                    var button = new Button({
                        iconClass : "dijitEditorIcon dijitEditorIconSave",
                        label : "Edit customfield!",
                        onClick : function() {
                            require(["dijit/registry", "dojo/dom"], function(registry, dom) {
                                var hiddenF = dom.byId("editorEditSend");
                                var dEditor = registry.byNode(dom.byId("editCustomfieldEditor"));
                                hiddenF.value = dEditor.get('value');
                            });
                            document.forms["editCustomfieldForm"].submit();
                        }
                    }, "submit");
                    button.startup();
                });
            </script></td>
        </tr>
    </table>
</form>
{/if}
<hr />
<h3>Add Customfield</h3>
<form action="profile.php?action=edit" method="POST">
    <table width="90%">
        <tr>
            <td colspan="1">Customfieldname</td><td> <input type="text" name="newKey" style="width:50%; border="" placeholder="Hobbys/Music/Contact..."/>
            </td>
            </tr>
            <tr>
            <td>Text</td>
            <td>
            <input type="hidden" name="newValue" id='editorSend' />
            <div class="editor" data-dojo-type="dijit/Editor" id="editor" data-dojo-props="{literal}extraPlugins:['foreColor','hiliteColor',{name:'dijit/_editor/plugins/FontChoice', command:'fontName', generic:true},'createLink','unlink', 'insertImage','viewsource', 'findreplace','fullscreen','dijit/_editor/plugins/AlwaysShowToolbar','preview'],onChange:function(){document.getElementById('editorSend').value = this.getValue();}"{/literal}> <p></p></div></td>
        </tr>
        <tr>
            <td>
            <input type="submit" value="Create customfield!"/>
            </td>
        </tr>
    </table>
</form>

{include file="footer.tpl"}