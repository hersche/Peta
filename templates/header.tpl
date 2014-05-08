<!DOCTYPE html>
<html manifest="peta.appcache">
<title>Peta::{$title}</title>
<style type="text/css">
	@import "css/default.css";
	@import "css/button.css";
	@import "js/dojo/dijit/themes/dijit.css";
	@import "js/dojo/dijit/themes/dijit_rtl.css";
    @import "js/dojo/dijit/themes/soria/soria.css";
</style>

{foreach item=tag from=$headerTags}
    {$tag}
{/foreach}
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript">
        var djConfig = {
            parseOnLoad: true,
            isDebug: true,
            locale: 'en-us',
            extraLocale: ['de-de']
        };
    </script>
    
{foreach item=js from=$jsscripts}
	<script type="text/javascript" src="{$js}" djConfig="parseOnLoad:true"></script>
{/foreach}
<script type="text/javascript" src="js/dojo/dojo/dojo.js"></script>
 {if $messages or basename($smarty.server.REQUEST_URI) eq "login.php"}
<script type="text/javascript" src="js/extras.js"></script>
{/if}

<script type="text/javascript">
    {if $messages or basename($smarty.server.REQUEST_URI) eq "login.php"}
dojo.require("dojo.fx");
dojo.require("dijit.form.Button");
    {/if}
    
{foreach item=dojo from=$dojorequire}
	dojo.require("{$dojo}");
{/foreach}


{literal}
dojo.addOnLoad(function() {
        {/literal}
//basicWipeinSetup();
{$onLoadCode}
{literal}
}); {/literal}
</script>

{foreach item=css from=$allcss}
<link title="{$css}" rel="stylesheet" type="text/css" href="{$css}" />
{/foreach}

</head>
<body class="soria">