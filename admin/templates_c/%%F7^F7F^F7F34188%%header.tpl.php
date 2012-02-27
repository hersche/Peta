<?php /* Smarty version 2.6.26, created on 2012-02-14 17:23:55
         compiled from header.tpl */ ?>
<?php echo '<?xml'; ?>
 version="1.0" encoding="UTF-8"<?php echo '?>'; ?>

<!DOCTYPE html 
     PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
    <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<title>LearningCards::<?php echo $this->_tpl_vars['title']; ?>
</title>
<script type="text/javascript" src="../dojo/dojo/dojo.js"
	djConfig="parseOnLoad:true"></script>
<?php unset($this->_sections['js']);
$this->_sections['js']['name'] = 'js';
$this->_sections['js']['loop'] = is_array($_loop=$this->_tpl_vars['jsscripts']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['js']['show'] = true;
$this->_sections['js']['max'] = $this->_sections['js']['loop'];
$this->_sections['js']['step'] = 1;
$this->_sections['js']['start'] = $this->_sections['js']['step'] > 0 ? 0 : $this->_sections['js']['loop']-1;
if ($this->_sections['js']['show']) {
    $this->_sections['js']['total'] = $this->_sections['js']['loop'];
    if ($this->_sections['js']['total'] == 0)
        $this->_sections['js']['show'] = false;
} else
    $this->_sections['js']['total'] = 0;
if ($this->_sections['js']['show']):

            for ($this->_sections['js']['index'] = $this->_sections['js']['start'], $this->_sections['js']['iteration'] = 1;
                 $this->_sections['js']['iteration'] <= $this->_sections['js']['total'];
                 $this->_sections['js']['index'] += $this->_sections['js']['step'], $this->_sections['js']['iteration']++):
$this->_sections['js']['rownum'] = $this->_sections['js']['iteration'];
$this->_sections['js']['index_prev'] = $this->_sections['js']['index'] - $this->_sections['js']['step'];
$this->_sections['js']['index_next'] = $this->_sections['js']['index'] + $this->_sections['js']['step'];
$this->_sections['js']['first']      = ($this->_sections['js']['iteration'] == 1);
$this->_sections['js']['last']       = ($this->_sections['js']['iteration'] == $this->_sections['js']['total']);
?>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['jsscripts'][$this->_sections['js']['index']]; ?>
"
	djConfig="parseOnLoad:true"></script>
<?php endfor; endif; ?>
<script type="text/javascript">
dojo.require("dojo.fx");
dojo.require("dijit.form.Button");
<?php unset($this->_sections['dojo']);
$this->_sections['dojo']['name'] = 'dojo';
$this->_sections['dojo']['loop'] = is_array($_loop=$this->_tpl_vars['dojorequire']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['dojo']['show'] = true;
$this->_sections['dojo']['max'] = $this->_sections['dojo']['loop'];
$this->_sections['dojo']['step'] = 1;
$this->_sections['dojo']['start'] = $this->_sections['dojo']['step'] > 0 ? 0 : $this->_sections['dojo']['loop']-1;
if ($this->_sections['dojo']['show']) {
    $this->_sections['dojo']['total'] = $this->_sections['dojo']['loop'];
    if ($this->_sections['dojo']['total'] == 0)
        $this->_sections['dojo']['show'] = false;
} else
    $this->_sections['dojo']['total'] = 0;
if ($this->_sections['dojo']['show']):

            for ($this->_sections['dojo']['index'] = $this->_sections['dojo']['start'], $this->_sections['dojo']['iteration'] = 1;
                 $this->_sections['dojo']['iteration'] <= $this->_sections['dojo']['total'];
                 $this->_sections['dojo']['index'] += $this->_sections['dojo']['step'], $this->_sections['dojo']['iteration']++):
$this->_sections['dojo']['rownum'] = $this->_sections['dojo']['iteration'];
$this->_sections['dojo']['index_prev'] = $this->_sections['dojo']['index'] - $this->_sections['dojo']['step'];
$this->_sections['dojo']['index_next'] = $this->_sections['dojo']['index'] + $this->_sections['dojo']['step'];
$this->_sections['dojo']['first']      = ($this->_sections['dojo']['iteration'] == 1);
$this->_sections['dojo']['last']       = ($this->_sections['dojo']['iteration'] == $this->_sections['dojo']['total']);
?>
dojo.require("<?php echo $this->_tpl_vars['dojorequire'][$this->_sections['dojo']['index']]; ?>
");
<?php endfor; endif; ?>
	<?php echo ' 
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
        '; ?>
 
    	    basicWipeinSetup();
    	    <?php echo $this->_tpl_vars['dojoonloadcode']; ?>

    	    <?php echo ' 
    }); '; ?>

	</script>
<link rel="stylesheet" type="text/css" href="../css/default.css" />
	<link rel="stylesheet" type="text/css" href="../dojo/dijit/themes/tundra/tundra.css" />
<?php unset($this->_sections['css']);
$this->_sections['css']['name'] = 'css';
$this->_sections['css']['loop'] = is_array($_loop=$this->_tpl_vars['allcss']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['css']['show'] = true;
$this->_sections['css']['max'] = $this->_sections['css']['loop'];
$this->_sections['css']['step'] = 1;
$this->_sections['css']['start'] = $this->_sections['css']['step'] > 0 ? 0 : $this->_sections['css']['loop']-1;
if ($this->_sections['css']['show']) {
    $this->_sections['css']['total'] = $this->_sections['css']['loop'];
    if ($this->_sections['css']['total'] == 0)
        $this->_sections['css']['show'] = false;
} else
    $this->_sections['css']['total'] = 0;
if ($this->_sections['css']['show']):

            for ($this->_sections['css']['index'] = $this->_sections['css']['start'], $this->_sections['css']['iteration'] = 1;
                 $this->_sections['css']['iteration'] <= $this->_sections['css']['total'];
                 $this->_sections['css']['index'] += $this->_sections['css']['step'], $this->_sections['css']['iteration']++):
$this->_sections['css']['rownum'] = $this->_sections['css']['iteration'];
$this->_sections['css']['index_prev'] = $this->_sections['css']['index'] - $this->_sections['css']['step'];
$this->_sections['css']['index_next'] = $this->_sections['css']['index'] + $this->_sections['css']['step'];
$this->_sections['css']['first']      = ($this->_sections['css']['iteration'] == 1);
$this->_sections['css']['last']       = ($this->_sections['css']['iteration'] == $this->_sections['css']['total']);
?>
<link title="<?php echo $this->_tpl_vars['allcss'][$this->_sections['css']['index']]; ?>
" rel="stylesheet" type="text/css"
	href="<?php echo $this->_tpl_vars['allcss'][$this->_sections['css']['index']]; ?>
" />
<?php endfor; endif; ?>
</head>
<body class="tundra" <?php echo $this->_tpl_vars['bodyargs']; ?>
>