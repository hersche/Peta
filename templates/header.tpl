<!DOCTYPE html>
<html>

<head>
<title>Peta::{$title}</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript" src="js/dojo/dojo/dojo.js"
djConfig="parseOnLoad:true"></script>
<script type="text/javascript" src="js/extras.js"></script>
{section name=js loop=$jsscripts}
<script type="text/javascript" src="{$jsscripts[js]}"
djConfig="parseOnLoad:true"></script>
{/section}
<script type="text/javascript">
dojo.require("dojo.fx");
dojo.require("dijit.form.Button");
{section name=dojo loop=$dojorequire}
dojo.require("{$dojorequire[dojo]}");
{/section}
{literal}
function basicWipeinSetup() {
        //Function linked to the button to trigger the wipe.
        function wipeIt() {
            dojo.style("messagebox", "height", "");
            dojo.style("messagebox", "display", "block");
            var wipeArgs = {
                node: "messagebox"
            };
dojo.fx.wipeOut(wipeArgs).play();
}
dojo.connect(dijit.byId("messageboxclosebutton"), "onClick", wipeIt);
}

dojo.addOnLoad(function() {
        {/literal}
basicWipeinSetup();
{$dojoonloadcode}
{literal}
}); {/literal}
</script>
<link rel="stylesheet" type="text/css" href="css/default.css" />
<link rel="stylesheet" type="text/css" href="css/button.css" />
<link rel="stylesheet" type="text/css" href="js/dojo/dijit/themes/tundra/tundra.css" />
{section name=css loop=$allcss}
<link title="{$allcss[css]}" rel="stylesheet" type="text/css"
href="{$allcss[css]}" />
{/section}
</head>
<body class="tundra" {$bodyargs}>