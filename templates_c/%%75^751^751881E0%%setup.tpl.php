<?php /* Smarty version 2.6.26, created on 2009-11-16 17:58:44
         compiled from setup.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.tpl", 'smarty_include_vars' => array('title' => 'Setup')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "messagebox.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h1>Setup</h1>
<p>Welcome to the Setup. Choose your art of installation:</p>
<form action="setup.php" method="get">
  <p>
    <input type="radio" name="install" value="complete"> Complete Setup (Create new Tables, don't overwrite existing structure)<br>
    <input type="radio" name="install" value="force"> Force Installation (Does overwrite a installation if necessary)<br>
  </p>
  <input type="submit" value="Install" />
</form>



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>