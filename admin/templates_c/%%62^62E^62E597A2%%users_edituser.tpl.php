<?php /* Smarty version 2.6.26, created on 2012-02-26 18:07:09
         compiled from users_edituser.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('title' => 'Usermanagement')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?> <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "messagebox.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="user.php?action=mkedit&userid=<?php echo $this->_tpl_vars['userid']; ?>
" method="post">
<table>

	<tr>
		<td>Username:</td>
		<td><input TYPE="text" SIZE="40" NAME="username" readonly="readonly"
			value="<?php echo $this->_tpl_vars['username']; ?>
" /></td>
	</tr>
	<tr>
		<td>Password:</td>
		<td><input TYPE="password" SIZE="40" NAME="password" /></td>
	</tr>
	<tr>
		<td>Password validation:</td>
		<td><input TYPE="password" SIZE="40" NAME="password2" /></td>
	</tr>
	<td>Userrole: </td>
	<td><ul>
<?php unset($this->_sections['role']);
$this->_sections['role']['name'] = 'role';
$this->_sections['role']['loop'] = is_array($_loop=$this->_tpl_vars['roles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['role']['show'] = true;
$this->_sections['role']['max'] = $this->_sections['role']['loop'];
$this->_sections['role']['step'] = 1;
$this->_sections['role']['start'] = $this->_sections['role']['step'] > 0 ? 0 : $this->_sections['role']['loop']-1;
if ($this->_sections['role']['show']) {
    $this->_sections['role']['total'] = $this->_sections['role']['loop'];
    if ($this->_sections['role']['total'] == 0)
        $this->_sections['role']['show'] = false;
} else
    $this->_sections['role']['total'] = 0;
if ($this->_sections['role']['show']):

            for ($this->_sections['role']['index'] = $this->_sections['role']['start'], $this->_sections['role']['iteration'] = 1;
                 $this->_sections['role']['iteration'] <= $this->_sections['role']['total'];
                 $this->_sections['role']['index'] += $this->_sections['role']['step'], $this->_sections['role']['iteration']++):
$this->_sections['role']['rownum'] = $this->_sections['role']['iteration'];
$this->_sections['role']['index_prev'] = $this->_sections['role']['index'] - $this->_sections['role']['step'];
$this->_sections['role']['index_next'] = $this->_sections['role']['index'] + $this->_sections['role']['step'];
$this->_sections['role']['first']      = ($this->_sections['role']['iteration'] == 1);
$this->_sections['role']['last']       = ($this->_sections['role']['iteration'] == $this->_sections['role']['total']);
?>
<?php unset($this->_sections['srole']);
$this->_sections['srole']['name'] = 'srole';
$this->_sections['srole']['loop'] = is_array($_loop=$this->_tpl_vars['selectedRoles']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['srole']['show'] = true;
$this->_sections['srole']['max'] = $this->_sections['srole']['loop'];
$this->_sections['srole']['step'] = 1;
$this->_sections['srole']['start'] = $this->_sections['srole']['step'] > 0 ? 0 : $this->_sections['srole']['loop']-1;
if ($this->_sections['srole']['show']) {
    $this->_sections['srole']['total'] = $this->_sections['srole']['loop'];
    if ($this->_sections['srole']['total'] == 0)
        $this->_sections['srole']['show'] = false;
} else
    $this->_sections['srole']['total'] = 0;
if ($this->_sections['srole']['show']):

            for ($this->_sections['srole']['index'] = $this->_sections['srole']['start'], $this->_sections['srole']['iteration'] = 1;
                 $this->_sections['srole']['iteration'] <= $this->_sections['srole']['total'];
                 $this->_sections['srole']['index'] += $this->_sections['srole']['step'], $this->_sections['srole']['iteration']++):
$this->_sections['srole']['rownum'] = $this->_sections['srole']['iteration'];
$this->_sections['srole']['index_prev'] = $this->_sections['srole']['index'] - $this->_sections['srole']['step'];
$this->_sections['srole']['index_next'] = $this->_sections['srole']['index'] + $this->_sections['srole']['step'];
$this->_sections['srole']['first']      = ($this->_sections['srole']['iteration'] == 1);
$this->_sections['srole']['last']       = ($this->_sections['srole']['iteration'] == $this->_sections['srole']['total']);
?>
<?php if ($this->_tpl_vars['selectedRoles'][$this->_sections['srole']['index']] == $this->_tpl_vars['roles'][$this->_sections['role']['index']]): ?>
<li><?php echo $this->_tpl_vars['roles'][$this->_sections['role']['index']]->getRole(); ?>
 DEBUG-ID's:<?php echo $this->_tpl_vars['roles'][$this->_sections['role']['index']]->getId(); ?>
<input type="checkbox" name="role_<?php echo $this->_tpl_vars['roles'][$this->_sections['role']['index']]->getId(); ?>
" value="<?php echo $this->_tpl_vars['roles'][$this->_sections['role']['index']]->getId(); ?>
" checked="checked"></li>
<?php else: ?>
<li><?php echo $this->_tpl_vars['roles'][$this->_sections['role']['index']]->getRole(); ?>
  DEBUG-ID's:<?php echo $this->_tpl_vars['roles'][$this->_sections['role']['index']]->getId(); ?>
<input type="checkbox" name="role_<?php echo $this->_tpl_vars['roles'][$this->_sections['role']['index']]->getId(); ?>
" value="<?php echo $this->_tpl_vars['roles'][$this->_sections['role']['index']]->getId(); ?>
"></li>
<?php endif; ?> <?php endfor; endif; ?> <?php endfor; endif; ?>
	</select>

	</tr>
	
	
	<tr>
		<td>Realy want to edit the user?</td>
		<td><input type="checkbox" name="sure" /></td>
	</tr>
	<tr>
		<td><input type="submit" value="Edit now!" /></td>
	
	</tr>
</table>

</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>