<?php /* Smarty version 2.6.18, created on 2009-07-27 15:01:39
         compiled from block/topten.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'htmlencode', 'block/topten.htm', 3, false),)), $this); ?>
<div id="forum_content_top"></div>
<?php $_from = $this->_tpl_vars['block']['topten']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['topic']):
?>
<div id="forum_content_center"><a href="<?php echo $this->_tpl_vars['block']['dirname']; ?>
/viewtopic.php?no=<?php echo $this->_tpl_vars['topic']['topic_no']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['topic']['title'])) ? $this->_run_mod_handler('htmlencode', true, $_tmp) : htmlencode($_tmp)); ?>
"><span class="white_font"><?php echo ((is_array($_tmp=$this->_tpl_vars['topic']['titles'])) ? $this->_run_mod_handler('htmlencode', true, $_tmp) : htmlencode($_tmp)); ?>
&nbsp;(<?php echo $this->_tpl_vars['topic']['num']; ?>
)</span></a></div>
<?php endforeach; endif; unset($_from); ?>
<div id="forum_content_footer"></div>