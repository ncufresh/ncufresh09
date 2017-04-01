<?php /* Smarty version 2.6.18, created on 2009-08-07 01:44:31
         compiled from block/qa_block.htm */ ?>
<div id="qa_container">
  <div id="qa_block_top"></div>
  <div id="qa_block_center">
  <?php $_from = $this->_tpl_vars['block']['qa_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['topic']):
?>
    <div id="qa_block_center_l"><a href="<?php echo $this->_tpl_vars['block']['dirname']; ?>
/index.php?QAno=<?php echo $this->_tpl_vars['topic']['Qno']; ?>
"><?php echo $this->_tpl_vars['topic']['Qtitle']; ?>
</a></div>
    <div id="qa_block_center_r"><?php echo $this->_tpl_vars['topic']['Qtime']; ?>
</div>
    <br class="clear" />
  <?php endforeach; endif; unset($_from); ?>
  </div>
  
  <div id="qa_block_bottom"></div>
</div>