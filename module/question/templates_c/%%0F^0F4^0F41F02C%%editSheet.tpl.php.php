<?php /* Smarty version 2.6.18, created on 2009-08-21 17:24:20
         compiled from editSheet.tpl.php */ ?>
<div class="table">
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
		<br /> 
    <blockquote>
	<div style="float:left"><form action="<?php echo $this->_tpl_vars['newQuestLink']; ?>
" method="post" ><input type="submit" value="新增問題" /></form></div>
	<div style="float:left"><form action="addSheet.php?Qid=<?php echo $this->_tpl_vars['sheetNum']; ?>
" method="post" ><input type="submit" value="確認送出" /></form></div>
	<div style="float:left"><form action="./index.php" method="post" ><input type="submit" value="以後再作" /></form></div>
	<div style="float:left"><form action="giveupSheet.php?Qid=<?php echo $this->_tpl_vars['sheetNum']; ?>
" method="post" ><input type="submit" value="放棄 刪除" /></form></div>
	<br/>
    </blockquote>
		
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
?></br></p><br>
	<div class="newquestion"><?php echo $this->_sections['qst']['iteration']; ?>
. <?php echo $this->_tpl_vars['questions'][$this->_sections['qst']['index']]; ?>
   
    <?php if ($this->_tpl_vars['type'][$this->_sections['qst']['index']] == 'radio'): ?>  <單選題> <?php else: ?> <多選題> <?php endif; ?></div>
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
            	<div class="chooses"><?php echo $this->_sections['choose']['iteration']; ?>
. <?php if ($this->_tpl_vars['choose'][$this->_sections['qst']['index']][$this->_sections['choose']['index']] != 'others'): ?>
          		<input name="<?php echo $this->_tpl_vars['chsname'][$this->_sections['qst']['index']]; ?>
" type="<?php echo $this->_tpl_vars['type'][$this->_sections['qst']['index']]; ?>
" value="<?php echo $this->_tpl_vars['choose'][$this->_sections['qst']['index']][$this->_sections['choose']['index']]; ?>
"><?php echo $this->_tpl_vars['choose'][$this->_sections['qst']['index']][$this->_sections['choose']['index']]; ?>
</div>
          		<?php elseif ($this->_tpl_vars['choose'][$this->_sections['qst']['index']][$this->_sections['choose']['index']] == 'others'): ?>
          			<input type="<?php echo $this->_tpl_vars['type'][$this->_sections['qst']['index']]; ?>
" name="<?php echo $this->_tpl_vars['chsname'][$this->_sections['qst']['index']]; ?>
" value="otherson">其他：</div>
          			<div class="chooses"><textarea name="ans<?php echo $this->_sections['qst']['iteration']-1; ?>
-TEXT"></textarea></div>
          		<?php endif; ?>
         <?php endfor; endif; ?>
		 </blockquote>
	<blockquote>
	<div style="float:right"><form action="delQuestion.php?Qid=<?php echo $this->_tpl_vars['sheetNum']; ?>
&sig=<?php echo $this->_sections['qst']['iteration']; ?>
" method="post" ><input type="submit" value="刪除問題" /></form></div>
    <div style="float:right"><form action="editQuestion.php?Qid=<?php echo $this->_tpl_vars['sheetNum']; ?>
&sig=<?php echo $this->_sections['qst']['iteration']; ?>
" method="post" ><input type="submit" value="編輯問題" /></form></div>
	</blockquote>
<?php endfor; endif; ?>

</div>


