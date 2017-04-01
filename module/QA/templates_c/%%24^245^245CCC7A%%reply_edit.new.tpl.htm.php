<?php /* Smarty version 2.6.18, created on 2009-08-28 07:26:51
         compiled from reply_edit.new.tpl.htm */ ?>
<form action="reply_edit.php?action=new_newpost" method="post">
<div id="newtopic_title">發表文章</div>
<br class="clear" />
<div id="newtopic_inner">
  <?php if ($this->_tpl_vars['err_msg'] != NULL): ?>
  <div class="newtopic_inner_l"></div>
  <div class="newtopic_inner_r" style="color: #FF0033; font-weight: bold;"><?php echo $this->_tpl_vars['err_msg']; ?>
</div>
  <br class="clear" />
  <br class="clear" />
  <?php endif; ?>
  <div class="newtopic_inner_l">內容:</div>
  <div class="newtopic_inner_r">
  <textarea name="Rcontent" cols="45" rows="8"><?php echo $this->_tpl_vars['Qcontent']; ?>
</textarea>
  </div>
  <br class="clear" />
  <br class="clear" />
  <div class="newtopic_inner_l"></div>
  <div class="newtopic_inner_r">
  <br class="clear" />
  <input name="isReply" type="hidden" value="1" />
  <input name="Rno" type="hidden" value="<?php echo $this->_tpl_vars['Rno']; ?>
" />
  <input name="submit" type="submit" value="發表文章" />
  <input name="reset" type="reset" value="重新填寫" />
  </div>
  <br class="clear" />
</div>
</form>