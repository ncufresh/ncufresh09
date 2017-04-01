<?php /* Smarty version 2.6.18, created on 2009-07-29 10:54:20
         compiled from index.htm */ ?>
<div class="forum_field">
<div class="forum_content">

<div id="f_i_content" class="div">
<div id="c_toptopic" class="div"><div class="f_c_title">熱門文章</div><?php echo $this->_tpl_vars['toptopic']; ?>
</div>
<div id="c_hotboard" class="div"><div class="f_c_title"><img src="templates/images/f_i_hotboard.gif" /></div><?php echo $this->_tpl_vars['hotboard']; ?>
</div>
<div id="c_newtopic" class="div"><div class="f_c_title">最新文章</div><?php echo $this->_tpl_vars['newtopic']; ?>
</div>
<div id="c_qanda" class="div"><a href="faq.php"><img src="templates/images/f_i_qanda.gif" /></a></div>
<div id="c_dep" class="div"><a href="showGroup.php?gno=8"><img src="templates/images/f_i_dep.gif" /></a></div>
<div id="c_club" class="div"><a href="showGroup.php?gno=9"><img src="templates/images/f_i_club.gif" /></a></div>
<div id="c_board_title" class="div"><img src="templates/images/f_i_kerker.gif" /></div>
<?php $_from = $this->_tpl_vars['down']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['down'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['down']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['board']):
        $this->_foreach['down']['iteration']++;
?>
<div id="c_board<?php echo $this->_foreach['down']['iteration']; ?>
" class="div c_board">
<div class="f_c_title2"><a href="viewboard.php?no=<?php echo $this->_tpl_vars['board']['board_no']; ?>
"><?php echo $this->_tpl_vars['board']['name']; ?>
 <span style="font-size:10pt">&gt;&gt;進入</span></a></div><?php $_from = $this->_tpl_vars['board']['topic']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['topic']):
?><div class="f_c_topic"><a href="viewtopic.php?no=<?php echo $this->_tpl_vars['topic']['topic_no']; ?>
"><?php echo $this->_tpl_vars['topic']['title']; ?>
</a></div><?php endforeach; endif; unset($_from); ?>
</div>
<?php endforeach; endif; unset($_from); ?>
</div>

</div>
</div>