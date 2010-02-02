{include file="header.tpl" title=Cards}
{include file="messagebox.tpl"}
{include file="menu.tpl"}
{include file="forum_menu.tpl"}
<h1>Hallo Forum :)</h1>
<form action="forum.php" method="post">
<div style="border: 1px solid #ccc">
  <textarea dojoType="dijit.Editor"
    styleSheets="dojo/dojo/resources/dojo.css" name="text">
  </textarea>
</div>
<input type="submit" value="schick!" />
</form>
{include file="footer.tpl"}