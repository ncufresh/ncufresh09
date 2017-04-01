<?php /* Smarty version 2.6.18, created on 2009-12-03 18:07:08
         compiled from index.tpl.htm */ ?>
<div id="qa_main_container">
  <div id="qa_main_left">
    <?php if (false): ?><span class="qa_button"><a href="topic_edit.php"><img src="templates/images/iconNew.gif" alt="發表文章" /></a></span><?php endif; ?>
    <span class="qa_nav_bar">
    文章分類檢視：
    <select name="jumpMenu" class="qa_nav_bar" onChange="location.href=this.options[this.selectedIndex].value;" >
      <option value="index.php#">請選擇</option>
      <option value="index.php?select=0">全部</option>
      <?php unset($this->_sections['clsarr']);
$this->_sections['clsarr']['name'] = 'clsarr';
$this->_sections['clsarr']['loop'] = is_array($_loop=$this->_tpl_vars['qa_cls_list_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['clsarr']['show'] = true;
$this->_sections['clsarr']['max'] = $this->_sections['clsarr']['loop'];
$this->_sections['clsarr']['step'] = 1;
$this->_sections['clsarr']['start'] = $this->_sections['clsarr']['step'] > 0 ? 0 : $this->_sections['clsarr']['loop']-1;
if ($this->_sections['clsarr']['show']) {
    $this->_sections['clsarr']['total'] = $this->_sections['clsarr']['loop'];
    if ($this->_sections['clsarr']['total'] == 0)
        $this->_sections['clsarr']['show'] = false;
} else
    $this->_sections['clsarr']['total'] = 0;
if ($this->_sections['clsarr']['show']):

            for ($this->_sections['clsarr']['index'] = $this->_sections['clsarr']['start'], $this->_sections['clsarr']['iteration'] = 1;
                 $this->_sections['clsarr']['iteration'] <= $this->_sections['clsarr']['total'];
                 $this->_sections['clsarr']['index'] += $this->_sections['clsarr']['step'], $this->_sections['clsarr']['iteration']++):
$this->_sections['clsarr']['rownum'] = $this->_sections['clsarr']['iteration'];
$this->_sections['clsarr']['index_prev'] = $this->_sections['clsarr']['index'] - $this->_sections['clsarr']['step'];
$this->_sections['clsarr']['index_next'] = $this->_sections['clsarr']['index'] + $this->_sections['clsarr']['step'];
$this->_sections['clsarr']['first']      = ($this->_sections['clsarr']['iteration'] == 1);
$this->_sections['clsarr']['last']       = ($this->_sections['clsarr']['iteration'] == $this->_sections['clsarr']['total']);
?>
      <option value="index.php?select=<?php echo $this->_tpl_vars['qa_cls_list_arr'][$this->_sections['clsarr']['index']]['Cnum']; ?>
"><?php echo $this->_tpl_vars['qa_cls_list_arr'][$this->_sections['clsarr']['index']]['Ccontent']; ?>
</option>
      <?php endfor; endif; ?>
    </select>
    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <?php unset($this->_sections['pagebar']);
$this->_sections['pagebar']['name'] = 'pagebar';
$this->_sections['pagebar']['loop'] = is_array($_loop=$this->_tpl_vars['qa_page_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pagebar']['show'] = true;
$this->_sections['pagebar']['max'] = $this->_sections['pagebar']['loop'];
$this->_sections['pagebar']['step'] = 1;
$this->_sections['pagebar']['start'] = $this->_sections['pagebar']['step'] > 0 ? 0 : $this->_sections['pagebar']['loop']-1;
if ($this->_sections['pagebar']['show']) {
    $this->_sections['pagebar']['total'] = $this->_sections['pagebar']['loop'];
    if ($this->_sections['pagebar']['total'] == 0)
        $this->_sections['pagebar']['show'] = false;
} else
    $this->_sections['pagebar']['total'] = 0;
if ($this->_sections['pagebar']['show']):

            for ($this->_sections['pagebar']['index'] = $this->_sections['pagebar']['start'], $this->_sections['pagebar']['iteration'] = 1;
                 $this->_sections['pagebar']['iteration'] <= $this->_sections['pagebar']['total'];
                 $this->_sections['pagebar']['index'] += $this->_sections['pagebar']['step'], $this->_sections['pagebar']['iteration']++):
$this->_sections['pagebar']['rownum'] = $this->_sections['pagebar']['iteration'];
$this->_sections['pagebar']['index_prev'] = $this->_sections['pagebar']['index'] - $this->_sections['pagebar']['step'];
$this->_sections['pagebar']['index_next'] = $this->_sections['pagebar']['index'] + $this->_sections['pagebar']['step'];
$this->_sections['pagebar']['first']      = ($this->_sections['pagebar']['iteration'] == 1);
$this->_sections['pagebar']['last']       = ($this->_sections['pagebar']['iteration'] == $this->_sections['pagebar']['total']);
?>
      <?php echo $this->_tpl_vars['qa_page_arr'][$this->_sections['pagebar']['index']]; ?>

    <?php endfor; endif; ?>
    </span>
    <br class="clear" />&nbsp;
	<br class="clear" />
    <img src="templates/images/barDevide.gif" />
    <?php unset($this->_sections['qa']);
$this->_sections['qa']['name'] = 'qa';
$this->_sections['qa']['loop'] = is_array($_loop=$this->_tpl_vars['qa_questions_list_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['qa']['show'] = true;
$this->_sections['qa']['max'] = $this->_sections['qa']['loop'];
$this->_sections['qa']['step'] = 1;
$this->_sections['qa']['start'] = $this->_sections['qa']['step'] > 0 ? 0 : $this->_sections['qa']['loop']-1;
if ($this->_sections['qa']['show']) {
    $this->_sections['qa']['total'] = $this->_sections['qa']['loop'];
    if ($this->_sections['qa']['total'] == 0)
        $this->_sections['qa']['show'] = false;
} else
    $this->_sections['qa']['total'] = 0;
if ($this->_sections['qa']['show']):

            for ($this->_sections['qa']['index'] = $this->_sections['qa']['start'], $this->_sections['qa']['iteration'] = 1;
                 $this->_sections['qa']['iteration'] <= $this->_sections['qa']['total'];
                 $this->_sections['qa']['index'] += $this->_sections['qa']['step'], $this->_sections['qa']['iteration']++):
$this->_sections['qa']['rownum'] = $this->_sections['qa']['iteration'];
$this->_sections['qa']['index_prev'] = $this->_sections['qa']['index'] - $this->_sections['qa']['step'];
$this->_sections['qa']['index_next'] = $this->_sections['qa']['index'] + $this->_sections['qa']['step'];
$this->_sections['qa']['first']      = ($this->_sections['qa']['iteration'] == 1);
$this->_sections['qa']['last']       = ($this->_sections['qa']['iteration'] == $this->_sections['qa']['total']);
?>
    <div class="qa_topic_container">
      <div class="qa_topic_headicon"><img width="60" height="60" src="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/module/shop/items_pic/<?php echo $this->_tpl_vars['qa_questions_list_arr'][$this->_sections['qa']['index']]['pic']; ?>
.jpg" /></div>
      <div class="qa_topic_title_author">
        <a class="qa_topic_span_title" href="view_topic.php?Qno=<?php echo $this->_tpl_vars['qa_questions_list_arr'][$this->_sections['qa']['index']]['Qno']; ?>
"><div style="width:320px;"><?php echo $this->_tpl_vars['qa_questions_list_arr'][$this->_sections['qa']['index']]['Qtitle']; ?>
</div></a>
        <br />
        <span class="qa_topic_span_author"><?php echo $this->_tpl_vars['qa_questions_list_arr'][$this->_sections['qa']['index']]['uid']; ?>
</span>
      </div>
      <div class="qa_topic_date">
      <span <?php if ($this->_tpl_vars['qa_questions_list_arr'][$this->_sections['qa']['index']]['new_reply'] == TRUE): ?>style="color: #AF2323;"<?php endif; ?>>[回應: <?php echo $this->_tpl_vars['qa_questions_list_arr'][$this->_sections['qa']['index']]['Qrenum']; ?>
]</span>
      <br />&nbsp;
      <br />&nbsp;
      <br />
      發表時間：<?php echo $this->_tpl_vars['qa_questions_list_arr'][$this->_sections['qa']['index']]['Qtime']; ?>

      </div>
    </div>
    <img src="templates/images/barDevide.gif" />
    <?php endfor; endif; ?>
	<br />&nbsp;
	<div class="qa_nav_bar" style="text-align: right; padding: 0px 20px;">
    <?php unset($this->_sections['pagebar']);
$this->_sections['pagebar']['name'] = 'pagebar';
$this->_sections['pagebar']['loop'] = is_array($_loop=$this->_tpl_vars['qa_page_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['pagebar']['show'] = true;
$this->_sections['pagebar']['max'] = $this->_sections['pagebar']['loop'];
$this->_sections['pagebar']['step'] = 1;
$this->_sections['pagebar']['start'] = $this->_sections['pagebar']['step'] > 0 ? 0 : $this->_sections['pagebar']['loop']-1;
if ($this->_sections['pagebar']['show']) {
    $this->_sections['pagebar']['total'] = $this->_sections['pagebar']['loop'];
    if ($this->_sections['pagebar']['total'] == 0)
        $this->_sections['pagebar']['show'] = false;
} else
    $this->_sections['pagebar']['total'] = 0;
if ($this->_sections['pagebar']['show']):

            for ($this->_sections['pagebar']['index'] = $this->_sections['pagebar']['start'], $this->_sections['pagebar']['iteration'] = 1;
                 $this->_sections['pagebar']['iteration'] <= $this->_sections['pagebar']['total'];
                 $this->_sections['pagebar']['index'] += $this->_sections['pagebar']['step'], $this->_sections['pagebar']['iteration']++):
$this->_sections['pagebar']['rownum'] = $this->_sections['pagebar']['iteration'];
$this->_sections['pagebar']['index_prev'] = $this->_sections['pagebar']['index'] - $this->_sections['pagebar']['step'];
$this->_sections['pagebar']['index_next'] = $this->_sections['pagebar']['index'] + $this->_sections['pagebar']['step'];
$this->_sections['pagebar']['first']      = ($this->_sections['pagebar']['iteration'] == 1);
$this->_sections['pagebar']['last']       = ($this->_sections['pagebar']['iteration'] == $this->_sections['pagebar']['total']);
?>
      <?php echo $this->_tpl_vars['qa_page_arr'][$this->_sections['pagebar']['index']]; ?>

    <?php endfor; endif; ?>
	<br />&nbsp;
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