{include file="messagebox.tpl"}
{include file="{$folder}templates/cardPlugin_menu.tpl"}
<form action="plugin.php?plugin={$pluginId}&action=mkcreatecardset" method="post">
{include file="{$folder}templates/cardPlugin_cardsetmodify_widget.tpl"}

</form>

{include file="{$folder}templates/cardPlugin_cardquestions_widget.tpl"}

