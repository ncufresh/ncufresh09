<?php /* Smarty version 2.6.18, created on 2009-08-07 03:26:29
         compiled from newpage.tpl.php */ ?>
﻿<div id="QA_MAIN_OUTER">
	<div id="QA_navigate_bar">
		<div class="QA_divideBAR">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['QA_Ten_title']; ?>
</div>
		<div class="QA_content">
		<form action="./newQuest.php" method="post" >
		分類:
			<select name="select">
			<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['QA_cls']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['loop']['show'] = true;
$this->_sections['loop']['max'] = $this->_sections['loop']['loop'];
$this->_sections['loop']['step'] = 1;
$this->_sections['loop']['start'] = $this->_sections['loop']['step'] > 0 ? 0 : $this->_sections['loop']['loop']-1;
if ($this->_sections['loop']['show']) {
    $this->_sections['loop']['total'] = $this->_sections['loop']['loop'];
    if ($this->_sections['loop']['total'] == 0)
        $this->_sections['loop']['show'] = false;
} else
    $this->_sections['loop']['total'] = 0;
if ($this->_sections['loop']['show']):

            for ($this->_sections['loop']['index'] = $this->_sections['loop']['start'], $this->_sections['loop']['iteration'] = 1;
                 $this->_sections['loop']['iteration'] <= $this->_sections['loop']['total'];
                 $this->_sections['loop']['index'] += $this->_sections['loop']['step'], $this->_sections['loop']['iteration']++):
$this->_sections['loop']['rownum'] = $this->_sections['loop']['iteration'];
$this->_sections['loop']['index_prev'] = $this->_sections['loop']['index'] - $this->_sections['loop']['step'];
$this->_sections['loop']['index_next'] = $this->_sections['loop']['index'] + $this->_sections['loop']['step'];
$this->_sections['loop']['first']      = ($this->_sections['loop']['iteration'] == 1);
$this->_sections['loop']['last']       = ($this->_sections['loop']['iteration'] == $this->_sections['loop']['total']);
?>
				<option value="<?php echo $this->_tpl_vars['QA_cls'][$this->_sections['loop']['index']]['num']; ?>
"><?php echo $this->_tpl_vars['QA_cls'][$this->_sections['loop']['index']]['content']; ?>
</option>
			<?php endfor; endif; ?>
			</select><br /><br />
		標題:
			<input name="title" type="text" /><br /><br />
		<div style="float:left">內容:</div>
			<textarea rows="10" cols="70" name="descript"></textarea><br /><br />
		<div class="QA_submit"><input name="submit" type="submit" value="確定" /><input name="submit" type="submit" value="取消" /><input name="" type="reset" /></div>
		</form>
		</div>
	</div>
</div>