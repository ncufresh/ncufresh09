<?php /* Smarty version 2.6.18, created on 2009-08-23 05:45:21
         compiled from index.tpl.php */ ?>
<div id="campus_all">
	<!--<div id="campus_main_menu">
        main_menu
    </div>-->
	<div id="campus_center_block" <?php echo $this->_tpl_vars['SpecialCase']; ?>
  >
		<div id="cp_introduce" class="<?php echo $this->_tpl_vars['Switcher']['CSM']; ?>
" >
			<div id="cp_intro_top">
				<span id="cp_editsele"></span>
				<span id="cp_submenu"<?php echo $this->_tpl_vars['SpecialCase2']; ?>
><?php echo $this->_tpl_vars['campus_submenu']; ?>
</span>
				<span id="CP_Icon"></span>
			</div>
			<div id="cp_intro_content_outer">
				<div id="cp_intro_content">
					<?php echo $this->_tpl_vars['campus_intro']; ?>

				</div>
			</div>
			<div id="cp_intro_bottom"></div>
		</div>
		<NoScript><span id="pleaseUseJS">請開啟JavaScript功能以獲得完整的功能</span></NoScript>
		<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['buildingContent']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
			<a href="#" onclick="return false;"><div <?php echo $this->_tpl_vars['buildingContent'][$this->_sections['loop']['index']]; ?>
"></div></a>
		<?php endfor; endif; ?>
		
	</div>
</div>

<div id="spannnn">
<!--<a href="templates/images/depart.jpg" title="HAHA" rel="lightbox"><img height="600" alt="" src="templates/images/depart.jpg"/></a>-->
</div>


