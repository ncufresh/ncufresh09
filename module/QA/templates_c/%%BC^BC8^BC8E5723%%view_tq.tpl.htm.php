<?php /* Smarty version 2.6.18, created on 2009-08-19 13:36:31
         compiled from view_tq.tpl.htm */ ?>
<div id="qa_main_container">
  <div id="qa_main_left">
    <div id="view_tq_title"><?php echo $this->_tpl_vars['currtq']['TQtitle']; ?>
</div>
    <div id="view_tq_detail">
    <?php echo $this->_tpl_vars['currtq']['TQcontent']; ?>

    </div>
  </div>
  <div id="qa_main_right">
    <div id="tq_head"></div>
    <div id="tq_center">
    <?php unset($this->_sections['tq']);
$this->_sections['tq']['name'] = 'tq';
$this->_sections['tq']['loop'] = is_array($_loop=$this->_tpl_vars['tq_list_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['tq']['show'] = true;
$this->_sections['tq']['max'] = $this->_sections['tq']['loop'];
$this->_sections['tq']['step'] = 1;
$this->_sections['tq']['start'] = $this->_sections['tq']['step'] > 0 ? 0 : $this->_sections['tq']['loop']-1;
if ($this->_sections['tq']['show']) {
    $this->_sections['tq']['total'] = $this->_sections['tq']['loop'];
    if ($this->_sections['tq']['total'] == 0)
        $this->_sections['tq']['show'] = false;
} else
    $this->_sections['tq']['total'] = 0;
if ($this->_sections['tq']['show']):

            for ($this->_sections['tq']['index'] = $this->_sections['tq']['start'], $this->_sections['tq']['iteration'] = 1;
                 $this->_sections['tq']['iteration'] <= $this->_sections['tq']['total'];
                 $this->_sections['tq']['index'] += $this->_sections['tq']['step'], $this->_sections['tq']['iteration']++):
$this->_sections['tq']['rownum'] = $this->_sections['tq']['iteration'];
$this->_sections['tq']['index_prev'] = $this->_sections['tq']['index'] - $this->_sections['tq']['step'];
$this->_sections['tq']['index_next'] = $this->_sections['tq']['index'] + $this->_sections['tq']['step'];
$this->_sections['tq']['first']      = ($this->_sections['tq']['iteration'] == 1);
$this->_sections['tq']['last']       = ($this->_sections['tq']['iteration'] == $this->_sections['tq']['total']);
?>
      <a href="view_tq.php?TQno=<?php echo $this->_tpl_vars['tq_list_arr'][$this->_sections['tq']['index']]['TQno']; ?>
">
      <div class="tq_link">
        <span class="tq_link_img"><img src="templates/images/tenQAicon<?php echo $this->_tpl_vars['tq_list_arr'][$this->_sections['tq']['index']]['TQno']; ?>
.gif" alt="QA1" /></span>
        <span class="tq_link_text"><?php echo $this->_tpl_vars['tq_list_arr'][$this->_sections['tq']['index']]['TQtitle']; ?>
</span>
      </div>
      </a>
    <?php endfor; endif; ?>
    </div>
    <div id="tq_bottom"></div>
  </div>
  <br class="clear" />&nbsp;
</div>