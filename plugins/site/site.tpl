
<script type="text/javascript">
    require([
    "dojo/parser",
    "dijit/Editor",
    "dijit/_editor/plugins/FontChoice", // 'fontName','fontSize','formatBlock'
    "dijit/_editor/plugins/TextColor", "dijit/_editor/plugins/LinkDialog", "dijit/_editor/plugins/AlwaysShowToolbar", "dijit/_editor/plugins/ViewSource", "dijit/_editor/plugins/FullScreen"
]);

function updateList() {
 var xhrArgs = {
 form:dojo.byId('siteOrderForm'),
 handleAs: "text",
 preventCache: true
 }
 var deferred = dojo.xhrPost(xhrArgs);
}
</script>

{if $siteList}
<div style="width: 34%;">
	<form action="plugin.php?plugin={$pluginId}&amp;doOrder=do" method="get" id="siteOrderForm">
		<ol dojoType="dojo.dnd.Source" data-dojo-id="dragAndDropList">
		{foreach $siteList as $site}
			<li  class="dojoDndItem"><a class="button" href="plugin.php?plugin={$pluginId}&amp;singleViewId={$site->id}">{$site->name}</a>
				<input type="hidden" name="siteOrder[]" value="{$site->id}" />
				<a style="margin-left:4%" href="plugin.php?plugin={$pluginId}&amp;singleEditViewId={$site->id}" class="button edit">Edit</a>
				<a style="margin-left:.5%" href="plugin.php?plugin={$pluginId}&amp;deleteSiteId={$site->id}" class="button delete">Delete</a></li>
		{/foreach}
		</ol>
	</form>
</div>
<form id="siteForm" action="plugin.php?plugin={$pluginId}&amp;createSiteId=do" method="POST">
<table style="width:90%">
<tr><td>Sitename</td><td><input name="siteName" type="text" placeholder="Enter sitename" autofocus></td></tr>
     <tr>
       <td>Text</td>
       <td>
		<input type="hidden" name="siteContent" id='editorSend' />
		<div style="border-style:solid; border-color:green;" data-dojo-type="dijit/Editor" id="editor" data-dojo-props="{literal}extraPlugins:['foreColor','hiliteColor',{name:'dijit/_editor/plugins/FontChoice', command:'fontName', generic:true},'createLink','viewsource', 'findreplace','fullscreen','dijit/_editor/plugins/AlwaysShowToolbar','preview',{name: 'LocalImage', uploadable: false, fileMask: '*.*'}],onChange:function(){document.getElementById('editorSend').value = this.getValue();}"{/literal}>
			<p>{$text}</p>
		</div>
      </td>
    </tr>
	 <tr>
        <td colspan="2">
		             <button id="submit"></button>
             <script>
        require(["dijit/form/Button", "dojo/domReady!"], function(Button) {
            var button = new Button({
				iconClass: "dijitEditorIcon dijitEditorIconSave",
				label: "Create site!",
                onClick: function(){ document.forms["siteForm"].submit(); }
            }, "submit");
            button.startup();
        });
    </script>
         </td>
     </tr>
	 </table>
</form>
{/if}

{if $singleEditSite}
<form id="siteForm" action="plugin.php?plugin={$pluginId}&amp;editSiteId={$singleEditSite->id}" method="POST">
<table style="width:90%">
<tr><td>Sitename</td><td><input type="text" name="siteName" value="{$singleEditSite->name}" /></td></tr>
<tr><td>Menupos</td><td><input type="range" name="siteOrder" min="1" max="10"></td></tr>
     <tr>
       <td>Text</td>
       <td>
		<input type="hidden" name="siteContent" id='editorSend' />
		<div data-dojo-type="dijit/Editor" id="editor" data-dojo-props="{literal}extraPlugins:['foreColor','hiliteColor',{name:'dijit/_editor/plugins/FontChoice', command:'fontName', generic:true},'createLink','viewsource', 'findreplace','fullscreen','dijit/_editor/plugins/AlwaysShowToolbar','preview',{name: 'LocalImage', uploadable: false, fileMask: '*.*'}],onChange:function(){document.getElementById('editorSend').value = this.getValue();}"{/literal}>
			<p>{$singleEditSite->content}</p>
		</div>
      </td>
    </tr>
	 <tr>
        <td colspan="2">
             <button id="submit"></button>
    <script>
        require(["dijit/form/Button", "dojo/domReady!"], function(Button) {
            var button = new Button({
				iconClass: "dijitEditorIconSave",
				label: "Send it!",
                onClick: function(){ document.forms["siteForm"].submit(); }
            }, "submit");
            button.startup();
        });
    </script>
         </td>
     </tr>
	 </table>
</form>


{/if}


{if $singleViewSite}<ul>
<div class="menu">
{foreach $siteListMenu as $site}
<a class="button view" href="plugin.php?plugin={$pluginId}&amp;singleViewId={$site->id}">{$site->name} </a>
{/foreach}
</div>
</ul>
{$singleViewSite->content}
{/if}
