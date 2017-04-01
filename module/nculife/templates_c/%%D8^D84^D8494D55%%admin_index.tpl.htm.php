<?php /* Smarty version 2.6.18, created on 2009-08-03 23:27:58
         compiled from admin_index.tpl.htm */ ?>
<div id="nl_admin_container">
<div style="color:#FF3399; font-weight: bold;"><?php echo $this->_tpl_vars['msg']; ?>
</div>
<a href="admin_new_cat.php">[新增分類]</a><br /><br />
<form action="admin_edit_order.php" method="post">
<?php unset($this->_sections['cat']);
$this->_sections['cat']['name'] = 'cat';
$this->_sections['cat']['loop'] = is_array($_loop=$this->_tpl_vars['cat_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cat']['show'] = true;
$this->_sections['cat']['max'] = $this->_sections['cat']['loop'];
$this->_sections['cat']['step'] = 1;
$this->_sections['cat']['start'] = $this->_sections['cat']['step'] > 0 ? 0 : $this->_sections['cat']['loop']-1;
if ($this->_sections['cat']['show']) {
    $this->_sections['cat']['total'] = $this->_sections['cat']['loop'];
    if ($this->_sections['cat']['total'] == 0)
        $this->_sections['cat']['show'] = false;
} else
    $this->_sections['cat']['total'] = 0;
if ($this->_sections['cat']['show']):

            for ($this->_sections['cat']['index'] = $this->_sections['cat']['start'], $this->_sections['cat']['iteration'] = 1;
                 $this->_sections['cat']['iteration'] <= $this->_sections['cat']['total'];
                 $this->_sections['cat']['index'] += $this->_sections['cat']['step'], $this->_sections['cat']['iteration']++):
$this->_sections['cat']['rownum'] = $this->_sections['cat']['iteration'];
$this->_sections['cat']['index_prev'] = $this->_sections['cat']['index'] - $this->_sections['cat']['step'];
$this->_sections['cat']['index_next'] = $this->_sections['cat']['index'] + $this->_sections['cat']['step'];
$this->_sections['cat']['first']      = ($this->_sections['cat']['iteration'] == 1);
$this->_sections['cat']['last']       = ($this->_sections['cat']['iteration'] == $this->_sections['cat']['total']);
?>
  
  <div id="nl_admin_cat">
  (分類ID: <?php echo $this->_tpl_vars['cat_arr'][$this->_sections['cat']['index']]['cat_ID']; ?>
)
  <?php echo $this->_tpl_vars['cat_arr'][$this->_sections['cat']['index']]['cat_name']; ?>

  <a href="admin_new_topic.php?action=new&cat_ID=<?php echo $this->_tpl_vars['cat_arr'][$this->_sections['cat']['index']]['cat_ID']; ?>
">[新增文章]</a>
  <a href="admin_new_cat.php?action=edit&cat_ID=<?php echo $this->_tpl_vars['cat_arr'][$this->_sections['cat']['index']]['cat_ID']; ?>
">[編輯]</a>
  <a href="admin_new_cat.php?action=delete&cat_ID=<?php echo $this->_tpl_vars['cat_arr'][$this->_sections['cat']['index']]['cat_ID']; ?>
">[刪除]</a>
  順序：<input name="cat_order_<?php echo $this->_tpl_vars['cat_arr'][$this->_sections['cat']['index']]['cat_ID']; ?>
" type="text" size="1" value="<?php echo $this->_tpl_vars['cat_arr'][$this->_sections['cat']['index']]['cat_sort']; ?>
" />
  </div>
  
  <?php unset($this->_sections['topic']);
$this->_sections['topic']['name'] = 'topic';
$this->_sections['topic']['loop'] = is_array($_loop=$this->_tpl_vars['topic_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['topic']['show'] = true;
$this->_sections['topic']['max'] = $this->_sections['topic']['loop'];
$this->_sections['topic']['step'] = 1;
$this->_sections['topic']['start'] = $this->_sections['topic']['step'] > 0 ? 0 : $this->_sections['topic']['loop']-1;
if ($this->_sections['topic']['show']) {
    $this->_sections['topic']['total'] = $this->_sections['topic']['loop'];
    if ($this->_sections['topic']['total'] == 0)
        $this->_sections['topic']['show'] = false;
} else
    $this->_sections['topic']['total'] = 0;
if ($this->_sections['topic']['show']):

            for ($this->_sections['topic']['index'] = $this->_sections['topic']['start'], $this->_sections['topic']['iteration'] = 1;
                 $this->_sections['topic']['iteration'] <= $this->_sections['topic']['total'];
                 $this->_sections['topic']['index'] += $this->_sections['topic']['step'], $this->_sections['topic']['iteration']++):
$this->_sections['topic']['rownum'] = $this->_sections['topic']['iteration'];
$this->_sections['topic']['index_prev'] = $this->_sections['topic']['index'] - $this->_sections['topic']['step'];
$this->_sections['topic']['index_next'] = $this->_sections['topic']['index'] + $this->_sections['topic']['step'];
$this->_sections['topic']['first']      = ($this->_sections['topic']['iteration'] == 1);
$this->_sections['topic']['last']       = ($this->_sections['topic']['iteration'] == $this->_sections['topic']['total']);
?>
  <?php if ($this->_tpl_vars['topic_arr'][$this->_sections['topic']['index']]['t_b_cat_ID'] == $this->_tpl_vars['cat_arr'][$this->_sections['cat']['index']]['cat_ID']): ?>
  
  <div id="nl_admin_item">
    <div id="nl_admin_item_l"><?php echo $this->_tpl_vars['topic_arr'][$this->_sections['topic']['index']]['t_name']; ?>
</div>
    <div id="nl_admin_item_r">
    <a href="admin_new_topic.php?action=edit&t_ID=<?php echo $this->_tpl_vars['topic_arr'][$this->_sections['topic']['index']]['t_ID']; ?>
">[編輯]</a>
    <a href="admin_new_topic.php?action=delete&t_ID=<?php echo $this->_tpl_vars['topic_arr'][$this->_sections['topic']['index']]['t_ID']; ?>
">[刪除]</a>
    順序：<input name="topic_order_<?php echo $this->_tpl_vars['topic_arr'][$this->_sections['topic']['index']]['t_ID']; ?>
" type="text" size="1" value="<?php echo $this->_tpl_vars['topic_arr'][$this->_sections['topic']['index']]['t_sort']; ?>
" />
    </div>
  </div>
  <?php endif; ?>
  <?php endfor; endif; ?>
  
<?php endfor; endif; ?>

<center>
<input type="submit" name="submit" value="更改設定" />
<input type="reset" name="reset" value="更改回原設定值" />
</center>
</form>
</div>