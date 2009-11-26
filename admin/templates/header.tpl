<html>
<head><title>LearningCards::{$title}</title>
{section name=js loop=$jsscripts}
<script type="text/javascript" src="{$jsscripts[js]}" djConfig="parseOnLoad:true"></script>
{/section}
{section name=css loop=$allcss}
<link title="{$allcss[css]}" rel="stylesheet" type="text/css" href="{$allcss[css]}" />
{/section}
</head>
<body {$bodyargs}>