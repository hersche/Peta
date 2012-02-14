<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<title>LearningCards::{$title}</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script type="text/javascript" src="dojo/dojo/dojo.js"
	djConfig="parseOnLoad:true"></script>
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
	<link rel="stylesheet" type="text/css" href="dojo/dijit/themes/tundra/tundra.css" />
{section name=css loop=$allcss}
<link title="{$allcss[css]}" rel="stylesheet" type="text/css"
	href="{$allcss[css]}" />
{/section}
</head>
<body class="tundra" {$bodyargs}>