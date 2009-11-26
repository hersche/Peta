<?php /* Smarty version 2.6.26, created on 2009-11-26 17:13:40
         compiled from users_edituser.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('title' => 'Usermanagement')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "messagebox.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="user.php?action=mkedit" method="post">
<table>
    <tr>
      <td>Name: </td>
      <td><input TYPE="text" SIZE="40" NAME="name" value="<?php echo $this->_tpl_vars['name']; ?>
" /> </td>
    </tr>
    <tr>
      <td>Username: </td>
      <td><input TYPE="text" SIZE="40" NAME="username" readonly value="<?php echo $this->_tpl_vars['username']; ?>
" /> </td>
    </tr>
    <tr>
      <td>Password: </td>
      <td><input TYPE="password" SIZE="40" NAME="password" /> </td>
    </tr>
    <tr>
      <td>Password validation: </td>
      <td><input TYPE="password" SIZE="40" NAME="password2" /> </td>
    </tr>
    <tr>
      <td>Realy want to edit the user? </td>
      <td><input type="checkbox" name="sure" /> </td>
    </tr>
    <tr>
    	<td><input type="submit" value="Edit now!" />
    </tr>
  </table>

</form>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>