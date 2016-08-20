{if $messages}
<script type="text/javascript">
    dojo.addOnLoad(function() {
        var button = new dijit.form.Button({
            label: "Close!",
            onClick: function() {
				dojo.fx.wipeOut({literal}{node: 'messagebox'}{/literal}).play();
            }
        },
        "messageboxclosebutton");
    });
</script>
<div id="messagebox" style=" background-color: red; width: 60%;">
<ul>
{foreach item=message from=$messages}
<li>{$message}</li>
{/foreach}
</ul>
    <button type="button" id="messageboxclosebutton"></button>
</div>
{/if}