<?php /* Smarty version 2.6.18, created on 2009-08-07 09:32:41
         compiled from topic.tpl.htm */ ?>
<div id="must_container">
  <div id="must_top" style="background-image:url(templates/images/E01_<?php echo $this->_tpl_vars['curr_cat']; ?>
.gif)"></div>
  <div id="must_center">
    <div id="must_center_l">
    <?php unset($this->_sections['l']);
$this->_sections['l']['name'] = 'l';
$this->_sections['l']['loop'] = is_array($_loop=$this->_tpl_vars['menu_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['l']['show'] = true;
$this->_sections['l']['max'] = $this->_sections['l']['loop'];
$this->_sections['l']['step'] = 1;
$this->_sections['l']['start'] = $this->_sections['l']['step'] > 0 ? 0 : $this->_sections['l']['loop']-1;
if ($this->_sections['l']['show']) {
    $this->_sections['l']['total'] = $this->_sections['l']['loop'];
    if ($this->_sections['l']['total'] == 0)
        $this->_sections['l']['show'] = false;
} else
    $this->_sections['l']['total'] = 0;
if ($this->_sections['l']['show']):

            for ($this->_sections['l']['index'] = $this->_sections['l']['start'], $this->_sections['l']['iteration'] = 1;
                 $this->_sections['l']['iteration'] <= $this->_sections['l']['total'];
                 $this->_sections['l']['index'] += $this->_sections['l']['step'], $this->_sections['l']['iteration']++):
$this->_sections['l']['rownum'] = $this->_sections['l']['iteration'];
$this->_sections['l']['index_prev'] = $this->_sections['l']['index'] - $this->_sections['l']['step'];
$this->_sections['l']['index_next'] = $this->_sections['l']['index'] + $this->_sections['l']['step'];
$this->_sections['l']['first']      = ($this->_sections['l']['iteration'] == 1);
$this->_sections['l']['last']       = ($this->_sections['l']['iteration'] == $this->_sections['l']['total']);
?>
    <a href="<?php echo $this->_tpl_vars['menu_arr'][$this->_sections['l']['index']]['hyperlink']; ?>
"><?php echo $this->_tpl_vars['menu_arr'][$this->_sections['l']['index']]['title']; ?>
</a><br />
    <?php endfor; endif; ?>
    </div>
    <div id="must_center_r_contents">
    <div class="must_title"><?php echo $this->_tpl_vars['cat_id_request_arr']['title']; ?>
</div><br />
    <div class="must_cont"><?php echo $this->_tpl_vars['topic_arr']['main']; ?>
</div>
    </div>
  </div>
  <div id="must_bottom"></div>
</div>
<br class="clear" />&nbsp;