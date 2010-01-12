{include file="header.tpl" title=Cards}
{include file="messagebox.tpl"}
{include file="menu.tpl"}
{include file="cards_menu.tpl"}
{if $cardsets}
<ul>
{section name=set loop=$cardsets}
<li><a href="cards.php?action=singlecardset&amp;setid={$cardsets[set]->getSetId()}" >{$cardsets[set]->getSetName()}</a></li>
{/section}
</ul>
{/if}

{include file="footer.tpl"}