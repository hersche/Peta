
<script type="text/javascript">
    require([
    "dojo/parser",
    "dijit/Editor",
    "dijit/_editor/plugins/FontChoice", // 'fontName','fontSize','formatBlock'
    "dijit/_editor/plugins/TextColor", "dijit/_editor/plugins/LinkDialog", "dijit/_editor/plugins/AlwaysShowToolbar", "dijit/_editor/plugins/ViewSource", "dijit/_editor/plugins/FullScreen"
]);
</script>
<style type="text/css">
@import "js/dojo/dojox/editor/plugins/resources/css/Preview.css";
@import "js/dojo/dojox/form/resources/FileUploader.css";
@import "js/dojo/dojox/editor/plugins/resources/css/LocalImage.css";
@import "js/dojo/dojox/editor/plugins/resources/css/FindReplace.css";
</style>

{if $siteList}
<ul>
{foreach $siteList as $site}
<li><a href="plugin.php?plugin={$pluginId}&singleViewId={$site->id}">{$site->name} </a><a href="plugin.php?plugin={$pluginId}&singleEditViewId={$site->id}"> Edit</a><a href="plugin.php?plugin={$pluginId}&deleteSiteId={$site->id}"> Delete</a></li>
{/foreach}
</ul>
<form action="plugin.php?plugin={$pluginId}&createSiteId=do" method="POST">
<table width="90%">
<tr><td>Sitename</td><td><input type="text" name="siteName" /></td></tr>
<tr><td>Menupos</td><td><input type="range" name="siteOrder" min="1" max="10"></td></tr>
     <tr>
       <td>Text</td>
       <td>
		<input type="hidden" name="siteContent" id='editorSend' />
		<div data-dojo-type="dijit/Editor" id="editor"data-dojo-props="{literal}extraPlugins:['foreColor','hiliteColor',{name:'dijit/_editor/plugins/FontChoice', command:'fontName', generic:true},'createLink','viewsource', 'findreplace','fullscreen',{name: 'prettyprint', indentBy: 3, lineLength: 80, entityMap: [['<', 'lt'],['>', 'gt']], xhtml: true},'dijit/_editor/plugins/AlwaysShowToolbar','preview',{name: 'LocalImage', uploadable: false, fileMask: '*.*'}],onChange:function(){document.getElementById('editorSend').value = this.getValue();}"{/literal}>
			<p>{$text}</p>
		</div>
      </td>
    </tr>
	 <tr>
        <td>
         <input type="submit" value="Send it!"/>
         </td>
     </tr>
	 </table>
</form>
{/if}

{if $singleEditSite}
<form action="plugin.php?plugin={$pluginId}&editSiteId={$singleEditSite->id}" method="POST">
<table width="90%">
<tr><td>Sitename</td><td><input type="text" name="siteName" value="{$singleEditSite->name}" /></td></tr>
<tr><td>Menupos</td><td><input type="range" name="siteOrder" min="1" max="10"></td></tr>
     <tr>
       <td>Text</td>
       <td>
		<input type="hidden" name="siteContent" id='editorSend' />
		<div data-dojo-type="dijit/Editor" id="editor"data-dojo-props="{literal}extraPlugins:['foreColor','hiliteColor',{name:'dijit/_editor/plugins/FontChoice', command:'fontName', generic:true},'createLink','viewsource', 'findreplace','fullscreen',{name: 'prettyprint', indentBy: 3, lineLength: 80, entityMap: [['<', 'lt'],['>', 'gt']], xhtml: true},'dijit/_editor/plugins/AlwaysShowToolbar','preview',{name: 'LocalImage', uploadable: false, fileMask: '*.*'}],onChange:function(){document.getElementById('editorSend').value = this.getValue();}"{/literal}>
			<p>{$singleEditSite->content}</p>
		</div>
      </td>
    </tr>
	 <tr>
        <td>
         <input type="submit" value="Send it!"/>
         </td>
     </tr>
	 </table>
</form>


{/if}


{if $singleViewSite}<ul>
<div class="menu">
{foreach $siteListMenu as $site}
<a class="button view" href="plugin.php?plugin={$pluginId}&singleViewId={$site->id}">{$site->name} </a>
{/foreach}
</div>
</ul>
{$singleViewSite->content}
{/if}
