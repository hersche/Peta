<?php /* Smarty version 2.6.26, created on 2012-02-14 19:18:09
         compiled from forum_editor.tpl */ ?>
<table>
	<form
		action="forum.php?action=savethread&amp;savemethod=<?php echo $this->_tpl_vars['savemethod']; ?>
&amp;threadid=<?php echo $this->_tpl_vars['threadid']; ?>
"
		method="post">
	<tr>
		<td>Your title</td>
		<td><input type="text" name="topictitle" value="<?php echo $this->_tpl_vars['title']; ?>
" /></td>
	</tr>
	<tr>
		<td>Text</td>
		<td>
		<div style="border: 1px solid #ccc"><textarea dojoType="dijit.Editor"
			styleSheets="dojo/dojo/resources/dojo.css" name="topictext"><?php echo $this->_tpl_vars['text']; ?>

  </textarea></div>
		</td>
	</tr>
	<?php if ($this->_tpl_vars['admin']): ?>
	<tr>
		<td>Forumstate</td>
		<td><select name="state" size="1">
		<option value="0">Active</option>
		<option value="1">Hidden</option>
		<option value="2">Read only</option>
		</select></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td><input type="submit" value="Send it!" /></td>
	</tr>
	</form>
</table>