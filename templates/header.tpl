<html>
<head>
<title>LearningCards::{$title}</title>
{section name=js loop=$jsscripts}
<script type="text/javascript" src="{$jsscripts[js]}"
	djConfig="parseOnLoad:true"></script>
{/section}
<script type="text/javascript">
dojo.require("dojo.fx");
dojo.require("dijit.form.Button");
{section name=dojo loop=$dojorequire}
dojo.require({$dojorequire[dojo]});
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

{section name=css loop=$allcss}
<link title="{$allcss[css]}" rel="stylesheet" type="text/css"
	href="{$allcss[css]}" />
{/section}
</head>
<body{$bodyargs}>