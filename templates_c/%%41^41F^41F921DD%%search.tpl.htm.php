<?php /* Smarty version 2.6.18, created on 2010-07-02 10:50:32
         compiled from search.tpl.htm */ ?>
<div id="search_main">
  <div id="search_main_logo"></div>
  <div class="search_main_bar"></div>
  <?php unset($this->_sections['sch']);
$this->_sections['sch']['name'] = 'sch';
$this->_sections['sch']['loop'] = is_array($_loop=$this->_tpl_vars['search_result']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['sch']['show'] = true;
$this->_sections['sch']['max'] = $this->_sections['sch']['loop'];
$this->_sections['sch']['step'] = 1;
$this->_sections['sch']['start'] = $this->_sections['sch']['step'] > 0 ? 0 : $this->_sections['sch']['loop']-1;
if ($this->_sections['sch']['show']) {
    $this->_sections['sch']['total'] = $this->_sections['sch']['loop'];
    if ($this->_sections['sch']['total'] == 0)
        $this->_sections['sch']['show'] = false;
} else
    $this->_sections['sch']['total'] = 0;
if ($this->_sections['sch']['show']):

            for ($this->_sections['sch']['index'] = $this->_sections['sch']['start'], $this->_sections['sch']['iteration'] = 1;
                 $this->_sections['sch']['iteration'] <= $this->_sections['sch']['total'];
                 $this->_sections['sch']['index'] += $this->_sections['sch']['step'], $this->_sections['sch']['iteration']++):
$this->_sections['sch']['rownum'] = $this->_sections['sch']['iteration'];
$this->_sections['sch']['index_prev'] = $this->_sections['sch']['index'] - $this->_sections['sch']['step'];
$this->_sections['sch']['index_next'] = $this->_sections['sch']['index'] + $this->_sections['sch']['step'];
$this->_sections['sch']['first']      = ($this->_sections['sch']['iteration'] == 1);
$this->_sections['sch']['last']       = ($this->_sections['sch']['iteration'] == $this->_sections['sch']['total']);
?>
  <div class="search_result_block">
  <?php echo $this->_tpl_vars['search_result'][$this->_sections['sch']['index']]['title_href']; ?>

  <br class="clear">
  <br class="clear">
  <?php echo $this->_tpl_vars['search_result'][$this->_sections['sch']['index']]['content']; ?>

  </div>
  <br class="clear">
  <div class="search_main_bar"></div>
  <?php endfor; endif; ?>
</div>