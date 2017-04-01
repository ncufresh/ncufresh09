<?php /* Smarty version 2.6.18, created on 2009-07-29 10:54:20
         compiled from block/hotboard.htm */ ?>
<?php $_from = $this->_tpl_vars['block']['board']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['board']):
?>
<div><a href="<?php echo $this->_tpl_vars['block']['dirname']; ?>
/viewboard.php?no=<?php echo $this->_tpl_vars['board']['no']; ?>
"><?php echo $this->_tpl_vars['board']['name']; ?>
</a><?php if ($this->_tpl_vars['curruser']->isadmin()): ?><span style="color: white">(<?php echo $this->_tpl_vars['board']['count']; ?>
)</span><?php endif; ?></div>
<?php endforeach; endif; unset($_from); ?>