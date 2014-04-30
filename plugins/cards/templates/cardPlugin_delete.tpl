{include file="{$folder}templates/cardPlugin_menu.tpl"}
<h1>Do you realy want to delete {$what} {$cardsetname}</h1>
<form action="plugin.php?plugin={$pluginId}&action=delete{$what}&setid={$setid}&questionid={$questionid}" method="post">
    <button type="submit" value="yes" name="sure">Yes</button>
    <button type="submit" value="no" name="sure">No</button>
</form>