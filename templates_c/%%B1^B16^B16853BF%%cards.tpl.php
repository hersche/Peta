<?php /* Smarty version 2.6.26, created on 2012-02-13 20:28:53
         compiled from cards.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('title' => 'Cards')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "messagebox.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "cards_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if ($this->_tpl_vars['cardsets']): ?>
<ul>
<?php unset($this->_sections['set']);
$this->_sections['set']['name'] = 'set';
$this->_sections['set']['loop'] = is_array($_loop=$this->_tpl_vars['cardsets']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['set']['show'] = true;
$this->_sections['set']['max'] = $this->_sections['set']['loop'];
$this->_sections['set']['step'] = 1;
$this->_sections['set']['start'] = $this->_sections['set']['step'] > 0 ? 0 : $this->_sections['set']['loop']-1;
if ($this->_sections['set']['show']) {
    $this->_sections['set']['total'] = $this->_sections['set']['loop'];
    if ($this->_sections['set']['total'] == 0)
        $this->_sections['set']['show'] = false;
} else
    $this->_sections['set']['total'] = 0;
if ($this->_sections['set']['show']):

            for ($this->_sections['set']['index'] = $this->_sections['set']['start'], $this->_sections['set']['iteration'] = 1;
                 $this->_sections['set']['iteration'] <= $this->_sections['set']['total'];
                 $this->_sections['set']['index'] += $this->_sections['set']['step'], $this->_sections['set']['iteration']++):
$this->_sections['set']['rownum'] = $this->_sections['set']['iteration'];
$this->_sections['set']['index_prev'] = $this->_sections['set']['index'] - $this->_sections['set']['step'];
$this->_sections['set']['index_next'] = $this->_sections['set']['index'] + $this->_sections['set']['step'];
$this->_sections['set']['first']      = ($this->_sections['set']['iteration'] == 1);
$this->_sections['set']['last']       = ($this->_sections['set']['iteration'] == $this->_sections['set']['total']);
?>
<li><a href="cards.php?action=singlecardset&amp;setid=<?php echo $this->_tpl_vars['cardsets'][$this->_sections['set']['index']]->getSetId(); ?>
" ><?php echo $this->_tpl_vars['cardsets'][$this->_sections['set']['index']]->getSetName(); ?>
</a></li>
<?php endfor; endif; ?>
</ul>
<?php endif; ?>



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>