{include file="header.tpl" title=Cards} {include file="messagebox.tpl"}
{include file="menu.tpl"} {include file="cards_menu.tpl"}
<h1>{t}Do you realy want to delete{/t} {$what} {$cardsetname}</h1>
<form
	action="cards.php?action=delete{$what}&setid={$setid}&questionid={$questionid}"
	method="post">
<button type="submit" value="yes" name="sure" >{t}Yes{/t}</button><button type="submit" value="no" name="sure" >{t}No{/t}</button>
</form>
{include file="footer.tpl"}