<?php /* Smarty version 2.6.26, created on 2009-11-26 12:27:26
         compiled from messagebox.tpl */ ?>
<?php if ($this->_tpl_vars['messages']): ?>
<div id="messagebox" style=" background-color: red;">
<ul>
<?php unset($this->_sections['message']);
$this->_sections['message']['name'] = 'message';
$this->_sections['message']['loop'] = is_array($_loop=$this->_tpl_vars['messages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['message']['show'] = true;
$this->_sections['message']['max'] = $this->_sections['message']['loop'];
$this->_sections['message']['step'] = 1;
$this->_sections['message']['start'] = $this->_sections['message']['step'] > 0 ? 0 : $this->_sections['message']['loop']-1;
if ($this->_sections['message']['show']) {
    $this->_sections['message']['total'] = $this->_sections['message']['loop'];
    if ($this->_sections['message']['total'] == 0)
        $this->_sections['message']['show'] = false;
} else
    $this->_sections['message']['total'] = 0;
if ($this->_sections['message']['show']):

            for ($this->_sections['message']['index'] = $this->_sections['message']['start'], $this->_sections['message']['iteration'] = 1;
                 $this->_sections['message']['iteration'] <= $this->_sections['message']['total'];
                 $this->_sections['message']['index'] += $this->_sections['message']['step'], $this->_sections['message']['iteration']++):
$this->_sections['message']['rownum'] = $this->_sections['message']['iteration'];
$this->_sections['message']['index_prev'] = $this->_sections['message']['index'] - $this->_sections['message']['step'];
$this->_sections['message']['index_next'] = $this->_sections['message']['index'] + $this->_sections['message']['step'];
$this->_sections['message']['first']      = ($this->_sections['message']['iteration'] == 1);
$this->_sections['message']['last']       = ($this->_sections['message']['iteration'] == $this->_sections['message']['total']);
?>
<li><?php echo $this->_tpl_vars['messages'][$this->_sections['message']['index']]; ?>
</li>
<?php endfor; endif; ?>
</ul>
    <button dojoType="dijit.form.Button" id="messageboxclosebutton">
    Close
</button>
</div>
<?php endif; ?>