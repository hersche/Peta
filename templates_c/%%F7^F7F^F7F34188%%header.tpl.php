<?php /* Smarty version 2.6.26, created on 2009-11-26 17:58:02
         compiled from header.tpl */ ?>
<html>
<head><title>LearningCards::<?php echo $this->_tpl_vars['title']; ?>
</title>
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
" djConfig="parseOnLoad:true"></script>
<?php endfor; endif; ?>
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
" rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['allcss'][$this->_sections['css']['index']]; ?>
" />
<?php endfor; endif; ?>
</head>
<body <?php echo $this->_tpl_vars['bodyargs']; ?>
>