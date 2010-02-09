{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"} {include file="forum_menu.tpl"}
<h1>Hallo Forum :)</h1>
<table>
	<form action="forum.php?action=savethread" method="post">
	<tr>
		<td>Title of topic</td>
		<td><input type="text" name="topictitle" /></td>
	</tr>
	<tr>
		<td>Text</td>
		<td>
		<div style="border: 1px solid #ccc"><textarea dojoType="dijit.Editor"
			styleSheets="dojo/dojo/resources/dojo.css" name="topictext">
  </textarea></div>
		</td>
	</tr>
	<tr>
		<td><input type="submit" value="Send it!" /></td>
	</tr>
	</form>
</table>
{include file="footer.tpl"}
