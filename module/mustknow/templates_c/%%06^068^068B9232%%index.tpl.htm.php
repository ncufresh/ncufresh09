<?php /* Smarty version 2.6.18, created on 2009-08-07 09:33:05
         compiled from index.tpl.htm */ ?>
<div id="must_container">
  <div id="must_top"></div>
  <div id="must_center">
    <div id="must_center_l">
    <?php unset($this->_sections['l3']);
$this->_sections['l3']['name'] = 'l3';
$this->_sections['l3']['loop'] = is_array($_loop=$this->_tpl_vars['menu_common_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l3']['show'] = true;
$this->_sections['l3']['max'] = $this->_sections['l3']['loop'];
$this->_sections['l3']['step'] = 1;
$this->_sections['l3']['start'] = $this->_sections['l3']['step'] > 0 ? 0 : $this->_sections['l3']['loop']-1;
if ($this->_sections['l3']['show']) {
    $this->_sections['l3']['total'] = $this->_sections['l3']['loop'];
    if ($this->_sections['l3']['total'] == 0)
        $this->_sections['l3']['show'] = false;
} else
    $this->_sections['l3']['total'] = 0;
if ($this->_sections['l3']['show']):

            for ($this->_sections['l3']['index'] = $this->_sections['l3']['start'], $this->_sections['l3']['iteration'] = 1;
                 $this->_sections['l3']['iteration'] <= $this->_sections['l3']['total'];
                 $this->_sections['l3']['index'] += $this->_sections['l3']['step'], $this->_sections['l3']['iteration']++):
$this->_sections['l3']['rownum'] = $this->_sections['l3']['iteration'];
$this->_sections['l3']['index_prev'] = $this->_sections['l3']['index'] - $this->_sections['l3']['step'];
$this->_sections['l3']['index_next'] = $this->_sections['l3']['index'] + $this->_sections['l3']['step'];
$this->_sections['l3']['first']      = ($this->_sections['l3']['iteration'] == 1);
$this->_sections['l3']['last']       = ($this->_sections['l3']['iteration'] == $this->_sections['l3']['total']);
?>
    <a href="<?php echo $this->_tpl_vars['menu_common_arr'][$this->_sections['l3']['index']]['hyperlink']; ?>
"><?php echo $this->_tpl_vars['menu_common_arr'][$this->_sections['l3']['index']]['title']; ?>
</a><br />
    <?php endfor; endif; ?>
    </div>
    <div class="must_center_r">
    一般大一新生 <img src="templates/images/EstarGreen.gif" alt="大一必讀" /><br />
    <?php unset($this->_sections['l1']);
$this->_sections['l1']['name'] = 'l1';
$this->_sections['l1']['loop'] = is_array($_loop=$this->_tpl_vars['menu_fresh_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l1']['show'] = true;
$this->_sections['l1']['max'] = $this->_sections['l1']['loop'];
$this->_sections['l1']['step'] = 1;
$this->_sections['l1']['start'] = $this->_sections['l1']['step'] > 0 ? 0 : $this->_sections['l1']['loop']-1;
if ($this->_sections['l1']['show']) {
    $this->_sections['l1']['total'] = $this->_sections['l1']['loop'];
    if ($this->_sections['l1']['total'] == 0)
        $this->_sections['l1']['show'] = false;
} else
    $this->_sections['l1']['total'] = 0;
if ($this->_sections['l1']['show']):

            for ($this->_sections['l1']['index'] = $this->_sections['l1']['start'], $this->_sections['l1']['iteration'] = 1;
                 $this->_sections['l1']['iteration'] <= $this->_sections['l1']['total'];
                 $this->_sections['l1']['index'] += $this->_sections['l1']['step'], $this->_sections['l1']['iteration']++):
$this->_sections['l1']['rownum'] = $this->_sections['l1']['iteration'];
$this->_sections['l1']['index_prev'] = $this->_sections['l1']['index'] - $this->_sections['l1']['step'];
$this->_sections['l1']['index_next'] = $this->_sections['l1']['index'] + $this->_sections['l1']['step'];
$this->_sections['l1']['first']      = ($this->_sections['l1']['iteration'] == 1);
$this->_sections['l1']['last']       = ($this->_sections['l1']['iteration'] == $this->_sections['l1']['total']);
?>
    <a href="<?php echo $this->_tpl_vars['menu_fresh_arr'][$this->_sections['l1']['index']]['hyperlink']; ?>
"><?php echo $this->_tpl_vars['menu_fresh_arr'][$this->_sections['l1']['index']]['title']; ?>
</a><br />
    <?php endfor; endif; ?>
    </div>
    <div class="must_center_r">
    大一休學後復學生 <img src="templates/images/EstarGreen.gif" alt="大一必讀" /><br />
    <?php unset($this->_sections['l2']);
$this->_sections['l2']['name'] = 'l2';
$this->_sections['l2']['loop'] = is_array($_loop=$this->_tpl_vars['menu_resume_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l2']['show'] = true;
$this->_sections['l2']['max'] = $this->_sections['l2']['loop'];
$this->_sections['l2']['step'] = 1;
$this->_sections['l2']['start'] = $this->_sections['l2']['step'] > 0 ? 0 : $this->_sections['l2']['loop']-1;
if ($this->_sections['l2']['show']) {
    $this->_sections['l2']['total'] = $this->_sections['l2']['loop'];
    if ($this->_sections['l2']['total'] == 0)
        $this->_sections['l2']['show'] = false;
} else
    $this->_sections['l2']['total'] = 0;
if ($this->_sections['l2']['show']):

            for ($this->_sections['l2']['index'] = $this->_sections['l2']['start'], $this->_sections['l2']['iteration'] = 1;
                 $this->_sections['l2']['iteration'] <= $this->_sections['l2']['total'];
                 $this->_sections['l2']['index'] += $this->_sections['l2']['step'], $this->_sections['l2']['iteration']++):
$this->_sections['l2']['rownum'] = $this->_sections['l2']['iteration'];
$this->_sections['l2']['index_prev'] = $this->_sections['l2']['index'] - $this->_sections['l2']['step'];
$this->_sections['l2']['index_next'] = $this->_sections['l2']['index'] + $this->_sections['l2']['step'];
$this->_sections['l2']['first']      = ($this->_sections['l2']['iteration'] == 1);
$this->_sections['l2']['last']       = ($this->_sections['l2']['iteration'] == $this->_sections['l2']['total']);
?>
    <a href="<?php echo $this->_tpl_vars['menu_resume_arr'][$this->_sections['l2']['index']]['hyperlink']; ?>
"><?php echo $this->_tpl_vars['menu_resume_arr'][$this->_sections['l2']['index']]['title']; ?>
</a><br />
    <?php endfor; endif; ?>
    </div>
  </div>
  <div id="must_bottom"></div>
</div>
<br class="clear" />&nbsp;