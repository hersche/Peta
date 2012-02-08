{if $messages}
<div id="messagebox" style=" background-color: red;">
<ul>
{section name=message loop=$messages}
<li>{$messages[message]}</li>
{/section}
</ul>
    <button dojoType="dijit.form.Button" id="messageboxclosebutton">
    Close
</button>
</div>
{/if}