<?php /* Smarty version 2.6.18, created on 2009-08-04 20:16:12
         compiled from allversion.htm */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "topic_header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="topic_view">
<p class="field2_top"><?php echo $this->_tpl_vars['_WikiTopic']->title; ?>
 - 編修紀錄</p>
<div class="field2_content">
  <table border="0" cellpadding="5" cellspacing="0" style="border-collapse: collapse;" align="center">
    <tr>
      <th>編輯時間</th>
      <th>編輯者</th>
    </tr>
<?php $_from = $this->_tpl_vars['posts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['post'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['post']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['post']):
        $this->_foreach['post']['iteration']++;
?>
    <tr>
      <td><a href="view.php?pno=<?php echo $this->_tpl_vars['post']['pno']; ?>
" title="VIEW"><?php echo $this->_tpl_vars['post']['posttime']; ?>
</a></td>
      <td><a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/show_pfile.php?uno=<?php echo $this->_tpl_vars['post']['poster_no']; ?>
"><?php echo $this->_tpl_vars['post']['poster_id']; ?>
 (<?php echo $this->_tpl_vars['post']['poster_name']; ?>
)</a></td>
    </tr>
<?php endforeach; endif; unset($_from); ?>
  </table>
</div>
<p class="field2_bottom"></p>
</div>