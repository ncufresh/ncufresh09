<?php /* Smarty version 2.6.18, created on 2009-12-03 18:08:16
         compiled from view_topic.tpl.htm */ ?>
<div id="qa_main_container">
  <div id="qa_main_left">
    <?php if (false): ?>
    <span class="qa_button"><a href="topic_edit.php"><img src="templates/images/iconNew.gif" alt="發表文章" /></a></span>
    <span class="qa_button"><a href="#reply"><img src="templates/images/iconFeeback.gif" alt="回覆文章" /></a></span>
    <?php endif; ?>
    <span class="qa_button"><a href="index.php"><img src="templates/images/iconGoback.gif" alt="回上一層" /></a></span>
    <br class="clear" />
    <img src="templates/images/barDevide.gif" />
    <div class="qa_view_topic_main">
      <div class="qa_view_topic_headicon">
      <img alt="headicon" width="120" height="120" src="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/module/shop/items_pic/<?php echo $this->_tpl_vars['qa_topic_arr']['pic']; ?>
.jpg" /><br /><br />
      <a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/msgsend.php?fno=<?php echo $this->_tpl_vars['qa_topic_arr']['uno']; ?>
"><img src="templates/images/mailicon.png" alt="寄信給他" /> 寄信給他</a><br />
      帳號：<a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/show_pfile.php?uno=<?php echo $this->_tpl_vars['qa_topic_arr']['uno']; ?>
"><?php echo $this->_tpl_vars['qa_topic_arr']['uid']; ?>
</a><br />
      暱稱：<?php echo $this->_tpl_vars['qa_topic_arr']['name']; ?>
<br />
      身份：<?php echo $this->_tpl_vars['qa_topic_arr']['department']; ?>

      </div>
      <div class="qa_view_topic_detail">
        <div class="qa_view_topic_title"><?php echo $this->_tpl_vars['qa_topic_arr']['Qtitle']; ?>
</div>
        <div class="qa_view_topic_replies">[回應數: <?php echo $this->_tpl_vars['qa_topic_arr']['Qrenum']; ?>
]</div>
        <br class="clear" />&nbsp;
        <br class="clear" />
        <?php echo $this->_tpl_vars['qa_topic_arr']['Qcontent']; ?>

        <br class="clear" />
      </div>
      <br class="clear" />
      <div class="qa_edit_button">
      發表時間：<?php echo $this->_tpl_vars['qa_topic_arr']['Qtime']; ?>

      <?php if ($this->_tpl_vars['qa_topic_arr']['uno_equal'] == TRUE): ?>
      <br />
      <a href="topic_edit.php?action=edit&Qno=<?php echo $this->_tpl_vars['qa_topic_arr']['Qno']; ?>
">[修改文章]</a>
      <a href="topic_edit.php?action=delete&Qno=<?php echo $this->_tpl_vars['qa_topic_arr']['Qno']; ?>
">[刪除文章]</a>
      <?php endif; ?>
      </div>
      <br class="clear" />
    </div>
    <img src="templates/images/barDevide.gif" />
    <br class="clear" />&nbsp;
    <div class="qa_nav_bar" style="text-align: right; padding: 0px 20px;">
    <?php unset($this->_sections['pagebar']);
