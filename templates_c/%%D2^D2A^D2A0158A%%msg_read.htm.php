<?php /* Smarty version 2.6.18, created on 2010-07-02 00:02:45
         compiled from msg_read.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'urlencode', 'msg_read.htm', 7, false),)), $this); ?>
<div id="ma_container">
 <div class="ma_read_title"><?php echo $this->_tpl_vars['msg']['title']; ?>
</div>
   <div class="ma_read_detail">
     <div align="left" style="width:500px; float: left;">寄件日期：<?php echo $this->_tpl_vars['msg']['time']; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;寄件人：<?php echo $this->_tpl_vars['msg']['sender_id']; ?>
</div>
     <div align="right" style="width: 200px; float: left;">
       <a href="redirect.php?1" title="我的信箱">[收件匣]</a>
       <a href="msgsend.php?msgreply=1&title=<?php echo ((is_array($_tmp=$this->_tpl_vars['msg']['title'])) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
&fno=<?php echo $this->_tpl_vars['msg']['sender_no']; ?>
" title="回覆留言">[回覆]</a>
       <a href="msgbox_do.php?msgdel=1&mno=<?php echo $this->_tpl_vars['msg']['mno']; ?>
" title="刪除留言">[刪除]</a>
     </div>
   </div>
   <div class="ma_read_content"><?php echo $this->_tpl_vars['msg']['content']; ?>
</div>
</div>