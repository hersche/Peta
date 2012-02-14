{include file="header.tpl" title=Usermanagement} {include
file="menu.tpl"} {include file="messagebox.tpl"}
<h1>Allowed sites</h1>
<p>This part of the configuration make it possible to allow sites for peoble who didn't got a login. But be carefull!
We use here regular expressions, what could mean: you could enable simple a whole module by giving them a site.
Examples for correct regex:
<ul>
<li>/^forum.php$/ = a single site</li>
<li>'action=showthread&amp;threadid=' = a function or so</li>
</ul>
</p>
<ul>
{section name=site loop=$sites}

<li>
<form action="options.php?action=editAllowedSite&siteid={$sites[site]->getId()}" method="post">
            <input type="text" name="site" value="{$sites[site]->getName()}">
            
        <input type="submit" value="Edit now!" /></form> <a href="options.php?action=deleteAllowedSite&siteid={$sites[site]->getId()}">Delete Site</a></li>

{/section}
</ul>
<form action="options.php?action=createAllowedSite" method="post">
<table>
	<tr>
		<td>Site-regex:</td>
		<td><input TYPE="text" SIZE="40" NAME="site" /></td>
	</tr>
		<tr>
		<td><input type="submit" value="Add now!" />
	
	</tr>
</table>
</form>
{include file="footer.tpl"}
