<html>
<head><title>LearningCards::{$title}</title>
{section name=js loop=$jsscripts}
<script type="text/javascript" src="{$jsscripts[js]}" djConfig="parseOnLoad:true"></script>
{/section}
</head>
<body {$bodyargs}>