

{if $siteList}
<script type="text/javascript">
    require(["dojo/parser", "dijit/Editor", "dijit/_editor/plugins/FontChoice", // 'fontName','fontSize','formatBlock'
    "dijit/_editor/plugins/TextColor", "dijit/_editor/plugins/LinkDialog", "dijit/_editor/plugins/AlwaysShowToolbar", "dijit/_editor/plugins/ViewSource", "dijit/_editor/plugins/FullScreen"]);
</script>
<script type="text/javascript">
function updateList() {
        var xhrArgs = {
            form : dojo.byId('siteOrderForm'),
            handleAs : "text",
            preventCache : true
        }
        var deferred = dojo.xhrPost(xhrArgs);
    }
</script>
<div style="width: 34%;">
    <form action="plugin.php?plugin={$pluginId}&amp;doOrder=do" method="get" id="siteOrderForm">
        <ol dojoType="dojo.dnd.Source" data-dojo-id="dragAndDropList">
            {foreach $siteList as $site}
            <li  class="dojoDndItem">
                <a class="button" href="plugin.php?plugin={$pluginId}&amp;singleViewId={$site->id}">{$site->name}</a>
                <input type="hidden" name="siteOrder[]" value="{$site->id}" />
                <a style="margin-left:4%" href="plugin.php?plugin={$pluginId}&amp;singleEditViewId={$site->id}" class="button edit">Edit</a>
                <a style="margin-left:.5%" href="plugin.php?plugin={$pluginId}&amp;deleteSiteId={$site->id}" class="button delete">Delete</a>
            </li>
            {/foreach}
        </ol>
    </form>
</div>
{/if}

{if $newEnabled}
<form id="createSiteForm" action="plugin.php?plugin={$pluginId}" method="POST">
    <table style="width:90%">
        <tr>
            <td>Sitename</td><td>
            <input name="createSiteName" type="text" placeholder="Enter sitename" autofocus>
            </td>
        </tr>
        <tr>
            <td>Text</td>
            <td>
            <input type="hidden" name="createSiteContent" id='editorSend' />
            <div class="editor" data-dojo-type="dijit/Editor" id="editor" data-dojo-props="{literal}extraPlugins:['foreColor','hiliteColor',{name:'dijit/_editor/plugins/FontChoice', command:'fontName', generic:true},'createLink','viewsource', 'findreplace','fullscreen','dijit/_editor/plugins/AlwaysShowToolbar','preview',{name: 'LocalImage', uploadable: false, fileMask: '*.*'}],onChange:function(){document.getElementById('editorSend').value = this.getValue();}"{/literal}>
                <p>
                    {$text}
                </p>
            </div></td>
        </tr>
        <tr>
            <td colspan="2"><button id="submit"></button>
            <script>
                require(["dijit/form/Button", "dojo/domReady!"], function(Button) {
                    var button = new Button({
                        iconClass : "dijitEditorIcon dijitEditorIconSave",
                        label : "Create site!",
                        onClick : function() {
                            document.forms["createSiteForm"].submit();
                        }
                    }, "submit");
                    button.startup();
                });
            </script></td>
        </tr>
    </table>
</form>
{/if}

{if $singleEditSite}
<script type="text/javascript">
    require(["dojo/parser", "dijit/Editor", "dijit/_editor/plugins/FontChoice", // 'fontName','fontSize','formatBlock'
    "dijit/_editor/plugins/TextColor", "dijit/_editor/plugins/LinkDialog", "dijit/_editor/plugins/AlwaysShowToolbar", "dijit/_editor/plugins/ViewSource", "dijit/_editor/plugins/FullScreen"]);
</script>
<form id="editSiteForm" action="plugin.php?plugin={$pluginId}&amp;singleEditId={$singleEditSite->id}" method="POST">
    <table style="width:90%">
        <tr>
            <td>Sitename</td><td>
            <input type="text" name="editSiteName" value="{$singleEditSite->name}" placeholder="Enter sitename" autofocus />
            </td>
        </tr>
        <tr>
            <td>Text</td>
            <td>
            <input type="hidden" name="editSiteContent" id='editEditorSend' />
            <div data-dojo-type="dijit/Editor" class="editor" id="editEditor" data-dojo-props="{literal}extraPlugins:['foreColor','hiliteColor',{name:'dijit/_editor/plugins/FontChoice', command:'fontName', generic:true},'createLink','viewsource', 'findreplace','fullscreen','dijit/_editor/plugins/AlwaysShowToolbar','preview',{name: 'LocalImage', uploadable: false, fileMask: '*.*'}],onChange:function(){document.getElementById('editEditorSend').value = this.getValue();}"{/literal}>
                <p>
                    {$singleEditSite->content}
                </p>
            </div></td>
        </tr>
        <tr>
            <td colspan="2"><button id="submit"></button>
            <script>
                require(["dijit/form/Button", "dojo/domReady!"], function(Button) {
                    var button = new Button({
                        iconClass : "dijitEditorIconSave",
                        label : "Send it!",
                        onClick : function() {
                            require(["dijit/registry", "dojo/dom"], function(registry, dom) {
                                var hiddenF = dom.byId("editEditorSend");
                                var dEditor = registry.byNode(dom.byId("editEditor"));
                                hiddenF.value = dEditor.get('value');
                            });
							 
                            document.forms["editSiteForm"].submit();
                           
                        }
                    }, "submit");
                    button.startup();
                });
            </script></td>
        </tr>
    </table>
</form>

{/if}

{if $singleViewSite}
<ul>
    <div class="menu">
        {foreach $siteListMenu as $site}
        <a class="button view" href="plugin.php?plugin={$pluginId}&amp;singleViewId={$site->id}">{$site->name} </a>
        {/foreach}
    </div>
</ul>
{$singleViewSite->content}
{/if}
