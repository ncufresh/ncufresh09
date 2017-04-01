<?php /* Smarty version 2.6.18, created on 2009-08-21 17:24:23
         compiled from newQuestion.tpl.php */ ?>
<div class="table">
<p>題號：第<?php echo $this->_tpl_vars['QuestionNum']; ?>
題</p>
<form method="get" action="newQuestion.php">
	<input type="hidden" name="Qid" value="<?php echo $this->_tpl_vars['Qid']; ?>
">
<p>選項數：<input autocomplete="off" name="ChooseNum" id="ChooseNum" type="text" />
<input type="submit" value="確定"></p>
</form>

<form method="post" action="importQuestions.php?Qid=<?php echo $this->_tpl_vars['Qid']; ?>
&ChooseNum=<?php echo $this->_tpl_vars['ChooseNum']; ?>
&status=new">
<p>題型：
  <select name="select" id="select">
  <option value="1" selected="selected">單選題</option>
  <option value="2">多選題</option>
  </select>
</p>
<input type="hidden" name="Qid" value="<?php echo $this->_tpl_vars['Qid']; ?>
">
<input type="hidden" name="gid" value="<?php echo $this->_tpl_vars['QuestionNum']; ?>
">

<div style="float:left">問題敘述：</div>
	<div style="float:left"><textarea autocomplete="off" name="question" id="textfield"><?php echo $this->_tpl_vars['qst']; ?>
</textarea></div>
<p><p>
<br>
<br>
<br>
</p></p>

<?php unset($this->_sections['choose']);
$this->_sections['choose']['name'] = 'choose';
$this->_sections['choose']['loop'] = is_array($_loop=$this->_tpl_vars['ChooseNum']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['choose']['show'] = true;
$this->_sections['choose']['max'] = $this->_sections['choose']['loop'];
$this->_sections['choose']['step'] = 1;
$this->_sections['choose']['start'] = $this->_sections['choose']['step'] > 0 ? 0 : $this->_sections['choose']['loop']-1;
if ($this->_sections['choose']['show']) {
    $this->_sections['choose']['total'] = $this->_sections['choose']['loop'];
    if ($this->_sections['choose']['total'] == 0)
        $this->_sections['choose']['show'] = false;
} else
    $this->_sections['choose']['total'] = 0;
if ($this->_sections['choose']['show']):

            for ($this->_sections['choose']['index'] = $this->_sections['choose']['start'], $this->_sections['choose']['iteration'] = 1;
                 $this->_sections['choose']['iteration'] <= $this->_sections['choose']['total'];
                 $this->_sections['choose']['index'] += $this->_sections['choose']['step'], $this->_sections['choose']['iteration']++):
$this->_sections['choose']['rownum'] = $this->_sections['choose']['iteration'];
$this->_sections['choose']['index_prev'] = $this->_sections['choose']['index'] - $this->_sections['choose']['step'];
$this->_sections['choose']['index_next'] = $this->_sections['choose']['index'] + $this->_sections['choose']['step'];
$this->_sections['choose']['first']      = ($this->_sections['choose']['iteration'] == 1);
$this->_sections['choose']['last']       = ($this->_sections['choose']['iteration'] == $this->_sections['choose']['total']);
?>
  <div><?php echo $this->_sections['choose']['iteration']; ?>
.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input autocomplete="off" name="choose[]" type="text" /></div>
        <?php endfor; else: ?>
        <?php endif; ?>
        <br/>
        <input type="checkbox" name="others" value="others" /> 是否有「其他」選項
        <br/>
        
<input type="submit" value="送出"></form>
<div style="float:left"><form action="editSheet.php?Qid=<?php echo $this->_tpl_vars['Qid']; ?>
" method="post" ><input type="submit" value="回到問卷" /></form></div>

</div>