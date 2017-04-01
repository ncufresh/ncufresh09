<?php /* Smarty version 2.6.18, created on 2009-08-16 16:02:01
         compiled from answer.tpl.php */ ?>
<table class="table"> 
<tr><td>
	<div align="center"><img src="templates/images/Topic.gif"/></div>
		<blockquote>
   	 		<blockquote>
      			<?php echo $this->_tpl_vars['topic']; ?>

    		</blockquote>
  		</blockquote>
  	<div align="center"><img src="templates/images/info.gif"/></div>
  		<blockquote>
    		<blockquote>
      			<p><?php echo $this->_tpl_vars['description']; ?>
        </p>
                <?php if ($this->_tpl_vars['anschk'] == 1): ?><p align="center">請確實填寫問卷內容</p><?php endif; ?>
    		</blockquote>
  		</blockquote>
	<form method="post" action="./importAnswer.php?sno=<?php echo $this->_tpl_vars['SheetNumber']; ?>
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
?></br></p><br>
		<div><div class="question">問題<?php echo $this->_sections['qst']['iteration']; ?>
 : <?php echo $this->_tpl_vars['questions'][$this->_sections['qst']['index']]; ?>
 </div><br/>
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
            <div>
            	<div class="chooses">選項<?php echo $this->_sections['choose']['iteration']; ?>
:<?php if ($this->_tpl_vars['choose'][$this->_sections['qst']['index']][$this->_sections['choose']['index']] != 'others'): ?>
          		<input name="<?php echo $this->_tpl_vars['chsname'][$this->_sections['qst']['index']]; ?>
" type="<?php echo $this->_tpl_vars['type'][$this->_sections['qst']['index']]; ?>
" value="<?php echo $this->_tpl_vars['choose'][$this->_sections['qst']['index']][$this->_sections['choose']['index']]; ?>
"><?php echo $this->_tpl_vars['choose'][$this->_sections['qst']['index']][$this->_sections['choose']['index']]; ?>

          		<?php elseif ($this->_tpl_vars['choose'][$this->_sections['qst']['index']][$this->_sections['choose']['index']] == 'others'): ?>
          			<input type="<?php echo $this->_tpl_vars['type'][$this->_sections['qst']['index']]; ?>
" name="<?php echo $this->_tpl_vars['chsname'][$this->_sections['qst']['index']]; ?>
" value="otherson">其他：</div>
          			<div><textarea name="ans<?php echo $this->_sections['qst']['iteration']-1; ?>
-TEXT"></textarea></div>
          		<?php endif; ?>
			</div><br />
                <?php endfor; endif; ?>
		</div>
	<?php endfor; endif; ?>
  <a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/redirect.php?1"><input type="button" name="button" id="button" value="上一頁"></a>
  <input type="hidden" name="uid" value="<?php echo $this->_tpl_vars['uid']; ?>
">
  <input type="submit" value="送出"></form>
</td></tr></table>