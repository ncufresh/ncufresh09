<?php /* Smarty version 2.6.18, created on 2009-08-06 03:15:31
         compiled from tenQuest.tpl.php */ ?>
<div id="QA_Ten_ALL">
	<div id="QA_Ten_banner"></div>
	<div id="QA_Ten_container">
		<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['QA_Ten_List']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<a href="<?php echo $this->_tpl_vars['QA_Ten_List'][$this->_sections['loop']['index']]['Link']; ?>
">
			<div class="QA_Ten_List">
				<span class="QA_Ten_Pic">
					<img src="templates/images/<?php echo $this->_tpl_vars['QA_Ten_List'][$this->_sections['loop']['index']]['Pic']; ?>
">
				</span>
				<span class="QA_Ten_Text">
					<?php echo $this->_tpl_vars['QA_Ten_List'][$this->_sections['loop']['index']]['Text']; ?>

				</span>
			</div>
		</a>
		<?php endfor; endif; ?>
	</div>
	<div id="QA_Ten_footer"></div>
</div>