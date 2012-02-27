<?php /* Smarty version 2.6.26, created on 2012-02-13 20:28:55
         compiled from forum.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('title' => 'Cards')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "messagebox.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "forum_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h1>Forum</h1>

<?php if ($this->_tpl_vars['threads']): ?>
<ul>
<?php unset($this->_sections['forum']);
$this->_sections['forum']['name'] = 'forum';
$this->_sections['forum']['loop'] = is_array($_loop=$this->_tpl_vars['threads']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['forum']['show'] = true;
$this->_sections['forum']['max'] = $this->_sections['forum']['loop'];
$this->_sections['forum']['step'] = 1;
$this->_sections['forum']['start'] = $this->_sections['forum']['step'] > 0 ? 0 : $this->_sections['forum']['loop']-1;
if ($this->_sections['forum']['show']) {
    $this->_sections['forum']['total'] = $this->_sections['forum']['loop'];
    if ($this->_sections['forum']['total'] == 0)
        $this->_sections['forum']['show'] = false;
} else
    $this->_sections['forum']['total'] = 0;
if ($this->_sections['forum']['show']):

            for ($this->_sections['forum']['index'] = $this->_sections['forum']['start'], $this->_sections['forum']['iteration'] = 1;
                 $this->_sections['forum']['iteration'] <= $this->_sections['forum']['total'];
                 $this->_sections['forum']['index'] += $this->_sections['forum']['step'], $this->_sections['forum']['iteration']++):
$this->_sections['forum']['rownum'] = $this->_sections['forum']['iteration'];
$this->_sections['forum']['index_prev'] = $this->_sections['forum']['index'] - $this->_sections['forum']['step'];
$this->_sections['forum']['index_next'] = $this->_sections['forum']['index'] + $this->_sections['forum']['step'];
$this->_sections['forum']['first']      = ($this->_sections['forum']['iteration'] == 1);
$this->_sections['forum']['last']       = ($this->_sections['forum']['iteration'] == $this->_sections['forum']['total']);
?>
<table border="1">
<li><tr><td><a
	href="forum.php?action=showthread&amp;threadid=<?php echo $this->_tpl_vars['threads'][$this->_sections['forum']['index']]->getId(); ?>
"><?php echo $this->_tpl_vars['threads'][$this->_sections['forum']['index']]->getTitle(); ?>
</a></td><td><?php echo $this->_tpl_vars['threads'][$this->_sections['forum']['index']]->getSubThreadCounter(); ?>
 posts are there</td></tr></li>
</table>
<?php endfor; endif; ?>

</ul>
<?php endif; ?>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>