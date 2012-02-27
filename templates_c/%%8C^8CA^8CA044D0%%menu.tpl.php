<?php /* Smarty version 2.6.26, created on 2012-02-13 20:24:00
         compiled from menu.tpl */ ?>
<div class="menu"><a href="index.php" class="button" >Home</a><a href="cards.php" class="button">Cards</a><a href="forum.php" class="button">Forum</a><a href="profile.php" class="button">My Profile</a><a
	href="login.php?action=logout" class="button">Logout</a><?php if ($this->_tpl_vars['admin']): ?><a
	href="admin/index.php">Admin</a><?php endif; ?>		<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['plugins']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['id']['show'] = true;
$this->_sections['id']['max'] = $this->_sections['id']['loop'];
$this->_sections['id']['step'] = 1;
$this->_sections['id']['start'] = $this->_sections['id']['step'] > 0 ? 0 : $this->_sections['id']['loop']-1;
if ($this->_sections['id']['show']) {
    $this->_sections['id']['total'] = $this->_sections['id']['loop'];
    if ($this->_sections['id']['total'] == 0)
        $this->_sections['id']['show'] = false;
} else
    $this->_sections['id']['total'] = 0;
if ($this->_sections['id']['show']):

            for ($this->_sections['id']['index'] = $this->_sections['id']['start'], $this->_sections['id']['iteration'] = 1;
                 $this->_sections['id']['iteration'] <= $this->_sections['id']['total'];
                 $this->_sections['id']['index'] += $this->_sections['id']['step'], $this->_sections['id']['iteration']++):
$this->_sections['id']['rownum'] = $this->_sections['id']['iteration'];
$this->_sections['id']['index_prev'] = $this->_sections['id']['index'] - $this->_sections['id']['step'];
$this->_sections['id']['index_next'] = $this->_sections['id']['index'] + $this->_sections['id']['step'];
$this->_sections['id']['first']      = ($this->_sections['id']['iteration'] == 1);
$this->_sections['id']['last']       = ($this->_sections['id']['iteration'] == $this->_sections['id']['total']);
?> 
		<a href="index.php?plugin=<?php echo $this->_tpl_vars['plugins'][$this->_sections['id']['index']]->getId(); ?>
"><?php echo $this->_tpl_vars['plugins'][$this->_sections['id']['index']]->getPluginName(); ?>
</a>
		 <?php endfor; endif; ?></div>