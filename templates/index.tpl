<html>
<head><title>Test!</title>
{section name=js loop=$jsscripts}
<script type="text/javascript" src="{$jsscripts[js]}" djConfig="parseOnLoad:true"></script>
{/section}
</head>
<body>

<div id="basicWipeNode" style="width: 200px; background-color: red;">
    <b>
        This is a container of random content to wipe out!
    </b>
    <button dojoType="dijit.form.Button" id="basicWipeButton">
    Close
</button>
</div>
{$test}
</body>
</html>