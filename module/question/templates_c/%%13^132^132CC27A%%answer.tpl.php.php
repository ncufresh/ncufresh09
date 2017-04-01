<?php /* Smarty version 2.6.18, created on 2009-08-06 15:44:06
         compiled from answer.tpl.php */ ?>
<div class="table" > 
		<div class = "header" >
		<br />
		<br />
		<br />
			<div style="font-size:120%;">
			&nbsp;&nbsp;&nbsp;問卷標題:<?php echo $this->_tpl_vars['topic']; ?>
<br /><br />
			&nbsp;&nbsp;&nbsp;問卷概述:
			<blockquote>
				<p><?php echo $this->_tpl_vars['description']; ?>
        </p>
			</blockquote>		
			<img src="templates/images/QuBar.gif"/>
		</div>
	<?php if ($this->_tpl_vars['anschk'] == 1): ?><p align="center">請確實填寫問卷內容</p><?php endif; ?>
	<form method="post" action="./importAnswer.php?Qid=<?php echo $this->_tpl_vars['SheetNumber']; ?>
" >
	<?php unset($this->_sections['qst']);
$this->_sections['qst']['name'] = 'qst';
$this->_sections['qst']['loop'] = is_array($_loop=$this->_tpl_vars['questions']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['qst']['show'] = true;
$this->_sections['qst']['max'] = $this->_sections['qst']['loop'];
$this->_sections['qst']['step'] = 1;
$this->_sections['qst']['start'] = $this->_sections['qst']['step'] > 0 ? 0 : $this->_sections['qst']['loop']-1;
if ($this->_sections['qst']['show']) {
    $this->_sections['qst']['total'] = $this->_sections['qst']['loop'];
    if ($this->_sections['qst']['total'] == 0)
        $this->_sections['qst']['show'] = false;
} else
    $this->_sections['qst']['total'] = 0;
if ($this->_sections['qst']['show']):

            for ($this->_sections['qst']['index'] = $this->_sections['qst']['start'], $this->_sections['qst']['iteration'] = 1;
                 $this->_sections['qst']['iteration'] <= $this->_sections['qst']['total'];
                 $this->_sections['qst']['index'] += $this->_sections['qst']['step'], $this->_sections['qst']['iteration']++):
$this->_sections['qst']['rownum'] = $this->_sections['qst']['iteration'];
$this->_sections['qst']['index_prev'] = $this->_sections['qst']['index'] - $this->_sections['qst']['step'];
$this->_sections['qst']['index_next'] = $this->_sections['qst']['index'] + $this->_sections['qst']['step'];
$this->_sections['qst']['first']      = ($this->_sections['qst']['iteration'] == 1);
$this->_sections['qst']['last']       = ($this->_sections['qst']['iteration'] == $this->_sections['qst']['total']);
?><br /></p><br>
		<div class="newquestion"><?php echo $this->_sections['qst']['iteration']; ?>
. <?php echo $this->_tpl_vars['questions'][$this->_sections['qst']['index']]; ?>
 </div><br/>
                <blockquote>
				<?php unset($this->_sections['choose']);
$this->_sections['choose']['name'] = 'choose';
$this->_sections['choose']['loop'] = is_array($_loop=$this->_tpl_vars['choose'][$this->_sections['qst']['index']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
				<?php if ($this->_tpl_vars['choose'][$this->_sections['qst']['index']][$this->_sections['choose']['index']] != 'others'): ?>
          		<div class="chooses"><?php echo $this->_sections['choose']['iteration']; ?>
.<input name="<?php echo $this->_tpl_vars['chsname'][$this->_sections['qst']['index']]; ?>
" type="<?php echo $this->_tpl_vars['type'][$this->_sections['qst']['index']]; ?>
" value="<?php echo $this->_tpl_vars['choose'][$this->_sections['qst']['index']][$this->_sections['choose']['index']]; ?>
"><?php echo $this->_tpl_vars['choose'][$this->_sections['qst']['index']][$this->_sections['choose']['index']]; ?>
</div>
          		<?php elseif ($this->_tpl_vars['choose'][$this->_sections['qst']['index']][$this->_sections['choose']['index']] == 'others'): ?>
          			<div style="float:left;"><div class="chooses"><?php echo $this->_sections['choose']['iteration']; ?>
. <input type="<?php echo $this->_tpl_vars['type'][$this->_sections['qst']['index']]; ?>
" name="<?php echo $this->_tpl_vars['chsname'][$this->_sections['qst']['index']]; ?>
" value="otherson">其他：<textarea name="ans<?php echo $this->_sections['qst']['iteration']-1; ?>
-TEXT"></textarea></div></div>
          		<?php endif; ?>
               <?php endfor; endif; ?>
			   </blockquote>
			   <br />
	<?php endfor; endif; ?>
  <input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['uid']; ?>
">
  <br />
  <div class = "end" align="center" class ="chooses"><input type="submit" name="submit" value="上一頁"><input type="submit" name="submit" value="送出"></div>
  </form>
  </div>
</div>