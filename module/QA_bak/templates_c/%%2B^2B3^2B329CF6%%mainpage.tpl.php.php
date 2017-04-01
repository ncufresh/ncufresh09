<?php /* Smarty version 2.6.18, created on 2009-08-12 14:08:15
         compiled from mainpage.tpl.php */ ?>
﻿<div id="QA_MAIN_OUTER">
	<div id="QA_navigate_bar">
		<a href="index.php?Qnew=1"><span id="QA_IhaveQuestion"></span></a>
			<span class="QA_cataselect">
			文章分類檢視:
				<select name="select" onChange="location.href=this.options[this.selectedIndex].value;">
					<option value="#">分類</option>
				<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['QA_cls']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
					<option value="index.php?select=<?php echo $this->_tpl_vars['QA_cls'][$this->_sections['loop']['index']]['num']; ?>
"<?php if (( $_GET['select'] == $this->_tpl_vars['QA_cls'][$this->_sections['loop']['index']]['num'] )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['QA_cls'][$this->_sections['loop']['index']]['content']; ?>
</option>
				<?php endfor; endif; ?>
				</select>
			</span>
		<span id="QA_pageNavigate">
			<?php if ($this->_tpl_vars['uppages'] != -1): ?>
			<a href="index.php?page=<?php echo $this->_tpl_vars['uppages']; ?>
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
			<a href="index.php?page=<?php echo $this->_tpl_vars['pages'][$this->_sections['i']['index']]; ?>
">
                <span class="QA_page_select page<?php if ($this->_tpl_vars['currpage'] == $this->_sections['i']['iteration']): ?> QA_currpage<?php endif; ?>">
                    <?php echo $this->_tpl_vars['pages'][$this->_sections['i']['index']]; ?>

                </span>
            </a>
			<?php endfor; endif; ?>
			<?php if ($this->_tpl_vars['downpages'] != -1): ?>
			<a href="index.php?page=<?php echo $this->_tpl_vars['downpages']; ?>
"><span class="QA_page_select">></span></a>
			<?php endif; ?>
            <span class="QA_page_select2"><form action="index.php" method="get"><input name="page" size="2" type="text" value="頁數"/></form></span>
		</span>
	</div>
	<div class="QA_divideBAR"></div>
	<?php unset($this->_sections['loop']);
$this->_sections['loop']['name'] = 'loop';
$this->_sections['loop']['loop'] = is_array($_loop=$this->_tpl_vars['QA_Articals']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<img class="QA_img" src="../shop/items_pic/<?php echo $this->_tpl_vars['QA_Articals'][$this->_sections['loop']['index']]['pic']; ?>
.jpg">
	</div>
	<div class="QA_rightcontent">	
		<a href="index.php?QAno=<?php echo $this->_tpl_vars['QA_Articals'][$this->_sections['loop']['index']]['num']; ?>
">
		<span class="QA_title_a">[<?php echo $this->_tpl_vars['QA_Articals'][$this->_sections['loop']['index']]['cls']; ?>
] <?php echo $this->_tpl_vars['QA_Articals'][$this->_sections['loop']['index']]['title']; ?>

		<?php if ($this->_tpl_vars['QA_Articals'][$this->_sections['loop']['index']]['point'] == 1): ?> 
			...
		<?php endif; ?>
		</span>
		</a>
		<?php if ($this->_tpl_vars['QA_Articals'][$this->_sections['loop']['index']]['new'] == 1): ?>
		<span class="QA_reNew">[回應:<?php echo $this->_tpl_vars['QA_Articals'][$this->_sections['loop']['index']]['reply']; ?>
]</span>
		<?php else: ?>
		<span class="QA_re">[回應:<?php echo $this->_tpl_vars['QA_Articals'][$this->_sections['loop']['index']]['reply']; ?>
]</span>
		<?php endif; ?>
		<span class="QA_author">作者:<?php echo $this->_tpl_vars['QA_Articals'][$this->_sections['loop']['index']]['author']; ?>
</span>
		<span class="QA_time">發表時間:<?php echo $this->_tpl_vars['QA_Articals'][$this->_sections['loop']['index']]['time']; ?>
</span>	
	</div>
	<div style="clear:both"></div>
	<div class="QA_divideBAR"></div>
	<?php endfor; endif; ?>
	<div id="QA_navigate_bar_page">
		<span id="QA_pageNavigateEnd">
			<?php if ($this->_tpl_vars['uppages'] != -1): ?>
			<a href="index.php?page=<?php echo $this->_tpl_vars['uppages']; ?>
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
			<a href="index.php?page=<?php echo $this->_tpl_vars['pages'][$this->_sections['i']['index']]; ?>
">
                <span class="QA_page_select page<?php if ($this->_tpl_vars['currpage'] == $this->_sections['i']['iteration']): ?> QA_currpage<?php endif; ?>">
                    <?php echo $this->_tpl_vars['pages'][$this->_sections['i']['index']]; ?>

                </span>
            </a>
			<?php endfor; endif; ?>
			<?php if ($this->_tpl_vars['downpages'] != -1): ?>
			<a href="index.php?page=<?php echo $this->_tpl_vars['downpages']; ?>
"><span class="QA_page_select">></span></a>
			<?php endif; ?>
            <span class="QA_page_select2"><form action="index.php" method="get">
                <input id="QA_page_inputor" name="page" size="2" type="text" value="頁數"/> </form></span>
		</span>
	</div>
</div>