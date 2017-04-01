<?php /* Smarty version 2.6.18, created on 2009-08-21 17:25:55
         compiled from showDetail.tpl.php */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'showDetail.tpl.php', 46, false),)), $this); ?>
<script type="text/javascript">
	function switchgraph()
	{
		if ($('graph_0').style.display == 'block')
		{
			$('graph_0').style.display = 'none';
			$('graph_1').style.display = 'block';
		}
		else
		{
			$('graph_0').style.display = 'block';
			$('graph_1').style.display = 'none';
		}
	}
	
</script>

    <div class="table"><div style="margin-left:80px;"><div class="newquestion" style="float:left">
	<?php echo $this->_tpl_vars['qis']; ?>
. <?php echo $this->_tpl_vars['questions'][$this->_tpl_vars['qqis']]; ?>
 
    <?php if ($this->_tpl_vars['type'][$this->_tpl_vars['qis']] == 'radio'): ?>
    	<單選題>
    <?php elseif ($this->_tpl_vars['type'][$this->_tpl_vars['qis']] == 'checkbox'): ?>
    	<多選題>
    <?php endif; ?>
	</div>
	<div id="graph_0" style="display:<?php echo $this->_tpl_vars['graphdisplay'][0]; ?>
" ><div class="chart_1st"><?php echo $this->_tpl_vars['graphpie']; ?>
</div></div>
    <div id="graph_1" style="display:<?php echo $this->_tpl_vars['graphdisplay'][1]; ?>
" ><div class="chart"><?php echo $this->_tpl_vars['graphsketch']; ?>
</div></div>
	<?php unset($this->_sections['choose']);
$this->_sections['choose']['name'] = 'choose';
$this->_sections['choose']['loop'] = is_array($_loop=$this->_tpl_vars['choose'][$this->_tpl_vars['qqis']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
    <div class="choose">
	 <?php echo $this->_sections['choose']['iteration']; ?>
.
     	  <?php if ($this->_tpl_vars['choose'][$this->_tpl_vars['qqis']][$this->_sections['choose']['index']] != 'others'): ?>
          	<?php echo $this->_tpl_vars['choose'][$this->_tpl_vars['qqis']][$this->_sections['choose']['index']]; ?>
&nbsp;&nbsp;出現&nbsp;&nbsp;
          	<?php if ($this->_tpl_vars['anscount'][$this->_tpl_vars['qis']][$this->_sections['choose']['iteration']] != 0): ?>
          		<?php echo $this->_tpl_vars['anscount'][$this->_tpl_vars['qis']][$this->_sections['choose']['iteration']]; ?>

          	<?php else: ?>0<?php endif; ?>&nbsp;&nbsp;次
          <?php elseif ($this->_tpl_vars['choose'][$this->_tpl_vars['qqis']][$this->_sections['choose']['index']] == 'others'): ?>其他&nbsp;&nbsp;出現&nbsp;&nbsp;
          	<?php if ($this->_tpl_vars['othercount'][$this->_tpl_vars['qis']] != 0): ?>
          	<?php echo $this->_tpl_vars['othercount'][$this->_tpl_vars['qis']]; ?>

          	<?php else: ?>0<?php endif; ?>&nbsp;&nbsp;次
          <?php endif; ?>
	</div><br/><?php endfor; endif; ?> 
	<br/><br/>
	<?php if ($this->_tpl_vars['othercontent'] != NULL): ?>
    以下是諸位使用者的怒吼：<br /><br /><br />
		<?php unset($this->_sections['times']);
$this->_sections['times']['name'] = 'times';
$this->_sections['times']['loop'] = is_array($_loop=$this->_tpl_vars['othercontent'][$this->_tpl_vars['qis']]) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['times']['show'] = true;
$this->_sections['times']['max'] = $this->_sections['times']['loop'];
$this->_sections['times']['step'] = 1;
$this->_sections['times']['start'] = $this->_sections['times']['step'] > 0 ? 0 : $this->_sections['times']['loop']-1;
if ($this->_sections['times']['show']) {
    $this->_sections['times']['total'] = $this->_sections['times']['loop'];
    if ($this->_sections['times']['total'] == 0)
        $this->_sections['times']['show'] = false;
} else
    $this->_sections['times']['total'] = 0;
if ($this->_sections['times']['show']):

            for ($this->_sections['times']['index'] = $this->_sections['times']['start'], $this->_sections['times']['iteration'] = 1;
                 $this->_sections['times']['iteration'] <= $this->_sections['times']['total'];
                 $this->_sections['times']['index'] += $this->_sections['times']['step'], $this->_sections['times']['iteration']++):
$this->_sections['times']['rownum'] = $this->_sections['times']['iteration'];
$this->_sections['times']['index_prev'] = $this->_sections['times']['index'] - $this->_sections['times']['step'];
$this->_sections['times']['index_next'] = $this->_sections['times']['index'] + $this->_sections['times']['step'];
$this->_sections['times']['first']      = ($this->_sections['times']['iteration'] == 1);
$this->_sections['times']['last']       = ($this->_sections['times']['iteration'] == $this->_sections['times']['total']);
?>
  			<?php echo ((is_array($_tmp=@$this->_tpl_vars['othercontent'][$this->_tpl_vars['qis']][$this->_sections['times']['index']])) ? $this->_run_mod_handler('default', true, $_tmp, "<這茶包居然沒有留下他的意見>") : smarty_modifier_default($_tmp, "<這茶包居然沒有留下他的意見>")); ?>
<br/><br />--------------------------------------------------<br /><br />
  		<?php endfor; endif; ?>
    <?php else: ?>
		<?php if ($this->_tpl_vars['otheraru'] == 1): ?>
			沒有使用者想要怒吼<br />
		<?php endif; ?>
	<?php endif; ?><br /><br />
    <div style="float:left;"> 
	<form action="showStatics.php?Qid=<?php echo $this->_tpl_vars['Qid']; ?>
" method="post" ><input type="submit" name="button" id="button" value="上一頁"></form>
	</div>
	 <div style="float:left;"> 
	<form onclick="switchgraph();return false;" action="showStatics.php?Qid=<?php echo $this->_tpl_vars['Qid']; ?>
&qis=<?php echo $this->_tpl_vars['qis']; ?>
&show=<?php echo $this->_tpl_vars['switch']; ?>
" method="post" ><input type="submit" name="button" id="button" value="切換圖表"></form>
	</div>
	<br />
	</div>
</div>