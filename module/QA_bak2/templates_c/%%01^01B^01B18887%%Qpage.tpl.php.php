<?php /* Smarty version 2.6.18, created on 2009-08-10 09:15:53
         compiled from Qpage.tpl.php */ ?>
﻿<div id="QA_MAIN_OUTER">
	<div id="QA_navigate_bar">
		<a href="index.php?Qnew=1"><span id="QA_IhaveQuestion"></span></a>
		<?php if (! $this->_tpl_vars['curruser']->isguest()): ?>
	        <a href="#re"><span id="QA_IReQuestion"></span></a>
		<?php endif; ?>
                <a href="index.php">
                    <img src="templates/images/iconGoback.gif" alt="回上一頁"/></a>
	</div>
	<div class="QA_divideBAR"></div>
		<div class="QA_leftcontent">
		<img class="QA_img" src="../shop/items_pic/<?php echo $this->_tpl_vars['QA_Articals']['pic']; ?>
.jpg"><br />
		<span class="RA_author"><a href="../../msgsend.php?fno=<?php echo $this->_tpl_vars['QA_Articals']['uno']; ?>
"><img src="./templates/images/mailicon.png"></a>寄信給他</span><br />
		<span class="RA_author">帳號:<?php echo $this->_tpl_vars['QA_Articals']['author']; ?>
</span> <br />
		<span class="RA_name">暱稱:<?php echo $this->_tpl_vars['QA_Articals']['name']; ?>
</span> <br />
		<span class="RA_dep">身分:<?php echo $this->_tpl_vars['QA_Articals']['dep']; ?>
</span> <br />
	</div>
	<div class="QA_rightcontent">
		<span class="QA_title">[<?php echo $this->_tpl_vars['QA_Articals']['cls']; ?>
]&nbsp;<?php echo $this->_tpl_vars['QA_Articals']['title']; ?>
</span>
		<span class="QA_re">[回應:<?php echo $this->_tpl_vars['QA_Articals']['reply']; ?>
]</span><br class="clear" />
		<span class="QA_content"><?php echo $this->_tpl_vars['QA_Articals']['content']; ?>
</span>
		<?php if ($this->_tpl_vars['admin']): ?>
            <a href="delQuest.php?Qno=<?php echo $this->_tpl_vars['QA_Articals']['num']; ?>
"><span class="QA_change">[刪除文章]</span></a>
	    	<a href="index.php?Qchg=1&Qno=<?php echo $this->_tpl_vars['QA_Articals']['num']; ?>
"><span class="QA_change">[修改文章]</span></a>
		<?php endif; ?>
		<span class="QA_time">發表時間:<?php echo $this->_tpl_vars['QA_Articals']['time']; ?>
</span>	
	</div>
	<div style="clear:both"></div>
	<div class="QA_divideBAR"></div>
	<div id="QA_navigate_bar_page">
		<span id="QA_pageNavigateEnd">
			<?php if ($this->_tpl_vars['uppages'] != -1): ?>
			<a href="index.php?QAno=<?php echo $this->_tpl_vars['QA_Articals']['num']; ?>
