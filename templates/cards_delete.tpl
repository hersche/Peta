{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"} {include file="cards_menu.tpl"}
<h1>Do you realy want to delete cardset {$cardsetname}</h1>
<form
	action="cards.php?action=deletecardset&setid={$setid}"
	method="post">
<button type="submit" value="yes" name="sure" >Yes</button><button type="submit" value="no" name="sure" >No</button>
</form>
{include file="footer.tpl"}