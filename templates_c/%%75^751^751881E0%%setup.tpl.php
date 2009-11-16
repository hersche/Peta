<?php /* Smarty version 2.6.26, created on 2009-11-16 16:58:25
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
<form action="input_radio.htm">
  <p>Geben Sie Ihre Zahlungsweise an:</p>
  <p>
    <input type="radio" name="Zahlmethode" value="complete"> Complete Setup (Create new Tables, don't overwrite existing structure)<br>
    <input type="radio" name="Zahlmethode" value="force"> Force Installation (<br>
    <input type="radio" name="Zahlmethode" value="AmericanExpress"> American Express
  </p>
</form>



<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>