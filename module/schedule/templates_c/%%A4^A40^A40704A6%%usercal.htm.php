<?php /* Smarty version 2.6.18, created on 2009-07-29 08:12:35
         compiled from block/usercal.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'block/usercal.htm', 29, false),)), $this); ?>
<?php if ($this->_tpl_vars['block']['url']['type'] == 'min'): ?>
<table class="sch m<?php echo $this->_tpl_vars['block']['url']['type']; ?>
">
<caption><?php echo $this->_tpl_vars['block']['url']['date']; ?>
</caption>
<thead>
<tr class="weektitle">
<td class="w0">日</td>
<td class="w1">一</td>
<td class="w2">二</td>
<td class="w3">三</td>
<td class="w4">四</td>
<td class="w5">五</td>
<td class="w6">六</td>
</tr>
</thead>
<tbody>
<?php $_from = $this->_tpl_vars['block']['info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['day']):
?>
<?php if ($this->_tpl_vars['day']['week'] == 0): ?><tr class="week"><?php endif; ?>
<td class="<?php echo $this->_tpl_vars['day']['class']; ?>
"><?php echo $this->_tpl_vars['day']['date']; ?>
</td>
<?php if ($this->_tpl_vars['day']['week'] == 6): ?></tr><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
</tbody>
</table>

<?php else: ?>
<div class="calhead">
<div class="calfun">
<a href="?<?php echo $this->_tpl_vars['block']['url']['serial']; ?>
&amp;type=<?php echo $this->_tpl_vars['block']['url']['type']; ?>
&amp;date=<?php echo $_GET['date']; ?>
&amp;sdate=-1&amp;tno=<?php echo $this->_tpl_vars['block']['tno']; ?>
#usercal">&lt;</a>
</div>
<a name="usercal" href="?date=<?php echo $_GET['date']; ?>
&amp;tno=<?php echo $this->_tpl_vars['block']['tno']; ?>
#usercal"><?php echo ((is_array($_tmp=$this->_tpl_vars['block']['url']['date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y-%b") : smarty_modifier_date_format($_tmp, "%Y-%b")); ?>
</a>
<a href="?<?php echo $this->_tpl_vars['block']['url']['serial']; ?>
&amp;type=<?php echo $this->_tpl_vars['block']['url']['type']; ?>
&amp;date=<?php echo $_GET['date']; ?>
&amp;sdate=1&amp;tno=<?php echo $this->_tpl_vars['block']['tno']; ?>
#usercal">&gt;</a>
</div>
<div class="calback">
<table class="sch m<?php echo $this->_tpl_vars['block']['url']['type']; ?>
 mmwd">
<caption></caption>
<tbody>
<?php $_from = $this->_tpl_vars['block']['info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['day']):
?>
<?php if ($this->_tpl_vars['day']['week'] == 0): ?><tr class="week"><?php endif; ?>
<td class="<?php echo $this->_tpl_vars['day']['class']; ?>
">
<div class="daylimit">
<?php echo $this->_tpl_vars['day']['date']; ?>

<div class="data">
<?php if ($this->_tpl_vars['block']['url']['type'] == 'mon'): ?><a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/module/schedule/viewday.php?<?php echo $this->_tpl_vars['block']['url']['serial']; ?>
&amp;type=day&amp;date=<?php echo $this->_tpl_vars['block']['url']['year']; ?>
/<?php echo $this->_tpl_vars['day']['date']; ?>
&amp;tno=<?php echo $this->_tpl_vars['block']['tno']; ?>
#usercal"><?php endif; ?>
<?php $_from = $this->_tpl_vars['day']['data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['data'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['data']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['_data']):
        $this->_foreach['data']['iteration']++;
?>
	<div class="caleven<?php echo $this->_foreach['data']['iteration']%2; ?>
">
		<?php if ($this->_tpl_vars['block']['url']['type'] == 'day'): ?>
		<div class="button"><a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/module/schedule/schModify-sample.php?sno=<?php echo $this->_tpl_vars['_data']['sno']; ?>
" style="line-height:46px;">編輯</a></div>
		<div class="button"><a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/module/schedule/schDel.php?sno=<?php echo $this->_tpl_vars['_data']['sno']; ?>
" style="line-height:46px;">刪除</a></div>
		<?php endif; ?>
		<?php echo $this->_tpl_vars['_data']['subject']; ?>

		<?php if ($this->_tpl_vars['_data']['content']): ?><div class="sch_content"><?php echo $this->_tpl_vars['_data']['content']; ?>
</div><?php endif; ?>
	</div>
	<?php if ($this->_tpl_vars['block']['url']['type'] == 'day'): ?><hr /><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['block']['url']['type'] == 'mon'): ?></a><?php endif; ?>
</div>
</div>
</td>
<?php if ($this->_tpl_vars['day']['week'] == 6): ?></tr><?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php if ($this->_tpl_vars['block']['url']['type'] == 'day'): ?></tr><?php endif; ?>
</tbody>
</table>

</div>
<div class="calbottom"></div>
<?php endif; ?>