<?php /* Smarty version 2.6.18, created on 2009-08-28 11:30:05
         compiled from publicSet.tpl.php */ ?>

<div class="table">
    <div align="center"><img src="templates/images/list.gif"/></div>
        <blockquote>
          <blockquote><br/>
          </blockquote>
        </blockquote>
    <?php unset($this->_sections['gb']);
$this->_sections['gb']['name'] = 'gb';
$this->_sections['gb']['loop'] = is_array($_loop=$this->_tpl_vars['title']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['gb']['show'] = true;
$this->_sections['gb']['max'] = $this->_sections['gb']['loop'];
$this->_sections['gb']['step'] = 1;
$this->_sections['gb']['start'] = $this->_sections['gb']['step'] > 0 ? 0 : $this->_sections['gb']['loop']-1;
if ($this->_sections['gb']['show']) {
    $this->_sections['gb']['total'] = $this->_sections['gb']['loop'];
    if ($this->_sections['gb']['total'] == 0)
        $this->_sections['gb']['show'] = false;
} else
    $this->_sections['gb']['total'] = 0;
if ($this->_sections['gb']['show']):

            for ($this->_sections['gb']['index'] = $this->_sections['gb']['start'], $this->_sections['gb']['iteration'] = 1;
                 $this->_sections['gb']['iteration'] <= $this->_sections['gb']['total'];
                 $this->_sections['gb']['index'] += $this->_sections['gb']['step'], $this->_sections['gb']['iteration']++):
$this->_sections['gb']['rownum'] = $this->_sections['gb']['iteration'];
$this->_sections['gb']['index_prev'] = $this->_sections['gb']['index'] - $this->_sections['gb']['step'];
$this->_sections['gb']['index_next'] = $this->_sections['gb']['index'] + $this->_sections['gb']['step'];
$this->_sections['gb']['first']      = ($this->_sections['gb']['iteration'] == 1);
$this->_sections['gb']['last']       = ($this->_sections['gb']['iteration'] == $this->_sections['gb']['total']);
?>
      <br/><br/>
      <div style="float:left">
       	<?php if ($this->_tpl_vars['pubcheck'][$this->_sections['gb']['index']] == 1): ?><img src="templates/images/yes.gif" alt="問卷開放中"/>
       	<?php else: ?><img src="templates/images/no.gif" alt="問卷未開放"/>
      	<?php endif; ?>
      </div>
      <div style="float:left">第<?php echo $this->_tpl_vars['num'][$this->_sections['gb']['index']]; ?>
份問卷：<a href="answer.php?Qid=<?php echo $this->_tpl_vars['id'][$this->_sections['gb']['index']]; ?>
&anscheck=0"><?php echo $this->_tpl_vars['title'][$this->_sections['gb']['index']]; ?>
</a></div>
      <div style="float:right"><a href="switchPublic.php?Qid=<?php echo $this->_tpl_vars['id'][$this->_sections['gb']['index']]; ?>
">切換此份問卷是否開放</a></div>
  	<?php endfor; endif; ?> <br />
        <br />
         <div style="float:left"><form action="index.php" method="post" ><input type="submit" name="button" id="button" value="上一頁"></form></div>
  </td>
</div>