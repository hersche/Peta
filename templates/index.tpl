<html>
<head><title>Test!</title>
{section name=js loop=$jsscripts}
<script type="text/javascript" src="{$jsscripts[js]}" djConfig="parseOnLoad:true"></script>
{/section}
</head>
<body>

<div id="messagebox" style="width: 200px; background-color: red;">
<ul>
{section name=message loop=$messages}
<li>{$messages[message]}</li>
{/section}
</ul>
    <button dojoType="dijit.form.Button" id="messageboxclosebutton">
    Close
</button>
</div>
{$test}
</body>
</html>