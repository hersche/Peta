<?php /* Smarty version 2.6.26, created on 2012-02-14 19:18:06
         compiled from forum_view.tpl */ ?>
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
<div class="example-right" style="margin-bottom:100px; >
<table border="1">
<tr><td colspan="2"><h3><?php echo $this->_tpl_vars['threadTitle']; ?>
</h3></td ><?php if (( ( $this->_tpl_vars['admin'] ) || ( $this->_tpl_vars['ownuserid'] == $this->_tpl_vars['userid'] ) )): ?><td><h3><a href="forum.php?action=editthread&amp;threadid=<?php echo $this->_tpl_vars['threadid']; ?>
"> (edit)</a></h3></td><?php endif; ?></tr>
<tr><td colspan="3"><?php echo $this->_tpl_vars['threadText']; ?>
</td></tr>
<hr />
<tr><td>Posted by <a href="profile.php?userid=<?php echo $this->_tpl_vars['userid']; ?>
"><?php echo $this->_tpl_vars['username']; ?>
</a></td><td><a href="forum.php?action=reply&amp;threadid=<?php echo $this->_tpl_vars['threadid']; ?>
">Reply to this
topic!</a></td><td>Last change on <?php echo $this->_tpl_vars['threadage']; ?>
</td></tr>
</table>

</div>
<div class="subThreads">
<?php unset($this->_sections['id']);
$this->_sections['id']['name'] = 'id';
$this->_sections['id']['loop'] = is_array($_loop=$this->_tpl_vars['subthreads']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
<div class="example-commentheading"
	style="margin-left: <?php echo $this->_tpl_vars['subthreads'][$this->_sections['id']['index']]->getPosition(); ?>
px; margin-top: 20px;">
<table border="2">
	<tr>
		<?php if ($this->_tpl_vars['subthreads'][$this->_sections['id']['index']]->getTitle() != ""): ?><td colspan="2"><h3><?php echo $this->_tpl_vars['subthreads'][$this->_sections['id']['index']]->getTitle(); ?>
</h3></td><?php endif; ?>
		<?php if (( ( $this->_tpl_vars['admin'] ) || ( $this->_tpl_vars['ownuserid'] == $this->_tpl_vars['subthreads'][$this->_sections['id']['index']]->getUserId() ) )): ?><td> <a
			href="forum.php?action=editthread&amp;threadid=<?php echo $this->_tpl_vars['subthreads'][$this->_sections['id']['index']]->getId(); ?>
">
		(edit)</a> </td><?php endif; ?>
	</tr>
	<tr>
		<td colspan="3"><?php echo $this->_tpl_vars['subthreads'][$this->_sections['id']['index']]->getText(); ?>
</td>
	</tr>
	<tr>
		<td>Posted by <a href="profile.php?userid=<?php echo $this->_tpl_vars['subthreads'][$this->_sections['id']['index']]->getUserId(); ?>
"><?php echo $this->_tpl_vars['subthreads'][$this->_sections['id']['index']]->getUsername(); ?>
</a></td>
		<td><a
			href="forum.php?action=reply&amp;threadid=<?php echo $this->_tpl_vars['subthreads'][$this->_sections['id']['index']]->getId(); ?>
">Reply
		to this post</a></td>
		<td><?php echo $this->_tpl_vars['subthreads'][$this->_sections['id']['index']]->getEditCounter(); ?>
 times editet!</td>
	</tr>
</table>

</div>
<?php endfor; endif; ?>
</div>
 <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>