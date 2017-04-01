<?php /* Smarty version 2.6.18, created on 2009-07-29 10:54:20
         compiled from block/toptenfix.htm */ ?>
<?php $_from = $this->_tpl_vars['block']['topten']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
<div>[<a href="viewboard.php?no=<?php echo $this->_tpl_vars['item']['board_no']; ?>
"><?php echo $this->_tpl_vars['item']['board']; ?>
</a>] <a href="viewtopic.php?no=<?php echo $this->_tpl_vars['item']['topic_no']; ?>
"><?php echo $this->_tpl_vars['item']['title']; ?>
</a> (<?php echo $this->_tpl_vars['item']['num']; ?>
)</div>
<?php endforeach; endif; unset($_from); ?>