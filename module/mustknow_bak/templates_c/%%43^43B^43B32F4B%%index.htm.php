<?php /* Smarty version 2.6.18, created on 2009-07-27 15:09:02
         compiled from index.htm */ ?>
<div id="module_container">

	<div id="nav">
		 <?php if ($this->_tpl_vars['currmodule']->isadmin($this->_tpl_vars['curruser'])): ?>
		<a href="edit_nav.php" class="editLink"><span>[修改目錄]</span></a>
		<?php endif; ?>
		<?php unset($this->_sections['cate']);
$this->_sections['cate']['loop'] = is_array($_loop=$this->_tpl_vars['cate']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cate']['name'] = 'cate';
$this->_sections['cate']['show'] = true;
$this->_sections['cate']['max'] = $this->_sections['cate']['loop'];
$this->_sections['cate']['step'] = 1;
$this->_sections['cate']['start'] = $this->_sections['cate']['step'] > 0 ? 0 : $this->_sections['cate']['loop']-1;
if ($this->_sections['cate']['show']) {
    $this->_sections['cate']['total'] = $this->_sections['cate']['loop'];
    if ($this->_sections['cate']['total'] == 0)
        $this->_sections['cate']['show'] = false;
} else
    $this->_sections['cate']['total'] = 0;
if ($this->_sections['cate']['show']):

            for ($this->_sections['cate']['index'] = $this->_sections['cate']['start'], $this->_sections['cate']['iteration'] = 1;
                 $this->_sections['cate']['iteration'] <= $this->_sections['cate']['total'];
                 $this->_sections['cate']['index'] += $this->_sections['cate']['step'], $this->_sections['cate']['iteration']++):
$this->_sections['cate']['rownum'] = $this->_sections['cate']['iteration'];
$this->_sections['cate']['index_prev'] = $this->_sections['cate']['index'] - $this->_sections['cate']['step'];
$this->_sections['cate']['index_next'] = $this->_sections['cate']['index'] + $this->_sections['cate']['step'];
$this->_sections['cate']['first']      = ($this->_sections['cate']['iteration'] == 1);
$this->_sections['cate']['last']       = ($this->_sections['cate']['iteration'] == $this->_sections['cate']['total']);
?>
			<?php if ($this->_tpl_vars['cate'][$this->_sections['cate']['index']]['level'] == 1): ?>
				<?php if ($this->_tpl_vars['cate'][$this->_sections['cate']['index']]['hyperlink'] == NULL): ?>
					<span class="likea header"> <?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['title']; ?>
 </span>
				<?php else: ?>
					<a href="<?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['hyperlink']; ?>
" class="navlink0 header <?php if ($this->_tpl_vars['cate'][$this->_sections['cate']['index']]['csn'] == $this->_tpl_vars['main']['csn']): ?> selected <?php endif; ?>"><span> <?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['title']; ?>
 </span></a>	
				<?php endif; ?>
			<?php elseif ($this->_tpl_vars['cate'][$this->_sections['cate']['index']]['level'] == 2): ?>
				<?php if ($this->_tpl_vars['cate'][$this->_sections['cate']['index']]['hyperlink'] == NULL): ?>
					<p class="navlink1"><span> <?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['title']; ?>
</span></p>
				<?php else: ?>
					<a href="<?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['hyperlink']; ?>
" class="navlink1 <?php if ($this->_tpl_vars['cate'][$this->_sections['cate']['index']]['csn'] == $this->_tpl_vars['main']['csn']): ?> selected <?php endif; ?>"><span> <?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['title']; ?>
 </span></a>	
				<?php endif; ?>
			<?php else: ?>
				<a href="<?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['hyperlink']; ?>
" class="navlink2 <?php if ($this->_tpl_vars['cate'][$this->_sections['cate']['index']]['csn'] == $this->_tpl_vars['main']['csn']): ?> selected <?php endif; ?>"><span> <?php echo $this->_tpl_vars['cate'][$this->_sections['cate']['index']]['title']; ?>
 </span></a>
			<?php endif; ?>
		<?php endfor; endif; ?>		
	</div>
	
	<div id="main">
		<?php if ($this->_tpl_vars['currmodule']->isadmin($this->_tpl_vars['curruser'])): ?>
			<a href="index.php?csn=<?php echo $this->_tpl_vars['main']['csn']; ?>
&edit=1" class="editLink"><span>[修改文章]</span></a>
		<?php endif; ?>
		<div class="header"><?php echo $this->_tpl_vars['main']['title']; ?>

					<?php if ($this->_tpl_vars['main']['origin'] == 0): ?>
				<a href="index.php?csn=12" style="color:orange;font-size:10pt;">[返回 畢業門檻]</a>
			<?php endif; ?>
			</div>
		<div class="post">
		<?php if ($this->_tpl_vars['edit'] != NULL): ?>
			<div id="edit_tips">
				<strong>修改文章提醒:</strong>
					<blockquote>
						1. HTML全面支援<br />
						2. <font color="red">換行</font>請加 &lt;br /&gt;不支援 enter 斷行 <br />
						3. 小心使用 不要攻擊 謝謝
					</blockquote>
			</div>
			<form method="post" action="index.php?csn=<?php echo $this->_tpl_vars['main']['csn']; ?>
&edit_done=1" class="form1">
				<input type="submit" value="送出" class="submit">
				<textarea name="edit_main" wrap="physical"><?php echo $this->_tpl_vars['main']['main']; ?>
</textarea>
				<input type="submit" value="送出" class="submit">
			</form>
		<?php else: ?>
			<?php echo $this->_tpl_vars['main']['main']; ?>

		<?php endif; ?>
		</div>
	</div>
	<div style="clear:both"></div>
</div>