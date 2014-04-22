{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"}
<script type="text/javascript">
    require(['dojo/parser','dijit/Editor']);
		
function updateCustomfieldList() {
 var xhrArgs = {
 form:dojo.byId('customfieldsOrderForm'),
 handleAs: "text",
 preventCache: true
 }
 var deferred = dojo.xhrPost(xhrArgs);
}
</script>
<form action="profile.php?action=edit" method="post">
<h1>Profile</h1>
<table>
	<tr>
		<td>Username:</td>
		<td><input TYPE="text" SIZE="40" NAME="username" readonly="readonly"
			value="{$username}" /></td>
	</tr>
	<tr>
		<td>Password (blank = no change):</td>
		<td><input TYPE="password" SIZE="40" NAME="password" /></td>
	</tr>
	<tr>
		<td>Password validation:</td>
		<td><input TYPE="password" SIZE="40" NAME="password2" /></td>
	</tr>
</table>
<input type="submit" value="Edit now!" />
</form>
<p>Your roles:</p>
<ul>
		{foreach item=role from=$roles} 
		<li>{$role->getRole()}</li>
		 {/foreach}
</ul>
Customfields:
<form action="profile.php?doOrder=do" method="post" id="customfieldsOrderForm">
<ol dojoType="dojo.dnd.Source" data-dojo-id="customfieldList">
    {foreach item=cm from=$customfields}
    <li class="dojoDndItem">{$cm->getKey()}: {$cm->getValue()} <a href="profile.php?action=edit&amp;editId={$cm->getId()}">Edit</a><a href="profile.php?deleteId={$cm->getId()}">Delete</a></li>
	<input type="hidden" name="customfieldsOrder[]" value="{$cm->getId()}" />
    {/foreach}
</ol>
</form>

<a href="profile.php" class="button view">View Profile</a>
<hr />
{if $editCustomField}
<h3>Edit Customfield</h3>
<form action="profile.php?action=edit&amp;actionEditId={$editCustomField->getId()}" method="POST">
<table width="90%">
<tr><td colspan="1">Customfieldname</td><td><input type="text" name="editKey" style="width:50%;" placeholder="Hobbys/Music/Contact..." value="{$editCustomField->getKey()}" /></td></tr>
     <tr>
       <td>Text</td>
       <td>
		<!-- <input type="hidden" name="editValue" id='editorSend2' /> -->
		<textarea data-dojo-type="dijit/Editor" name="editValue">{$editCustomField->getValue()}
		</textarea>
      </td>
    </tr>
	 <tr>
        <td>
         <input type="submit" value="Edit customfield!"/>
         </td>
     </tr>
	 </table>
</form>
{/if}
<hr /><h3>Add Customfield</h3>
<form action="profile.php?action=edit" method="POST">
<table width="90%">
<tr><td colspan="1">Customfieldname</td><td><input type="text" name="newKey" style="width:50%;" placeholder="Hobbys/Music/Contact..."/></td></tr>
     <tr>
       <td>Text</td>
       <td>
		<!-- <input type="hidden" name="newValue" id='editorSend' /> -->
		<textarea data-dojo-type="dijit/Editor" name="newValue">
		</textarea>
      </td>
    </tr>
	 <tr>
        <td>
         <input type="submit" value="Create customfield!"/>
         </td>
     </tr>
	 </table>
</form>

{include file="footer.tpl"}