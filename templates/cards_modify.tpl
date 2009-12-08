{include file="header.tpl" title=Cards}
{include file="messagebox.tpl"}
{include file="menu.tpl"}
{include file="cards_menu.tpl"}
<h1>Modify Cardset</h1>
<form action="cards.php?action=addquestion" method="post">
    <select name="cardset" size="1">
{section name=set loop=$cardsets}
      <option value="{$cardsets[set]->getSetId()}">{$cardsets[set]->getSetName()}</option>
{/section}
    </select>
    <input type="submit" value="Add Question" />
    </form>

{include file="footer.tpl"}