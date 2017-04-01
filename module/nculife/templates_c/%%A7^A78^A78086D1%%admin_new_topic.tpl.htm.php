<?php /* Smarty version 2.6.18, created on 2009-08-04 19:38:08
         compiled from admin_new_topic.tpl.htm */ ?>
<form action="admin_new_topic.php?action=save&curr_action=<?php echo $this->_tpl_vars['curr_action']; ?>
" method="post">
<div id="nl_admin_container">
  <div id="nl_admin_topic">編輯文章</div>
  <div id="nl_admin_item">
    <div align="right" id="nl_admin_item_l">文章標題</div>
    <div id="nl_admin_item_r"><input type="text" name="t_name" value="<?php echo $this->_tpl_vars['curr_topic_arr']['t_name']; ?>
" /></div>
  </div>
  <div id="nl_admin_item">
    <div align="right" id="nl_admin_item_l">文章所屬分類ID</div>
    <div id="nl_admin_item_r"><input type="text" name="t_b_cat_ID" value="<?php echo $this->_tpl_vars['curr_topic_arr']['t_b_cat_ID']; ?>
" /></div>
  </div>
  <div id="nl_admin_item">
    <div align="right" id="nl_admin_item_l" style="min-height: 120px;">文章內容</div>
    <div id="nl_admin_item_r" style="min-height: 120px;"><textarea name="t_contents" style="min-height:110px;" id="t_contents" cols="36" rows="5"><?php echo $this->_tpl_vars['curr_topic_arr']['t_contents']; ?>
</textarea></div>
  </div>
  <center>
  <input type="hidden" name="curr_t_ID" value="<?php echo $this->_tpl_vars['curr_t_ID']; ?>
" />
  <input type="hidden" name="t_b_at_ID" value="<?php echo $this->_tpl_vars['t_b_cat_ID']; ?>
" />
  <input type="submit" name="submit" value="新增編輯分類" />
  <input type="reset" name="reset" value="重新編輯" />
  </center>
</div>
</form>