<?php /* Smarty version 2.6.18, created on 2009-08-21 17:23:51
         compiled from newSheet.tpl.php */ ?>
<div class="table">
<div align="center">問卷名稱及問卷說明務必確實填寫</div>
<p>這是第<?php echo $this->_tpl_vars['sheetNum']; ?>
份問券</p>
<form action="./editSheet.php?Qid=<?php echo $this->_tpl_vars['sheetNum']; ?>
" method="post" >
  問卷標題：
    <input AUTOCOMPLETE="off" type="text" name="topic">
    <input AUTOCOMPLETE="off" type="hidden" name="sheetNum" value="<?php echo $this->_tpl_vars['sheetNum']; ?>
">
  <br/><br/>

  <div style="float:left">問卷概述：</div><div>
<textarea AUTOCOMPLETE="off" rows="5" cols="50" name="descript"></textarea></div>
    <p>
    <input type="hidden" name="status" value="new">
    <input type="submit" value="下一步" /></form>
<p>
	<div style="float:left"><form action="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/redirect.php?1" method="post" ><input type="submit" name="button" id="button" value="上一頁"></form></div>
    </p>
<br />
<br />
<br />
<p>&nbsp;尚未完成的問卷：</p>
<?php unset($this->_sections['sheet']);
$this->_sections['sheet']['name'] = 'sheet';
$this->_sections['sheet']['loop'] = is_array($_loop=$this->_tpl_vars['link']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sheet']['show'] = true;
$this->_sections['sheet']['max'] = $this->_sections['sheet']['loop'];
$this->_sections['sheet']['step'] = 1;
$this->_sections['sheet']['start'] = $this->_sections['sheet']['step'] > 0 ? 0 : $this->_sections['sheet']['loop']-1;
if ($this->_sections['sheet']['show']) {
    $this->_sections['sheet']['total'] = $this->_sections['sheet']['loop'];
    if ($this->_sections['sheet']['total'] == 0)
        $this->_sections['sheet']['show'] = false;
} else
    $this->_sections['sheet']['total'] = 0;
if ($this->_sections['sheet']['show']):

            for ($this->_sections['sheet']['index'] = $this->_sections['sheet']['start'], $this->_sections['sheet']['iteration'] = 1;
                 $this->_sections['sheet']['iteration'] <= $this->_sections['sheet']['total'];
                 $this->_sections['sheet']['index'] += $this->_sections['sheet']['step'], $this->_sections['sheet']['iteration']++):
$this->_sections['sheet']['rownum'] = $this->_sections['sheet']['iteration'];
$this->_sections['sheet']['index_prev'] = $this->_sections['sheet']['index'] - $this->_sections['sheet']['step'];
$this->_sections['sheet']['index_next'] = $this->_sections['sheet']['index'] + $this->_sections['sheet']['step'];
$this->_sections['sheet']['first']      = ($this->_sections['sheet']['iteration'] == 1);
$this->_sections['sheet']['last']       = ($this->_sections['sheet']['iteration'] == $this->_sections['sheet']['total']);
?>
<p><a href="<?php echo $this->_tpl_vars['link'][$this->_sections['sheet']['index']]; ?>
">&nbsp;<?php echo $this->_tpl_vars['linkname'][$this->_sections['sheet']['index']]; ?>
</a></p>
<?php endfor; endif; ?>
</div>