&page=<?php echo $this->_tpl_vars['uppages']; ?>
"><span class="QA_page_select"><</span></a>
			<?php endif; ?>
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['pages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
			<a href="index.php?QAno=<?php echo $this->_tpl_vars['QA_Articals']['num']; ?>
&page=<?php echo $this->_tpl_vars['pages'][$this->_sections['i']['index']]; ?>
">
                <span class="QA_page_select page<?php if ($this->_tpl_vars['currpage'] == $this->_sections['i']['iteration']): ?> QA_currpage<?php endif; ?>">
                    <?php echo $this->_tpl_vars['pages'][$this->_sections['i']['index']]; ?>

                </span></a>
			<?php endfor; endif; ?>
			<?php if ($this->_tpl_vars['downpages'] != -1): ?>
			<a href="index.php?QAno=<?php echo $this->_tpl_vars['QA_Articals']['num']; ?>
&page=<?php echo $this->_tpl_vars['downpages']; ?>
"><span class="QA_page_select">></span></a>
			<?php endif; ?>
            <span class="QA_page_select2">
                <form action="index.php" method="get">
                    <input name="page" type="text" size="2" value="頁數"/>
                    <input name="QAno" type="hidden" value="<?php echo $this->_tpl_vars['QA_Articals']['num']; ?>
"/>
                </form>
            </span>
		</span>
	</div>
	<div class="QA_divideBARre"></div>
	<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['RA_Articals']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
	<div class="QA_leftcontent">
		<img class="QA_img" src="../shop/items_pic/<?php echo $this->_tpl_vars['RA_Articals'][$this->_sections['loop']['index']]['pic']; ?>
.jpg">
		<span class="RA_author">帳號:<?php echo $this->_tpl_vars['RA_Articals'][$this->_sections['loop']['index']]['author']; ?>
</span> <br />
		<span class="RA_name">暱稱:<?php echo $this->_tpl_vars['RA_Articals'][$this->_sections['loop']['index']]['name']; ?>
</span> <br />
		<span class="RA_dep">身分:<?php echo $this->_tpl_vars['RA_Articals'][$this->_sections['loop']['index']]['dep']; ?>
</span> <br />
	</div>
	<div class="QA_rightcontent">
		<span class="RA_floor"><?php echo $this->_tpl_vars['RA_Articals'][$this->_sections['loop']['index']]['floor']; ?>
F</span>
		<span class="RA_content"><?php echo $this->_tpl_vars['RA_Articals'][$this->_sections['loop']['index']]['content']; ?>
</span>
		<span class="QA_time">發表時間:<?php echo $this->_tpl_vars['RA_Articals'][$this->_sections['loop']['index']]['time']; ?>
</span>	
	</div>
	<div style="clear:both"></div>
	<div class="QA_divideBARre"></div>
	<?php endfor; endif; ?>
	<div id="QA_navigate_bar_page">
		<span id="QA_pageNavigateEnd">
			<?php if ($this->_tpl_vars['uppages'] != -1): ?>
			<a href="index.php?QAno=<?php echo $this->_tpl_vars['QA_Articals']['num']; ?>
&page=<?php echo $this->_tpl_vars['uppages']; ?>
"><span class="QA_page_select"><</span></a>
			<?php endif; ?>
			<?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['pages']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
			<a href="index.php?QAno=<?php echo $this->_tpl_vars['QA_Articals']['num']; ?>
&page=<?php echo $this->_tpl_vars['pages'][$this->_sections['i']['index']]; ?>
">
                <span class="QA_page_select page<?php if ($this->_tpl_vars['currpage'] == $this->_sections['i']['iteration']): ?> QA_currpage<?php endif; ?>">
                    <?php echo $this->_tpl_vars['pages'][$this->_sections['i']['index']]; ?>

                </span>
            </a>
			<?php endfor; endif; ?>
			<?php if ($this->_tpl_vars['downpages'] != -1): ?>
			<a href="index.php?QAno=<?php echo $this->_tpl_vars['QA_Articals']['num']; ?>
&page=<?php echo $this->_tpl_vars['downpages']; ?>
"><span class="QA_page_select">></span></a>
			<?php endif; ?>
            <span class="QA_page_select2">
                <form action="index.php" method="get">
                    <input name="page" type="text" size="2" value="頁數"/>
                    <input name="QAno" type="hidden" value="<?php echo $this->_tpl_vars['QA_Articals']['num']; ?>
"/> 
                </form>
            </span>
		</span>
	</div>
	<?php if (! $this->_tpl_vars['curruser']->isguest()): ?>
	<a name="re"></a>
	<form action="./newRe.php" method="post" >
	<input name="Qno" type="hidden" value="<?php echo $this->_tpl_vars['QA_Articals']['num']; ?>
" />
	<input name="Rfloor" type="hidden" value="<?php echo $this->_tpl_vars['QA_Articals']['reply']; ?>
" />
		<div style="float:left">回覆文章:</div><br />
			<textarea id="QA_ReplyArea" rows="10" cols="70" name="descript"></textarea><br /><br />
		<div class="QA_submit"><input type="submit" value="送出" /><input name="" type="reset" /></div>
	</form>
	<?php endif; ?>
</div>