$this->_sections['pagebar']['name'] = 'pagebar';
$this->_sections['pagebar']['loop'] = is_array($_loop=$this->_tpl_vars['page_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      <?php echo $this->_tpl_vars['page_arr'][$this->_sections['pagebar']['index']]; ?>

    <?php endfor; endif; ?>
    </div>
    <br class="clear" />&nbsp;
    <br class="clear" />
    <img src="templates/images/barFeeback.gif" />
    <?php unset($this->_sections['qar']);
$this->_sections['qar']['name'] = 'qar';
$this->_sections['qar']['loop'] = is_array($_loop=$this->_tpl_vars['qa_replies_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['qar']['show'] = true;
$this->_sections['qar']['max'] = $this->_sections['qar']['loop'];
$this->_sections['qar']['step'] = 1;
$this->_sections['qar']['start'] = $this->_sections['qar']['step'] > 0 ? 0 : $this->_sections['qar']['loop']-1;
if ($this->_sections['qar']['show']) {
    $this->_sections['qar']['total'] = $this->_sections['qar']['loop'];
    if ($this->_sections['qar']['total'] == 0)
        $this->_sections['qar']['show'] = false;
} else
    $this->_sections['qar']['total'] = 0;
if ($this->_sections['qar']['show']):

            for ($this->_sections['qar']['index'] = $this->_sections['qar']['start'], $this->_sections['qar']['iteration'] = 1;
                 $this->_sections['qar']['iteration'] <= $this->_sections['qar']['total'];
                 $this->_sections['qar']['index'] += $this->_sections['qar']['step'], $this->_sections['qar']['iteration']++):
$this->_sections['qar']['rownum'] = $this->_sections['qar']['iteration'];
$this->_sections['qar']['index_prev'] = $this->_sections['qar']['index'] - $this->_sections['qar']['step'];
$this->_sections['qar']['index_next'] = $this->_sections['qar']['index'] + $this->_sections['qar']['step'];
$this->_sections['qar']['first']      = ($this->_sections['qar']['iteration'] == 1);
$this->_sections['qar']['last']       = ($this->_sections['qar']['iteration'] == $this->_sections['qar']['total']);
?>
    <div class="qa_view_topic_main">
      <div class="qa_view_topic_headicon">
      <img alt="headicon" width="120" height="120" src="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/module/shop/items_pic/<?php echo $this->_tpl_vars['qa_replies_arr'][$this->_sections['qar']['index']]['pic']; ?>
.jpg" /><br /><br />
      <a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/msgsend.php?fno=<?php echo $this->_tpl_vars['qa_replies_arr'][$this->_sections['qar']['index']]['uno']; ?>
"><img src="templates/images/mailicon.png" alt="寄信給他" /> 寄信給他</a><br />
      帳號：<a href="<?php echo $this->_tpl_vars['currconfig']->url; ?>
/show_pfile.php?uno=<?php echo $this->_tpl_vars['qa_replies_arr'][$this->_sections['qar']['index']]['uno']; ?>
"><?php echo $this->_tpl_vars['qa_replies_arr'][$this->_sections['qar']['index']]['uid']; ?>
</a><br />
      暱稱：<?php echo $this->_tpl_vars['qa_replies_arr'][$this->_sections['qar']['index']]['name']; ?>
<br />
      身份：<?php echo $this->_tpl_vars['qa_replies_arr'][$this->_sections['qar']['index']]['department']; ?>

      </div>
      <div class="qa_view_topic_detail">
        <div class="qa_view_topic_title"></div>
        <div class="qa_view_topic_replies">[ <?php echo $this->_tpl_vars['qa_replies_arr'][$this->_sections['qar']['index']]['Rf']; ?>
F ]</div>
        <br class="clear" />
        <?php echo $this->_tpl_vars['qa_replies_arr'][$this->_sections['qar']['index']]['Rcontent']; ?>

        <br class="clear" />
      </div>
      <br class="clear" />
      <div class="qa_edit_button">
      發表時間：<?php echo $this->_tpl_vars['qa_replies_arr'][$this->_sections['qar']['index']]['Rtime']; ?>

      </div>
      <br class="clear" />
    </div>
    <img src="templates/images/barFeeback.gif" />
    <?php endfor; endif; ?>
    <br class="clear" />&nbsp;
    <div class="qa_nav_bar" style="text-align: right; padding: 0px 20px;">
    <?php unset($this->_sections['pagebar']);
$this->_sections['pagebar']['name'] = 'pagebar';
$this->_sections['pagebar']['loop'] = is_array($_loop=$this->_tpl_vars['page_arr']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
      <?php echo $this->_tpl_vars['page_arr'][$this->_sections['pagebar']['index']]; ?>

    <?php endfor; endif; ?>
    </div>
    <br class="clear" />&nbsp;
    <?php if (false): ?>
	<a name="reply" id="reply"></a>
    <form action="reply_edit.php?action=new_newpost" method="post">
      <span class="qa_nav_bar">回覆文章</span><br />
      <textarea style="width:620px; height: 120px;" name="Rcontent"></textarea>
      <input type="hidden" name="Rno" value="<?php echo $this->_tpl_vars['qa_topic_arr']['Qno']; ?>
" />
      <input type="hidden" name="isReply" value="1" />
      <input name="submit" type="submit" value="送出回覆" />
      <input name="reset" type="reset" value="重新填寫" />
    </form>
    <?php endif; ?>
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
</div>