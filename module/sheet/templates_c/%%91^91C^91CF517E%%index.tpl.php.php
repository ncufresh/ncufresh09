<?php /* Smarty version 2.6.18, created on 2009-08-21 10:42:51
         compiled from index.tpl.php */ ?>
<table class="table">
    <td><div align="center"><img src="templates/images/list.gif"/></div>
        <?php if ($this->_tpl_vars['admin']): ?>
        	<blockquote>
        	 <blockquote><a href="newSheet.php"><input type="button" value="點此新增問券" /></a>   
             <a href="publicSet.php"><input type="button" value="管理問卷是否開放作答" /></a><br/>
         	 </blockquote>
        	</blockquote>
        <?php endif; ?>
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
       	<?php if ($this->_tpl_vars['anscheck'][$this->_sections['gb']['index']] == 1): ?><img src="templates/images/yes.gif" alt="問卷已完成~"/>
       	<?php else: ?><img src="templates/images/empty.gif" alt="問卷未完成~"/>
      	<?php endif; ?>
      </div>
      <div style="float:left">第<?php echo $this->_tpl_vars['SN'][$this->_sections['gb']['index']]; ?>
份問卷：<a href="answer.php?sno=<?php echo $this->_tpl_vars['SN'][$this->_sections['gb']['index']]; ?>
"><?php echo $this->_tpl_vars['title'][$this->_sections['gb']['index']]; ?>
</a></div>
      <?php if ($this->_tpl_vars['admin']): ?><div style="float:right"><a href="showStatics.php?sno=<?php echo $this->_tpl_vars['SN'][$this->_sections['gb']['index']]; ?>
">觀看回答數據</a></div><?php endif; ?>
      <?php if ($this->_tpl_vars['anscheck'][$this->_sections['gb']['index']] == 1): ?><div style="float:right">(已完成)</div><?php endif; ?>
    <?php endfor; else: ?>
      目前沒有問券~
  	<?php endif; ?> <br />
        <br />
    <div><?php echo $this->_tpl_vars['SU']; ?>
</div></td>
</table>