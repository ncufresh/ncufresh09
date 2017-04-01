<?php /* Smarty version 2.6.18, created on 2009-08-20 21:19:28
         compiled from topic_edit.edit.tpl.htm */ ?>
<form action="topic_edit.php?action=new_edit" method="post">
<div id="newtopic_title">編輯文章</div>
<br class="clear" />
<div id="newtopic_inner">
  <?php if ($this->_tpl_vars['err_msg'] != NULL): ?>
  <div class="newtopic_inner_l"></div>
  <div class="newtopic_inner_r" style="color: #FF0033; font-weight: bold;"><?php echo $this->_tpl_vars['err_msg']; ?>
</div>
  <br class="clear" />
  <br class="clear" />
  <?php endif; ?>
  <div class="newtopic_inner_l">分類:</div>
  <div class="newtopic_inner_r">
  <select name="Qcls">
    <?php echo $this->_tpl_vars['Qcls']; ?>

  </select>
  </div>
  <br class="clear" />
  <br class="clear" />
  <div class="newtopic_inner_l">標題:</div>
  <div class="newtopic_inner_r"><input name="Qtitle" type="text" value="<?php echo $this->_tpl_vars['Qtitle']; ?>
" /></div>
  <br class="clear" />
  <br class="clear" />
  <div class="newtopic_inner_l">內容:</div>
  <div class="newtopic_inner_r">
  <textarea name="Qcontent" cols="45" rows="8"><?php echo $this->_tpl_vars['Qcontent']; ?>
</textarea>
  </div>
  <br class="clear" />
  <br class="clear" />
  <div class="newtopic_inner_l"></div>
  <div class="newtopic_inner_r">
  <br class="clear" />
  <input name="isEdit" type="hidden" value="1" />
  <input name="Qno" type="hidden" value="<?php echo $this->_tpl_vars['Qno']; ?>
" />
  <input name="submit" type="submit" value="編輯文章" />
  <input name="reset" type="reset" value="重新填寫" />
  </div>
  <br class="clear" />
</div>
</form>